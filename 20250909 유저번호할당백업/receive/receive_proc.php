<?php
session_start();
require_once('../common/config.php');

$user_id = $_SESSION['id'];
$service = '';
$sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $service = $row['service'];
}

$api_url = 'http://49.247.173.49:80/get_number';
$data = array('apikey' => $user_id, 'service' => $service);
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

if (isset($data['error'])) {
    $errorMessage = $data['error'];
    echo "<script>";
    echo "alert('{$errorMessage}');";
    echo "window.location.replace('https://oa1sms.iwinv.net/receive/receive.php');";
    echo "</script>";
    exit(); 
} else {

    $sql = "SELECT phone_status_table.*, uuid.* 
            FROM phone_status_table 
            LEFT JOIN uuid ON phone_status_table.androidId = uuid.androidId 
            WHERE phname LIKE 'A01-%' 
               OR phname LIKE 'B01-%' 
               OR phname LIKE 'C-%' 
               OR phname LIKE 'D-%' 
            --    OR phname LIKE 'E01-%' 
            ORDER BY uuid.phname ASC;";

    $Phname = mysqli_query($conn, $sql);

    if (preg_match('/"number":"(\d+)"/', $response, $matches)) {
        $number = $matches[1];
    }
    
    $PhnameRS = '';
    if (mysqli_num_rows($Phname) > 0) {
        while ($row = mysqli_fetch_assoc($Phname)) {
            if (trim($row["phone_number"]) == trim($number)) {
                $PhnameRS = $row['phname'];
            }
        }
    } else {
        error_log("No records found.");
    }

    // coin 체크 및 처리
    $sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id';";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["user_id"] == $user_id) {
            if ($row["coin"] > 0) {
                // coin이 1 이상인 경우
                $data = json_decode($response, true);
                $result_data = implode(", ", $data);

                $sql = "UPDATE member 
                SET receive_number = CASE 
                    WHEN receive_number IS NULL OR receive_number = '' THEN CONCAT('{$PhnameRS}_{$service}_{$user_id}', ' : ', '{$result_data}')
                    ELSE CONCAT(receive_number, ',', '{$PhnameRS}_{$service}_{$user_id}', ' : ', '{$result_data}')
                END 
                WHERE id = '$user_id'";

                mysqli_query($conn, $sql);

                // 정상 처리 후 페이지 이동
                echo "<script>";
                echo "window.location.replace('https://oa1sms.iwinv.net/receive/receive.php');";
                echo "</script>";
            } else {
                // coin이 0 이하인 경우
                echo "<script>";
                echo "alert('충전 후 이용해주세요.');";
                echo "window.location.replace('https://oa1sms.iwinv.net/receive/receive.php');";
                echo "</script>";
            }
        }
    }
}



if (isset($data['error'])) {
    $errorMessage = $data['error'];
    echo "<script>";
    echo "alert('{$errorMessage}');";
    echo "window.location.replace('https://oa1sms.iwinv.net/receive/receive.php');";
    echo "</script>";

}
