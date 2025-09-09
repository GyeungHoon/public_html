<?php
session_start();
require_once('../common/config.php');

// $user_state = '';
// $sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id'";
// $result = mysqli_query($conn, $sql);
// while ($row = mysqli_fetch_assoc($result)) {
//     $user_state = $row['service'];
// }

$user_id = $_SESSION['id'];
// $service = '';

$user_state = '';
$sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $user_state = $row['service'];
}


// $sql = "SELECT number, 'sms_not_receive' AS status_value
// FROM get_number_pool
// WHERE (auth_code IS NULL OR auth_code = '')
// AND TIMESTAMPDIFF(MINUTE, updated_at, NOW()) >= 1; AND ";
// $result = mysqli_query($conn, $sql);



$sql = "SELECT number, 'sms_not_receive' AS status_value
FROM get_number_pool
WHERE (auth_code IS NULL OR auth_code = '')
AND TIMESTAMPDIFF(MINUTE, updated_at, NOW()) >= 30
AND service = '$user_state';";

$result = mysqli_query($conn, $sql);





while ($row = mysqli_fetch_assoc($result)) {
    $number = $row['number'];
    $sms_not_receive = $row['status_value'];

    // ob_start(); // 출력 버퍼 시작
    // var_dump("서비스 =" . $user_state);
    // var_dump("아이디 =" . $user_id);
    // var_dump("번호 =" . $number);
    // ob_flush(); // 버퍼 즉시 출력


    if ($sms_not_receive == "sms_not_receive") {

        $service = trim($user_state);
        $user_id = trim($user_id);
        $number = trim($number);




        // $sql = "UPDATE member
        // SET receive_number = TRIM(BOTH ',' FROM REPLACE(receive_number, 
        //     (SELECT SUBSTRING(receive_number, 1, LOCATE('_', receive_number, LOCATE('_', receive_number) + 1) + LENGTH('$service') + LENGTH('$user_id') + LENGTH('$number') + 10) 
        //      FROM (SELECT receive_number FROM member) AS subquery 
        //      WHERE receive_number LIKE CONCAT('%', '_', '$service', '_', '$user_id', ' : ', '$number', '%')), ''))
        // WHERE receive_number LIKE CONCAT('%', '_', '$service', '_', '$user_id', ' : ', '$number', '%');
        // ";
        // mysqli_query($conn, $sql);


        $sql = "UPDATE member
                SET receive_number = TRIM(BOTH ',' FROM REGEXP_REPLACE(receive_number, 
                    CONCAT('(^|,)', '[^,]*_', '$service', '_', '$user_id', ' : ', '$number', '([^,]*)'), ''))
                WHERE receive_number LIKE CONCAT('%', '_', '$service', '_', '$user_id', ' : ', '$number', '%');";
        mysqli_query($conn, $sql);
        



        if (mysqli_query($conn, $sql)) {
            echo "업데이트 성공!";
        } else {
            echo "업데이트 실패: " . mysqli_error($conn);
        }



        $api_url = 'http://49.247.173.49:80/update_number_status';
        $data = array('number' => $number, 'status_value' => $sms_not_receive, 'apikey' => $user_id, 'service' => $user_state);
        $data_json = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_json)
            )
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
    }
}
