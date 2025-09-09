<?php
require_once('../common/config.php');

$allCheck =  isset($_POST['TowerWaitingNum']) ? $_POST['TowerWaitingNum'] : '';
if ($allCheck != null && $allCheck != '') {
    $allData = $allCheck;
} 

$lasCheck =  isset($_POST['TowerWaitingNumLas']) ? $_POST['TowerWaitingNumLas'] : '';
if ($lasCheck != null && $lasCheck != '') {
    $dataLas = $lasCheck;
}


$telegramCheck =  isset($_POST['TowerWaitingNumTelegram']) ? $_POST['TowerWaitingNumTelegram'] : '';
if ($telegramCheck != null && $telegramCheck != '') {
    $dataTelegram = $telegramCheck;
}

$telegramCheckWaiting =  isset($_POST['TowerWaitingNumTelegramCheck']) ? $_POST['TowerWaitingNumTelegramCheck'] : '';
if ($telegramCheckWaiting != null && $telegramCheckWaiting != '') {
    $dataTelegramWaitingCheck = $telegramCheckWaiting;
}

$carrotCheck =  isset($_POST['TowerWaitingNumCarrot']) ? $_POST['TowerWaitingNumCarrot'] : '';
if ($carrotCheck != null && $carrotCheck != '') {
    $dataCarrot = $carrotCheck;
}

$carrotCheckWaiting =  isset($_POST['TowerWaitingNumCarrotCheck']) ? $_POST['TowerWaitingNumCarrotCheck'] : '';
if ($carrotCheckWaiting != null && $carrotCheckWaiting != '') {
    $dataCarrotWaitingCheck = $carrotCheckWaiting;
}

$lineCheck =  isset($_POST['TowerWaitingNumLine']) ? $_POST['TowerWaitingNumLine'] : '';
if ($lineCheck != null && $lineCheck != '') {
    $dataLine = $lineCheck;
}

$naverCheck =  isset($_POST['TowerWaitingNumNaver']) ? $_POST['TowerWaitingNumNaver'] : '';
if ($naverCheck != null && $naverCheck != '') {
    $dataNaver = $naverCheck;
}

$googleCheck =  isset($_POST['TowerWaitingNumGoogle']) ? $_POST['TowerWaitingNumGoogle'] : '';
if ($googleCheck != null && $googleCheck != '') {
    $dataGoogle = $googleCheck;
}
$gangnamunniCheck =  isset($_POST['TowerWaitingNumGangnamunni']) ? $_POST['TowerWaitingNumGangnamunni'] : '';
if ($gangnamunniCheck != null && $gangnamunniCheck != '') {
    $dataGangnamunni = $gangnamunniCheck;
}
$ncsoftCheck =  isset($_POST['TowerWaitingNumNcsoft']) ? $_POST['TowerWaitingNumNcsoft'] : '';
if ($ncsoftCheck != null && $ncsoftCheck != '') {
    $dataNcsoft = $ncsoftCheck;
}
$instagramCheck =  isset($_POST['TowerWaitingNumInstagram']) ? $_POST['TowerWaitingNumInstagram'] : '';
if ($instagramCheck != null && $instagramCheck != '') {
    $dataInstagram = $instagramCheck;
}

$tiktokCheck =  isset($_POST['TowerWaitingNumTiktok']) ? $_POST['TowerWaitingNumTiktok'] : '';
if ($tiktokCheck != null && $tiktokCheck != '') {
    $dataTiktok = $tiktokCheck;
}
$coupangCheck =  isset($_POST['TowerWaitingNumCoupang']) ? $_POST['TowerWaitingNumCoupang'] : '';
if ($coupangCheck != null && $coupangCheck != '') {
    $dataCoupang = $coupangCheck;
}

// 라스 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataLas));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_las = implode(",", $quoted_numbers);
// 라스 데이터 끝

// 텔레그램 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataTelegram));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_telegram = implode(",", $quoted_numbers);
// 텔레그램 데이터 끝

// 텔레그램 waiting check 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataTelegramWaitingCheck));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_telegram_waiting_check = implode(",", $quoted_numbers);
// 텔레그램 데이터 끝

