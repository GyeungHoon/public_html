<?php
session_start();
include '../common/config.php';

// 폼에서 사용자 인덱스 가져오기
$user_idx = $_POST['user'] ?? null;

if (!$user_idx) {
    echo "<script>alert('고객을 선택해주세요.'); history.back();</script>";
    exit();
}

// 1. 번호덮어쓰기
if (isset($_POST['numberUpdate']) && !empty($_POST['numberUpdate'])) {
    $phone_numbers = $_POST['numberUpdate'];
    
    // 입력된 번호들을 배열로 변환 (공백과 줄바꿈으로 구분)
    $numbers = array_filter(array_map('trim', preg_split('/[\s\n]+/', $phone_numbers)));
    
    // JSON 배열로 변환
    $json_numbers = json_encode($numbers);
    
    $sql = "UPDATE member SET phone_numbers = ? WHERE idx = ?";
    $stmt = $connect->prepare($sql);
    $stmt->execute([$json_numbers, $user_idx]);
    
    echo "<script>alert('번호가 성공적으로 덮어쓰기되었습니다.'); history.back();</script>";
}

// 2. 번호추가 (중복 방지)
if (isset($_POST['addnumber']) && !empty($_POST['addnumber'])) {
    $phone_numbers = $_POST['addnumber'];
    
    // 입력된 번호들을 배열로 변환 (공백과 줄바꿈으로 구분)
    $new_numbers = array_filter(array_map('trim', preg_split('/[\s\n]+/', $phone_numbers)));
    
    // 먼저 현재 번호들을 가져옴
    $sql = "SELECT phone_numbers FROM member WHERE idx = ?";
    $stmt = $connect->prepare($sql);
    $stmt->execute([$user_idx]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $current_numbers = json_decode($result['phone_numbers'], true) ?: [];
        $added_count = 0;
        $duplicate_count = 0;
        
        // 각 번호에 대해 중복 체크 후 추가
        foreach ($new_numbers as $new_number) {
            if (!in_array($new_number, $current_numbers)) {
                $current_numbers[] = $new_number;
                $added_count++;
            } else {
                $duplicate_count++;
            }
        }
        
        if ($added_count > 0) {
            $json_numbers = json_encode($current_numbers);
            
            $sql = "UPDATE member SET phone_numbers = ? WHERE idx = ?";
            $stmt = $connect->prepare($sql);
            $stmt->execute([$json_numbers, $user_idx]);
            
            $message = "번호가 성공적으로 추가되었습니다. (추가: {$added_count}개";
            if ($duplicate_count > 0) {
                $message .= ", 중복: {$duplicate_count}개";
            }
            $message .= ")";
            echo "<script>alert('{$message}'); history.back();</script>";
        } else {
            echo "<script>alert('모든 번호가 이미 존재합니다.'); history.back();</script>";
        }
    }
}

// 3. 번호삭제
if (isset($_POST['deleteNumber']) && !empty($_POST['deleteNumber'])) {
    $phone_numbers = $_POST['deleteNumber'];
    
    // 입력된 번호들을 배열로 변환 (공백과 줄바꿈으로 구분)
    $delete_numbers = array_filter(array_map('trim', preg_split('/[\s\n]+/', $phone_numbers)));
    
    // 먼저 현재 번호들을 가져옴
    $sql = "SELECT phone_numbers FROM member WHERE idx = ?";
    $stmt = $connect->prepare($sql);
    $stmt->execute([$user_idx]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $current_numbers = json_decode($result['phone_numbers'], true) ?: [];
        $deleted_count = 0;
        $not_found_count = 0;
        
        // 각 번호에 대해 찾아서 삭제
        foreach ($delete_numbers as $delete_number) {
            $key = array_search($delete_number, $current_numbers);
            if ($key !== false) {
                unset($current_numbers[$key]);
                $deleted_count++;
            } else {
                $not_found_count++;
            }
        }
        
        if ($deleted_count > 0) {
            $current_numbers = array_values($current_numbers); // 인덱스 재정렬
            $json_numbers = json_encode($current_numbers);
            
            $sql = "UPDATE member SET phone_numbers = ? WHERE idx = ?";
            $stmt = $connect->prepare($sql);
            $stmt->execute([$json_numbers, $user_idx]);
            
            $message = "번호가 성공적으로 삭제되었습니다. (삭제: {$deleted_count}개";
            if ($not_found_count > 0) {
                $message .= ", 없음: {$not_found_count}개";
            }
            $message .= ")";
            echo "<script>alert('{$message}'); history.back();</script>";
        } else {
            echo "<script>alert('해당 번호들을 찾을 수 없습니다.'); history.back();</script>";
        }
    }
}
?>
