<?php
    require_once('../common/config.php');
    // 175.196.164.90 안
    // 125.132.254.119 ㅈ
    // 211.54.90.64 이

    
// 허용할 IP 주소 목록
// $allowed_ips = array(
// 	// '175.196.164.90', // 안산
// 	'180.81.139.38', // 송도
// 	'125.132.254.119',//ㅈ
// 	'218.146.63.218', //부천 고객
// 	'112.159.6.182', //부천 고객
// 	'220.120.95.178', //최슨생
// 	'211.54.90.64', //이천
// 	'175.210.235.239',//부천
// 	'124.52.39.170', //용인
// 	'39.125.121.102'//아스콧 임시 IP
// );

//     // 접속자의 IP 주소
//     $visitor_ip = $_SERVER['REMOTE_ADDR'];

//     // 접속자 IP가 허용된 IP 목록에 없는 경우 차단
//     if (!in_array($visitor_ip, $allowed_ips)) {
//         // 접근 거부 메시지 출력
//         die('Access Denied');
//     }
    ?>

<html>

<head>
    <style>
        /* 모달 기본 */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* 모달 콘텐츠 */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 1200px;
            overflow: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .excelTableContainer th,
        tr,
        td {
            width: 200px;
            white-space: nowrap;
            /* 줄바꿈 안 함 */
            overflow: hidden;
            /* 넘치는 내용 감춤 */
            text-overflow: ellipsis;
            /* 말줄임(...) 처리 */
        }

        /* 닫기 버튼 */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>LAS_table</title>
    <link rel="icon" href="../assets/images/favicon_io/android-chrome-512x512.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>

    <main class="main">
        <div class="page_section">
            <div class="pageBtn">
                <form method="POST">
                    <span><button type="submit" name="buttonD" title="D타워입니다.">D</button></span>
                </form>
            </div>
        </div>

        <section class="phone_status">

            <h2 class="ir_su">현재 휴대폰 상태</h2>
            <?php
            $myVariable = "D";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // 버튼에 따라서 값을 변경
                if (isset($_POST['buttonD'])) {
                    $myVariable = "D";
                } 
            }
            // 기본값 재설정
            $myVariable = isset($myVariable) ? $myVariable : "D";

            // URL 생성
            $url = 'https://oa1sms.iwinv.net/pst/table_' . $myVariable . '_proc.php';

            // cURL 세션 초기화
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); // 요청할 URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 결과를 문자열로 반환
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 리다이렉션을 자동으로 따라가게 설정
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL 인증서 검증 비활성화 (필요한 경우)

            // URL 호출
            $results = curl_exec($ch);

            // cURL 오류 체크
            if ($results === false) {
                echo "데이터를 가져올 수 없습니다. cURL 오류: " . curl_error($ch);
                exit;
            }
            // cURL 세션 종료
            curl_close($ch);
            $phoneStatus = json_decode($results);
            if ($phoneStatus === null) {
                echo "잘못된 JSON 데이터입니다.";
                exit;
            }
            $lasCount = 0;
            $telegramCount = 0;
            $carrotCount = 0;
            $lineCount = 0;
            $naverCount = 0;
            $googleCount = 0;
            $gangnamunniCount = 0;
            $ncsoftCount = 0;
            $instagramCount = 0;
            $tiktokCount = 0;
            $coupangCount = 0;
            $telegramWaitingCheckCount = 0;
            $carrotWaitingCheckCount = 0;

            for ($i = 0; $i < count($phoneStatus); $i++) {
                $rs = $phoneStatus[$i];

                if ($rs->status_livescore == 'waiting') {
                    $lasCount++;
                }
                if ($rs->status_telegram == 'waiting') {
                    $telegramCount++;
                }
                if ($rs->status_carrot == 'waiting') {
                    $carrotCount++;
                }
                if ($rs->status_line == 'waiting') {
                    $lineCount++;
                }
                if ($rs->status_naver == 'waiting') {
                    $naverCount++;
                }
                if ($rs->status_google == 'waiting') {
                    $googleCount++;
                }
                if ($rs->status_gangnamunni == 'waiting') {
                    $gangnamunniCount++;
                }
                if ($rs->status_ncsoft == 'waiting') {
                    $ncsoftCount++;
                }
                if ($rs->status_instagram == 'waiting') {
                    $instagramCount++;
                }
                if ($rs->status_tiktok == 'waiting') {
                    $tiktokCount++;
                }
                if ($rs->status_coupang == 'waiting') {
                    $coupangCount++;
                }
                if ($rs->status_telegram_check == 'waiting') {
                    $telegramWaitingCheckCount++;
                }
                if ($rs->status_carrot_check == 'waiting') {
                    $carrotWaitingCheckCount++;
                }
            }

            ?>
            <div class=statusCount>
                <span>라스: <?php echo $lasCount ?>개 &nbsp;</span>
                <span>텔레그램: <?php echo $telegramCount ?>개 &nbsp;</span>
                <span>당근: <?php echo $carrotCount ?>개 &nbsp;</span>
                <span>라인: <?php echo $lineCount ?>개 &nbsp;</span>
                <span>네이버: <?php echo $naverCount ?>개 &nbsp;</span>
                <span>구글: <?php echo $googleCount ?>개 &nbsp;</span>
                <span>강남언니: <?php echo $gangnamunniCount ?>개 &nbsp;</span><br>

                <span>NCSOFT: <?php echo $ncsoftCount ?>개 &nbsp;</span>
                <span>인스타: <?php echo $instagramCount ?>개 &nbsp;</span>
                <span>틱톡: <?php echo $tiktokCount ?>개 &nbsp;</span>
                <span>쿠팡: <?php echo $coupangCount ?>개 &nbsp;</span>
                <span>당근체크: <?php echo $carrotWaitingCheckCount ?>개 &nbsp;</span>
                <span>텔레체크: <?php echo $telegramWaitingCheckCount ?>개 &nbsp;</span>
            </div>


            <div class="xlsxDownload">
                <span>
                    <button type="button" class="navyBtn" title="웹페이지에 엑셀 데이터로 표시됩니다." onclick="displayTable()">데이터 표시</button>
                    <button type="button" class="navyBtn" title="unknown 및 빈값의 남아있는 기록을 제거합니다." onclick="confirmAndRedirect()">기록초기화</button>
                </span>
            </div>

            <div id="excelModal" class="modal">
                <div class="modal-content">
                    <button onclick="copyModalContent()">전체 복사</button>
                    <span class="close" id="closeModal">&times;</span>
                    <div id="excelTableContainer">
                        <table id="excelTable" border="1">
                            <thead>
                                <tr>
                                    <th>별칭</th>
                                    <th>핸드폰번호</th>
                                    <th>상태</th>
                                    <th>라스</th>
                                    <th>텔레그램</th>
                                    <th>당근</th>
                                    <th>라인</th>
                                    <th>네이버</th>
                                    <th>구글</th>
                                    <th>강남언니</th>
                                    <th>NCSOFT</th>
                                    <th>인스타</th>
                                    <th>틱톡</th>
                                    <th>쿠팡</th>
                                    <th>당근체크</th>
                                    <th>텔레체크</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($phoneStatus); $i++) {
                                    $rs = $phoneStatus[$i];
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($rs->phname) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->phone_number) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->phone_status) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_livescore) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_telegram) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_carrot) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_line) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_naver) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_google) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_gangnamunni) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_ncsoft) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_instagram) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_tiktok) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_coupang) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_carrot_check) . '</td>';
                                    echo '<td>' . htmlspecialchars($rs->status_telegram_check) . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php


            echo '<div class="table">';

            for ($i = 0; $i < count($phoneStatus); $i++) {
                $rs = $phoneStatus[$i];
                if ($i <= 0) {
                    echo '<span class="cell">' . '별칭' . '</span>';
                    echo '<span class="cell">' . '번호' . '</span>';
                    echo '<span class="cell">' . '상태' . '</span>';
                    echo '<span class="cell">' . '라스' . '</span>';
                    echo '<span class="cell">' . '텔레그램' . '</span>';
                    echo '<span class="cell">' . '당근' . '</span>';
                    echo '<span class="cell">' . '라인' . '</span>';
                    echo '<span class="cell">' . '네이버' . '</span>';
                    echo '<span class="cell">' . '구글' . '</span>';
                    echo '<span class="cell">' . '강남언니' . '</span>';
                    echo '<span class="cell">' . 'NCSOFT' . '</span>';
                    echo '<span class="cell">' . '인스타그램' . '</span>';
                    echo '<span class="cell">' . '틱톡' . '</span>';
                    echo '<span class="cell">' . '쿠팡' . '</span>';
                    echo '<span class="cell">' . '당근체크' . '</span>';
                    echo '<span class="cell">' . '텔레체크' . '</span>';
                }

                echo '<div class="row">';
                if ($rs->phone_status == 'available') {
                    $rs->phone_status = 'ON';
                } else if ($rs->phone_status == 'unavailable') {
                    $rs->phone_status = 'OFF';
                }
                if ($rs->status_livescore == 'two_factor_auth') {
                    $rs->status_livescore = '2차';
                }
                if ($rs->status_telegram == 'two_factor_auth') {
                    $rs->status_telegram = '2차';
                }
             
                if ($rs->status_carrot == 'two_factor_auth') {
                    $rs->status_carrot = '2차';
                }
                if ($rs->status_line == 'two_factor_auth') {
                    $rs->status_line = '2차';
                }
                if ($rs->status_naver == 'two_factor_auth') {
                    $rs->status_naver = '2차';
                }
                if ($rs->status_google == 'two_factor_auth') {
                    $rs->status_google = '2차';
                }
                if ($rs->status_gangnamunni == 'two_factor_auth') {
                    $rs->status_gangnamunni = '2차';
                }
                if ($rs->status_ncsoft == 'two_factor_auth') {
                    $rs->status_ncsoft = '2차';
                }
                if ($rs->status_instagram == 'two_factor_auth') {
                    $rs->status_instagram = '2차';
                }
                if ($rs->status_tiktok == 'two_factor_auth') {
                    $rs->status_tiktok = '2차';
                }
                if ($rs->status_coupang == 'two_factor_auth') {
                    $rs->status_coupang = '2차';
                }
                   if ($rs->status_carrot_check == 'two_factor_auth') {
                    $rs->status_carrot_check = '2차';
                }
                   if ($rs->status_telegram_check == 'two_factor_auth') {
                    $rs->status_telegram_check = '2차';
                }


                if ($rs->status_livescore == 'success_incomplete') {
                    $rs->status_livescore = 'success';
                }
                if ($rs->status_telegram == 'success_incomplete') {
                    $rs->status_telegram = 'success';
                }
               
                if ($rs->status_carrot == 'success_incomplete') {
                    $rs->status_carrot = 'success';
                }
                if ($rs->status_line == 'success_incomplete') {
                    $rs->status_line = 'success';
                }
                if ($rs->status_naver == 'success_incomplete') {
                    $rs->status_naver = 'success';
                }
                if ($rs->status_google == 'success_incomplete') {
                    $rs->status_google = 'success';
                }
                if ($rs->status_gangnamunni == 'success_incomplete') {
                    $rs->status_gangnamunni = 'success';
                }
                if ($rs->status_ncsoft == 'success_incomplete') {
                    $rs->status_ncsoft = 'success';
                }
                if ($rs->status_instagram == 'success_incomplete') {
                    $rs->status_instagram = 'success';
                }
                if ($rs->status_tiktok == 'success_incomplete') {
                    $rs->status_tiktok = 'success';
                }
                if ($rs->status_coupang == 'success_incomplete') {
                    $rs->status_coupang = 'success';
                }
                 if ($rs->status_carrot_check == 'success_incomplete') {
                    $rs->status_carrot_check = 'success';
                }
                 if ($rs->status_telegram_check == 'success_incomplete') {
                    $rs->status_telegram_check = 'success';
                }



                if (strpos($rs->status_livescore, 'standby') !== false) {
                    $rs->status_livescore = 'standby';
                }
                if (strpos($rs->status_telegram, 'standby') !== false) {
                    $rs->status_telegram = 'standby';
                }
              
                if (strpos($rs->status_carrot, 'standby') !== false) {
                    $rs->status_carrot = 'standby';
                }
                if (strpos($rs->status_line, 'standby') !== false) {
                    $rs->status_line = 'standby';
                }
                if (strpos($rs->status_naver, 'standby') !== false) {
                    $rs->status_naver = 'standby';
                }
                if (strpos($rs->status_google, 'standby') !== false) {
                    $rs->status_google = 'standby';
                }
                if (strpos($rs->status_gangnamunni, 'standby') !== false) {
                    $rs->status_gangnamunni = 'standby';
                }
                if (strpos($rs->status_ncsoft, 'standby') !== false) {
                    $rs->status_ncsoft = 'standby';
                }
                if (strpos($rs->status_instagram, 'standby') !== false) {
                    $rs->status_instagram = 'standby';
                }
                if (strpos($rs->status_tiktok, 'standby') !== false) {
                    $rs->status_tiktok = 'standby';
                }
                if (strpos($rs->status_coupang, 'standby') !== false) {
                    $rs->status_coupang = 'standby';
                }
                  if (strpos($rs->status_carrot_check, 'standby') !== false) {
                    $rs->status_carrot_check = 'standby';
                }
                  if (strpos($rs->status_telegram_check, 'standby') !== false) {
                    $rs->status_telegram_check = 'standby';
                }








                echo '<span class="cell cellBg">' . htmlspecialchars($rs->phname) . '</span>';
                echo '<span class="cell cellBg">' . htmlspecialchars($rs->phone_number) . '</span>';
                echo '<span class="cell cellOnOff" data-status-OnOFF="' . htmlspecialchars($rs->phone_status) . '">' . htmlspecialchars($rs->phone_status) . '</span>';
                echo '<span class="cell cellBg" data-status-las="' . htmlspecialchars($rs->status_livescore) . '">' . htmlspecialchars($rs->status_livescore) . '</span>';
                echo '<span class="cell cellBg" data-status-telegram="' . htmlspecialchars($rs->status_telegram) . '">' . htmlspecialchars($rs->status_telegram) . '</span>';
                
                echo '<span class="cell cellBg" data-status-carrot="' . htmlspecialchars($rs->status_carrot) . '">' . htmlspecialchars($rs->status_carrot) . '</span>';
                echo '<span class="cell cellBg" data-status-line="' . htmlspecialchars($rs->status_line) . '">' . htmlspecialchars($rs->status_line) . '</span>';
                echo '<span class="cell cellBg" data-status-naver="' . htmlspecialchars($rs->status_naver) . '">' . htmlspecialchars($rs->status_naver) . '</span>';
                echo '<span class="cell cellBg" data-status-google="' . htmlspecialchars($rs->status_google) . '">' . htmlspecialchars($rs->status_google) . '</span>';
                echo '<span class="cell cellBg" data-status-gangnamunni="' . htmlspecialchars($rs->status_gangnamunni) . '">' . htmlspecialchars($rs->status_gangnamunni) . '</span>';
                echo '<span class="cell cellBg" data-status-ncsoft="' . htmlspecialchars($rs->status_ncsoft) . '">' . htmlspecialchars($rs->status_ncsoft) . '</span>';
                echo '<span class="cell cellBg" data-status-instagram="' . htmlspecialchars($rs->status_instagram) . '">' . htmlspecialchars($rs->status_instagram) . '</span>';
                echo '<span class="cell cellBg" data-status-tiktok="' . htmlspecialchars($rs->status_tiktok) . '">' . htmlspecialchars($rs->status_tiktok) . '</span>';
                echo '<span class="cell cellBg" data-status-coupang="' . htmlspecialchars($rs->status_coupang) . '">' . htmlspecialchars($rs->status_coupang) . '</span>';
                echo '<span class="cell cellBg" data-status-carrot-waiting-check="' . htmlspecialchars($rs->status_carrot_check) . '">' . htmlspecialchars($rs->status_carrot_check) . '</span>';
                echo '<span class="cell cellBg" data-status-telegram-waiting-check="' . htmlspecialchars($rs->status_telegram_check) . '">' . htmlspecialchars($rs->status_telegram_check) . '</span>';
                echo '</div>';
            }
            echo '</div>';

            ?>

        </section>
        <button id="top-btn" title="최상단으로 이동하는 버튼입니다."> ▲ <br />TOP</button>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const cells = document.querySelectorAll('.cell');

            cells.forEach(cell => {
                // 'data-status-OnOFF' 속성을 가져와 status_phone으로 설정
                const status_phone = cell.getAttribute('data-status-OnOFF');

                // 상태에 따른 배경색을 결정하는 함수
                function getStatusBgColor(status) {
                    switch (status) {
                        case 'ON':
                            return 'limegreen';
                        case 'OFF':
                            return 'orangered';
                        default:
                            return 'black'; // 기본값은 black
                    }
                }

                // 배경색 계산
                const color_OnOFF = getStatusBgColor(status_phone);

                // 색상이 black이 아니면 배경색을 설정
                if (color_OnOFF !== 'black') {
                    cell.style.backgroundColor = color_OnOFF;
                }

            });

        });



        document.addEventListener("DOMContentLoaded", function() {

            const cells = document.querySelectorAll('.cell');


            cells.forEach(cell => {

                const status_livescore = cell.getAttribute('data-status-las');
                const status_telegram = cell.getAttribute('data-status-telegram');
                
                const status_carrot = cell.getAttribute('data-status-carrot');
                const status_line = cell.getAttribute('data-status-line');
                const status_naver = cell.getAttribute('data-status-naver');
                const status_google = cell.getAttribute('data-status-google');
                const status_gangnamunni = cell.getAttribute('data-status-gangnamunni');
                const status_ncsoft = cell.getAttribute('data-status-ncsoft');
                const status_instagram = cell.getAttribute('data-status-instagram');
                const status_tiktok = cell.getAttribute('data-status-tiktok');
                const status_coupang = cell.getAttribute('data-status-coupang');
                const status_carrot_check = cell.getAttribute('data-status-carrot-waiting-check');
                const status_telegram_check = cell.getAttribute('data-status-telegram-waiting-check');


                function getStatusColor(status) {
                    switch (status) {
                        case 'success':
                        case 'success_2':
                        case 'success_incomplete_already_account':
                        case 'success_init':
                            return 'green';
                        case 'ban':
                        case 'unavailable':
                        case 'already_signed_up':
                        case '2차':
                            return 'red';
                        case 'error':
                        case 'error_step2':
                        case 'quiz_fail_aft3day':
                        case 'sms_not_receive_3':
                        case 'sms_not_receive_4':
                        case 'sms_not_receive_5':
                            return 'orange';
                        case 'sms_not_receive':
                            return 'orange';
                        case 'success_already_account':
                            return 'darkgreen';
                        case 'waiting':
                        case 'success_1':
                        case 'waiting_step2':
                        case 'Not connected':
                            return 'gray';
                        case 'standby':
                            return 'blue';

                        default:
                            return 'black';
                    }
                }


                const color_las = getStatusColor(status_livescore);
                const color_telegram = getStatusColor(status_telegram);
                
                const color_carrot = getStatusColor(status_carrot);
                const color_line = getStatusColor(status_line);
                const color_naver = getStatusColor(status_naver);
                const color_google = getStatusColor(status_google);
                const color_gangnamunni = getStatusColor(status_gangnamunni);
                const color_ncsoft = getStatusColor(status_ncsoft);
                const color_instagram = getStatusColor(status_instagram);
                const color_tiktok = getStatusColor(status_tiktok);
                const color_coupang = getStatusColor(status_coupang);
                const color_carrot_waiting_check = getStatusColor(status_carrot_check);
                const color_telegram_waiting_check = getStatusColor(status_telegram_check);


                if (color_las !== 'black') cell.style.color = color_las;
                else if (color_telegram !== 'black') cell.style.color = color_telegram;
                
                else if (color_carrot !== 'black') cell.style.color = color_carrot;
                else if (color_line !== 'black') cell.style.color = color_line;
                else if (color_naver !== 'black') cell.style.color = color_naver;
                else if (color_google !== 'black') cell.style.color = color_google;
                else if (color_gangnamunni !== 'black') cell.style.color = color_gangnamunni;
                else if (color_ncsoft !== 'black') cell.style.color = color_ncsoft;
                else if (color_instagram !== 'black') cell.style.color = color_instagram;
                else if (color_tiktok !== 'black') cell.style.color = color_tiktok;
                else if (color_coupang !== 'black') cell.style.color = color_coupang;
                else if (color_carrot_waiting_check !== 'black') cell.style.color = color_carrot_waiting_check;
                else if (color_telegram_waiting_check !== 'black') cell.style.color = color_telegram_waiting_check;
            });
        });
    </script>

    <script>
        // 웹페이지에 엑셀 데이터를 테이블로 표시
        function displayTable() {
            const tableContainer = document.getElementById("excelTableContainer");
            tableContainer.style.display = 'block';
        }
    </script>


    <script>
        function displayTable() {
            const modal = document.getElementById("excelModal");
            modal.style.display = "block";
        }

        document.getElementById("closeModal").onclick = function() {
            document.getElementById("excelModal").style.display = "none";
        };

        window.onclick = function(event) {
            const modal = document.getElementById("excelModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };


        function copyModalContent() {
            const content = document.getElementById("excelTable").innerText;
            navigator.clipboard.writeText(content)
                .then(() => {
                    alert("복사되었습니다!");
                })
                .catch(err => {
                    alert("복사 실패: " + err);
                });
        }

        function confirmAndRedirect() {
            if (confirm("정말 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.")) {
                location.href = 'NotNumberWaitingDelete_proc.php';
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="../assets/js/las_tool_user.js"></script>
    <script src="../assets/js/table.js"></script>

</body>

</html>