// 당근 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataCarrot));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_carrot = implode(",", $quoted_numbers);
// 당근 데이터 끝




// 당근 waiting check 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataCarrotWaitingCheck));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_carrot_waiting_check = implode(",", $quoted_numbers);
// 당근 데이터 끝



// 라인 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataLine));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_line = implode(",", $quoted_numbers);
// 라인 데이터 끝

// 네이버 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataNaver));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_naver = implode(",", $quoted_numbers);
// 네이버 데이터 끝


// 구글 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataGoogle));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_google = implode(",", $quoted_numbers);
// 구글 데이터 끝


// 강남언니 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataGangnamunni));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_gangnamunni = implode(",", $quoted_numbers);
// 강남언니 데이터 끝




// 엔씨소프트 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataNcsoft));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_ncsoft = implode(",", $quoted_numbers);
// 엔씨소프트 데이터 끝


// 인스타그램 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataInstagram));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_instagram = implode(",", $quoted_numbers);
// 인스타그램 데이터 끝


// 틱톡 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataTiktok));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_tiktok = implode(",", $quoted_numbers);
// 틱톡 데이터 끝


// 쿠팡 데이터 시작
$normalized_data = preg_replace("/[\s,]+/", " ", trim($dataCoupang));
$numbers = explode(" ", $normalized_data);
$final_numbers = [];
foreach ($numbers as $number) {

    if (strlen($number) > 11) {
        $split_numbers = str_split($number, 11);
        $final_numbers = array_merge($final_numbers, $split_numbers);
    } else {
        $final_numbers[] = $number;
    }
}
$quoted_numbers = array_map(function ($number) {
    return "'" . trim($number) . "'";
}, $final_numbers);
$formatted_string_coupang = implode(",", $quoted_numbers);
// 쿠팡 데이터 끝



if ($formatted_string != '') {
    $AllCheckSql = "SELECT status_livescore, status_telegram, status_carrot, status_line, status_naver FROM phone_status_table WHERE phone_number IN($formatted_string);";
    $AllChecked  = mysqli_query($conn, $AllCheckSql);
}

if ($formatted_string_las != '') {
    $lasCheckSql = "SELECT status_livescore FROM phone_status_table WHERE phone_number IN($formatted_string_las);";
    $lasChecked  = mysqli_query($conn, $lasCheckSql);
}

if ($formatted_string_telegram != '') {
    $telegramCheckSql = "SELECT status_telegram FROM phone_status_table WHERE phone_number IN($formatted_string_telegram);";
    $telegramChecked  = mysqli_query($conn, $telegramCheckSql);
}

if ($formatted_string_telegram_waiting_check != '') {
    $telegramWaitingCheckSql = "SELECT status_telegram_check FROM phone_status_table WHERE phone_number IN($formatted_string_telegram_waiting_check);";
    $telegramWaitingChecked  = mysqli_query($conn, $telegramWaitingCheckSql); 
}

if ($formatted_string_carrot != '') {
    $carrotCheckSql = "SELECT status_carrot FROM phone_status_table WHERE phone_number IN($formatted_string_carrot);";
    $carrotChecked  = mysqli_query($conn, $carrotCheckSql);
}

if ($formatted_string_carrot_waiting_check != '') {
    $carrotWaitingCheckSql = "SELECT status_carrot_check FROM phone_status_table WHERE phone_number IN($formatted_string_carrot_waiting_check);";
    $carrotWaitingChecked  = mysqli_query($conn, $carrotWaitingCheckSql); 
}

if ($formatted_string_line != '') {
    $lineCheckSql = "SELECT status_line FROM phone_status_table WHERE phone_number IN($formatted_string_line);";
    $lineChecked  = mysqli_query($conn, $lineCheckSql);
}

