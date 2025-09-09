<?php
header('Content-Type: application/json');
include '../common/config.php';

$idx = $_POST['idx'] ?? null;
error_log("getCustomerInfo.php - Received idx: " . $idx);

if (!$idx) {
    echo json_encode(['success' => false, 'message' => '고객을 선택해주세요.']);
    exit();
}

$sql = "SELECT * FROM member WHERE idx = ?";
$stmt = $connect->prepare($sql);
$stmt->execute([$idx]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

error_log("getCustomerInfo.php - Query result: " . print_r($result, true));

if ($result) {
    // phone_numbers 안전하게 처리
    $phone_numbers_display = '등록된 번호 없음';
    if (!empty($result['phone_numbers']) && $result['phone_numbers'] !== 'null') {
        $decoded_numbers = json_decode($result['phone_numbers'], true);
        if (is_array($decoded_numbers) && !empty($decoded_numbers)) {
            $phone_numbers_display = implode(' ', $decoded_numbers);
        }
    }
    
    // phone_numbers를 안전한 형태로 변경
    $result['phone_numbers_display'] = $phone_numbers_display;
    
    echo json_encode([
        'success' => true,
        'data' => $result
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => '고객 정보를 찾을 수 없습니다.'
    ]);
}
?>