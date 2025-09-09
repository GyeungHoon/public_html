<?php
require_once('../common/config.php');
header('Content-Type: application/json'); // JSON 응답임을 명시

// 모든 출력 버퍼를 정리
ob_clean();
ob_start();

$sql = "SELECT * FROM phone_status_table LEFT JOIN uuid ON phone_status_table.androidId = uuid.androidId WHERE uuid.phname LIKE 'C%' ORDER BY phname ASC;";
$result = mysqli_query($conn, $sql);
$previous_phname = null; // 이전 상태를 저장할 변수

$results = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // 현재 상태 값
        $current_phname = $row['phname'];

        // 정규식으로 숫자 부분만 추출
        preg_match('/-(\d+)/', $current_phname, $matches);

        // 첫 번째 캡처 그룹에서 숫자 추출
        $number = (int)$matches[1];

        if ($previous_phname == null || $number - $previous_phname == 1) {
            // 이전 phname이 null이거나 연속된 경우에는 현재 번호를 previous_phname으로 갱신
            $previous_phname = $number;
        } else if ($number - $previous_phname > 1) {
            // 중간에 빈 번호가 있을 경우 처리
            $num = $number - $previous_phname;

            // 빈 번호들을 "Not connected" 상태로 추가
            for ($i = 1; $i < $num; $i++) {
                $results[] = array(
                    'phone_number' => 'Not connected',
                    'phone_status' => 'OFF',
                    'status_livescore' => 'Not connected',
                    'status_telegram' => 'Not connected',
                    'status_carrot' => 'Not connected',
                    'status_line' => 'Not connected',
                    'status_naver' => 'Not connected',
                    'status_google' => 'Not connected',
                    'status_gangnamunni' => 'Not connected',
                    'status_ncsoft' => 'Not connected',
                    'status_instagram' => 'Not connected',
                    'status_tiktok' => 'Not connected',
                    'status_coupang' => 'Not connected',
                    'status_telegram_check' => 'Not connected',
                    'status_carrot_check' => 'Not connected',
                    // 빈 번호를 추가
                    'phname' => 'ERROR-' . str_pad($previous_phname + $i, 3, '0', STR_PAD_LEFT),
                );
            }
            // 빈 번호를 추가한 후 previous_phname을 현재 번호로 갱신
            $previous_phname = $number;
        }

        // 기존 상태 값을 results 배열에 추가
        $results[] = array(
            'phone_number' => $row['phone_number'],
            'phone_status' => $row['phone_status'],
            'status_livescore' => $row['status_livescore'],
            'status_telegram' => $row['status_telegram'],
            'status_carrot' => $row['status_carrot'],
            'status_line' => $row['status_line'],
            'status_naver' => $row['status_naver'],
            'status_google' => $row['status_google'],
            'status_gangnamunni' => $row['status_gangnamunni'],
            'status_ncsoft' => $row['status_ncsoft'],
            'status_instagram' => $row['status_instagram'],
            'status_tiktok' => $row['status_tiktok'],
            'status_coupang' => $row['status_coupang'],
            'status_telegram_check' => $row['status_telegram_check'],
            'status_carrot_check' => $row['status_carrot_check'],
            'phname' => $row['phname'],
        );
    }
} else {
    error_log("No records found.");
}

echo json_encode($results);
ob_end_flush();