if ($formatted_string_naver != '') {
    $naverCheckSql = "SELECT status_naver FROM phone_status_table WHERE phone_number IN($formatted_string_naver);";
    $naverChecked  = mysqli_query($conn, $naverCheckSql);
}
if ($formatted_string_google != '') {
    $googleCheckSql = "SELECT status_google FROM phone_status_table WHERE phone_number IN($formatted_string_google);";
    $googleChecked  = mysqli_query($conn, $googleCheckSql);
}
if ($formatted_string_gangnamunni != '') {
    $gangnamunniCheckSql = "SELECT status_gangnamunni FROM phone_status_table WHERE phone_number IN($formatted_string_gangnamunni);";
    $gangnamunniChecked  = mysqli_query($conn, $gangnamunniCheckSql);
}
if ($formatted_string_ncsoft != '') {
    $ncsoftCheckSql = "SELECT status_ncsoft FROM phone_status_table WHERE phone_number IN($formatted_string_ncsoft);";
    $ncsoftChecked  = mysqli_query($conn, $ncsoftCheckSql);
}
if ($formatted_string_instagram != '') {
    $instagramCheckSql = "SELECT status_instagram FROM phone_status_table WHERE phone_number IN($formatted_string_instagram);";
    $instagramChecked  = mysqli_query($conn, $instagramCheckSql);
}
if ($formatted_string_tiktok != '') {
    $tiktokCheckSql = "SELECT status_tiktok FROM phone_status_table WHERE phone_number IN($formatted_string_tiktok);";
    $tiktokChecked  = mysqli_query($conn, $tiktokCheckSql);
}
if ($formatted_string_coupang != '') {
    $coupangCheckSql = "SELECT status_coupang FROM phone_status_table WHERE phone_number IN($formatted_string_coupang);";
    $coupangChecked  = mysqli_query($conn, $coupangCheckSql);
}


