<?php 
require_once('../common/config.php');
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// 모든 출력 버퍼를 정리
ob_clean();
ob_start();

// 세션 ID 확인
$id = $_SESSION['id'];
error_log("Session ID: " . $id);

$sql_val_select = "SELECT * FROM member WHERE `id` = '$id'";
error_log("sql_val_select: " . $sql_val_select);

// 쿼리 실행
$result_val_select = mysqli_query($conn, $sql_val_select);
if (!$result_val_select) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    ob_end_flush();
    mysqli_close($conn);
    exit();
}

$rs_val_select = mysqli_fetch_array($result_val_select);
if ($rs_val_select) {
    // 상태 값을 하드코딩
    error_log("Hardcoded state value: " . $rs_val_select['state']);
}

$sql = "SELECT
    M.`date` AS RESULT1, M.`from` AS RESULT2, M.`to` AS RESULT3, 
    COALESCE(U.`phname`, M.`androidId`) AS RESULT4, M.`message` AS RESULT5
    FROM maintable AS M
    LEFT JOIN uuid AS U ON M.`androidId` IS NOT NULL AND M.`androidId` = U.`androidId`
    LEFT JOIN member AS MEM ON MEM.id = '$id'
    WHERE DATE_ADD(NOW(), INTERVAL -20 MINUTE) <= DATE_FORMAT(M.`date`, '%Y-%m-%d %T')";

// 하드코딩된 state 값으로 필터링 추가
$sql .= " AND M.`message` LIKE '%" . $rs_val_select['state'] . "%'";

// phone_numbers JSON 컬럼과 maintable의 to 컬럼 매칭 필터링
$sql .= " AND MEM.phone_numbers IS NOT NULL AND MEM.phone_numbers != '' AND JSON_CONTAINS(MEM.phone_numbers, JSON_QUOTE(M.to))";

$sql .= " ORDER BY M.no DESC";
error_log("Final SQL Query: " . $sql);

// 쿼리 실행
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    ob_end_flush();
    mysqli_close($conn);
    exit();
}

$results = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        error_log("Retrieved Message: " . $row['RESULT5']);
        $results[] = array(
            'RESULT1' => $row['RESULT1'],
            'RESULT2' => $row['RESULT2'],
            'RESULT3' => $row['RESULT3'],
            'RESULT4' => $row['RESULT4'],
            'RESULT5' => $row['RESULT5'],
        );
    }
} else {
    error_log("No records found for the query: " . $sql);
}

echo json_encode($results);
ob_end_flush();
?>
