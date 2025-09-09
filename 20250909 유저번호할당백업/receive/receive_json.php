<?PHP
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once('../common/config.php');

$user_id = $_SESSION['id'];
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    echo "<script>";
    echo "alert(\"로그인 페이지로 이동.\");";
    echo 'window.location.href = "/login/login.php";';
    echo "</script>";
}
$user_state = '';
$sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $user_state = $row['service'];
}


$sql = "SELECT * FROM get_number_pool";
$result = mysqli_query($conn, $sql);





$sqlMember = "SELECT * FROM member WHERE id = '$user_id'";
$memberRS = mysqli_query($conn, $sqlMember);

$receive_number = '';
while ($row = mysqli_fetch_assoc($memberRS)) {
    $receive_number = $row['receive_number'];
}

// 핸드폰 번호를 추출하는 정규 표현식
$pattern = '/\d{3}-?\d{3,4}-?\d{4}/';

// 핸드폰 번호 추출
preg_match_all($pattern, $receive_number, $matches);

// 결과 출력
$phone_numbers = $matches[0]; // 첫 번째 그룹에 추출된 핸드폰 번호가 들어있음

$get_number_arr = array();
while ($row = mysqli_fetch_assoc( $result)) {

    if (in_array($row["number"], $phone_numbers) && $row["service"] ==  $user_state) {
        $get_number_arr[] = array(
            'RESULT1' => $row["number"],
            'RESULT2' => $row["service"],
            'RESULT3' => $row["auth_code"],
            'RESULT4' => $row["user_id"],
            'RESULT5' => $row["created_at"],
            'RESULT6' => $row["updated_at"]
        );
    }
}


$sql = "SELECT * FROM get_number_pool";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if($row['auth_code'] !== '' && $row['auth_code'] !== null && $row['service'] == $user_state){
        $number = $row["number"];
        $status_value = $user_id;

        if ($row['auth_code'] !== '' && $row['auth_code'] !== null) {
            $api_url = 'http://49.247.173.49:80/update_number_status';
            $data = array('number' => $number, 'status_value' => $status_value, 'apikey' => $user_id, 'service' => $user_state);
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
}

// 최종 결과 출력
echo json_encode($get_number_arr);
ob_end_flush();




?>