// 라스
if (!empty($lasCheck) && $lasCheck !== "") {
    // 먼저 쿼리 실행 결과가 false인지 확인
    if ($lasChecked === false) {
        // 쿼리 실패 처리
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_las = 0;
        while ($row = mysqli_fetch_assoc($lasChecked)) {

            if ($row['status_livescore'] != NULL && $count_las == 0) {
                // 결과가 있으면 이미 사용된 번호 메시지 출력
                echo "<script>";
                echo "alert('이미 라스에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_las++;
            } else if ($row['status_livescore'] === NULL || $row['status_livescore'] === "") {
                // 결과가 없으면 업데이트 쿼리 실행
                $sql = "UPDATE phone_status_table SET status_livescore = 'waiting' WHERE phone_number IN ($formatted_string_las);";
                $result_las = mysqli_query($conn, $sql);
            }
        }
        // 쿼리 실행 성공 여부 확인
        if ($result_las) {
            echo "<script>";
            echo "alert('라스 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

//텔레
if (!empty($telegramCheck) && $telegramCheck !== "") {
    if ($telegramChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_telegram = 0;
        while ($row = mysqli_fetch_assoc($telegramChecked)) {
            if ($row['status_telegram'] != NULL && $count_telegram == 0) {
                echo "<script>";
                echo "alert('이미 텔레그램에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_telegram++;
            } else if ($row['status_telegram'] === NULL || $row['status_telegram'] === "") {
                $sql = "UPDATE phone_status_table SET status_telegram = 'waiting' WHERE phone_number IN ($formatted_string_telegram);";
                $result_telegram = mysqli_query($conn, $sql);
            }
        }
        if ($result_telegram) {
            echo "<script>";
            echo "alert('텔레그램 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}


//텔레 웨이팅 체크
if (!empty($telegramCheckWaiting) && $telegramCheckWaiting !== "") { 
    if ($telegramWaitingChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_telegram_waiting_check = 0;
        while ($row = mysqli_fetch_assoc($telegramWaitingChecked)) {
            if ($row['status_telegram_check'] != NULL && $count_telegram_waiting_check == 0) {
                echo "<script>";
                echo "alert('이미 텔레그램체크에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_telegram_waiting_check++;
            } else if ($row['status_telegram_check'] === NULL || $row['status_telegram_check'] === "") {
                $sql = "UPDATE phone_status_table SET status_telegram_check = 'waiting' WHERE phone_number IN ($formatted_string_telegram_waiting_check);";
                $result_telegram_waiting_check = mysqli_query($conn, $sql);
            }
        }
        if ($result_telegram_waiting_check) {
            echo "<script>";
            echo "alert('텔레그램체크 업데이트 성공');";
            echo "</script>";
        }
    }
}


//당근
if (!empty($carrotCheck) && $carrotCheck !== "") {
    if ($carrotChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_carrot = 0;
        while ($row = mysqli_fetch_assoc($carrotChecked)) {
            if ($row['status_carrot'] != NULL && $count_carrot == 0) {
                echo "<script>";
                echo "alert('이미 당근에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_carrot++;
            } else if ($row['status_carrot'] === NULL || $row['status_carrot'] === "") {
                $sql = "UPDATE phone_status_table SET status_carrot = 'waiting' WHERE phone_number IN ($formatted_string_carrot);";
                $result_carrot = mysqli_query($conn, $sql);
            }
        }
        if ($result_carrot) {
            echo "<script>";
            echo "alert('당근 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}





//당근 웨이팅 체크
if (!empty($carrotCheckWaiting) && $carrotCheckWaiting !== "") { 
    if ($carrotWaitingChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_carrot_waiting_check = 0;
        while ($row = mysqli_fetch_assoc($carrotWaitingChecked)) {
            if ($row['status_carrot_check'] != NULL && $count_carrot_waiting_check == 0) {
                echo "<script>";
                echo "alert('이미 당근마켓체크에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_carrot_waiting_check++;
            } else if ($row['status_carrot_check'] === NULL || $row['status_carrot_check'] === "") {
                $sql = "UPDATE phone_status_table SET status_carrot_check = 'waiting' WHERE phone_number IN ($formatted_string_carrot_waiting_check);";
                $result_carrot_waiting_check = mysqli_query($conn, $sql);
            }
        }
        if ($result_carrot_waiting_check) {
            echo "<script>";
            echo "alert('당근마켓체크 업데이트 성공');";
            echo "</script>";
        }
    }
}




//라인
$lineCheck = trim($lineCheck);
if (!empty($lineCheck) && $lineCheck !== "") {
    if ($lineChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_line = 0;
        while ($row = mysqli_fetch_assoc($lineChecked)) {
            if ($row['status_line'] != NULL && $count_line == 0) {
                echo "<script>";
                echo "alert('이미 라인에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_line++;
            } else if ($row['status_line'] === NULL || $row['status_line'] === "") {
                $sql = "UPDATE phone_status_table SET status_line = 'waiting' WHERE phone_number IN ($formatted_string_line);";
                $result_line = mysqli_query($conn, $sql);
            }
        }
        if ($result_line) {
            echo "<script>";
            echo "alert('라인 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

//네이버
if (!empty($naverCheck) && $naverCheck !== "") {
    if ($naverChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_naver = 0;
        while ($row = mysqli_fetch_assoc($naverChecked)) {
            if ($row['status_naver'] != NULL && $count_naver == 0) {
                echo "<script>";
                echo "alert('이미 네이버에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_naver++;
            } else if ($row['status_naver'] === NULL || $row['status_naver'] === "") {
                $sql = "UPDATE phone_status_table SET status_naver = 'waiting' WHERE phone_number IN ($formatted_string_naver);";
                $result_naver = mysqli_query($conn, $sql);
            }
        }
        if ($result_naver) {
            echo "<script>";
            echo "alert('네이버 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

//구글
if (!empty($googleCheck) && $googleCheck !== "") {
    if ($googleChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {
        $count_google = 0;
        while ($row = mysqli_fetch_assoc($googleChecked)) {
            if ($row['status_google'] != NULL && $count_google == 0) {
                echo "<script>";
                echo "alert('이미 구글에 사용된 번호가 있습니다');";
                echo "</script>";
                $count_google++;
            } else if ($row['status_google'] === NULL || $row['status_google'] === "") {
                $sql = "UPDATE phone_status_table SET status_google = 'waiting' WHERE phone_number IN ($formatted_string_google);";
                $result_google = mysqli_query($conn, $sql);
            }
        }
        if ($result_google) {
            echo "<script>";
            echo "alert('구글 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

//강남언니
if (!empty($gangnamunniCheck) && $gangnamunniCheck !== "") {
    if ($gangnamunniChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_gangnamunni = 0;
        while ($row = mysqli_fetch_assoc($gangnamunniChecked)) {
            if ($row['status_gangnamunni'] != NULL && $count_gangnamunni == 0) {
                echo "<script>";
                echo "alert('이미 강남언니에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_gangnamunni++;
            } else if ($row['status_gangnamunni'] === NULL || $row['status_gangnamunni'] === "") {
                $sql = "UPDATE phone_status_table SET status_gangnamunni = 'waiting' WHERE phone_number IN ($formatted_string_gangnamunni);";
                $result_gangnamunni = mysqli_query($conn, $sql);
            }
        }
        if ($result_gangnamunni) {
            echo "<script>";
            echo "alert('강남언니 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}


//엔씨소프트
if (!empty($ncsoftCheck) && $ncsoftCheck !== "") {
    if ($ncsoftChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_ncsoft = 0;
        while ($row = mysqli_fetch_assoc($ncsoftChecked)) {
            if ($row['status_ncsoft'] != NULL && $count_ncsoft == 0) {
                echo "<script>";
                echo "alert('이미 엔씨소프트에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_ncsoft++;
            } else if ($row['status_ncsoft'] === NULL || $row['status_ncsoft'] === "") {
                $sql = "UPDATE phone_status_table SET status_ncsoft = 'waiting' WHERE phone_number IN ($formatted_string_ncsoft);";
                $result_ncsoft = mysqli_query($conn, $sql);
            }
        }
        if ($result_ncsoft) {
            echo "<script>";
            echo "alert('엔씨소프트 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}
 
//인스타그램
if (!empty($instagramCheck) && $instagramCheck !== "") {
    if ($instagramChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_instagram = 0;
        while ($row = mysqli_fetch_assoc($instagramChecked)) {
            if ($row['status_instagram'] != NULL && $count_instagram == 0) {
                echo "<script>";
                echo "alert('이미 인스타그램에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_instagram++;
            } else if ($row['status_instagram'] === NULL || $row['status_instagram'] === "") {
                $sql = "UPDATE phone_status_table SET status_instagram = 'waiting' WHERE phone_number IN ($formatted_string_instagram);";
                $result_instagram = mysqli_query($conn, $sql);
            }
        }
        if ($result_instagram) {
            echo "<script>";
            echo "alert('인스타그램 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

// 틱톡
if (!empty($tiktokCheck) && $tiktokCheck !== "") {
    if ($tiktokChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_tiktok = 0;
        while ($row = mysqli_fetch_assoc($tiktokChecked)) {
            if ($row['status_tiktok'] != NULL && $count_tiktok == 0) {
                echo "<script>";
                echo "alert('이미 틱톡에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_tiktok++;
            } else if ($row['status_tiktok'] === NULL || $row['status_tiktok'] === "") { // �� 수정됨: $row['status_'] → $row['status_tiktok']
                $sql = "UPDATE phone_status_table SET status_tiktok = 'waiting' WHERE phone_number IN ($formatted_string_tiktok);";
                $result_tiktok = mysqli_query($conn, $sql);
            }
        }
        if ($result_tiktok) {
            echo "<script>";
            echo "alert('틱톡 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}

// 쿠팡
if (!empty($coupangCheck) && $coupangCheck !== "") {
    if ($coupangChecked === false) {
        echo "<script>";
        echo "alert('쿼리 실행에 실패했습니다.');";
        echo "</script>";
    } else {

        $count_coupang = 0;
        while ($row = mysqli_fetch_assoc($coupangChecked)) {
            if ($row['status_coupang'] != NULL && $count_coupang == 0) {
                echo "<script>";
                echo "alert('이미 쿠팡에 사용된 번호가 있습니다');";
                echo "</script>";

                $count_coupang++;
            } else if ($row['status_coupang'] === NULL || $row['status_coupang'] === "") { // �� 수정됨: $row['status_'] → $row['status_coupang']
                $sql = "UPDATE phone_status_table SET status_coupang = 'waiting' WHERE phone_number IN ($formatted_string_coupang);";
                $result_coupang = mysqli_query($conn, $sql);
            }
        }
        if ($result_coupang) {
            echo "<script>";
            echo "alert('쿠팡 waiting 업데이트 성공');";
            echo "</script>";
        }
    }
}


echo "<script>";
echo "let UID = sessionStorage.getItem('userId');";
echo 'window.history.back();';
echo "</script>";