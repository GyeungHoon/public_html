<?php
require_once('../common/config.php');


// $sql = "UPDATE phone_status_table
// SET 
//     status_livescore = CASE 
//                          WHEN status_livescore = 'waiting' THEN '' 
//                          ELSE status_livescore 
//                        END,
//     status_telegram = CASE 
//                          WHEN status_telegram = 'waiting' THEN '' 
//                          ELSE status_telegram 
//                        END,
//     status_carrot = CASE 
//                          WHEN status_carrot = 'waiting' THEN '' 
//                          ELSE status_carrot 
//                        END,
//     status_line = CASE 
//                          WHEN status_line = 'waiting' THEN '' 
//                          ELSE status_line 
//                        END,
//     status_naver = CASE 
//                          WHEN status_naver = 'waiting' THEN '' 
//                          ELSE status_naver 
//                        END,
//     status_google = CASE 
//                          WHEN status_google = 'waiting' THEN '' 
//                          ELSE status_google 
//                        END,
//     status_gangnamunni = CASE 
//                          WHEN status_gangnamunni = 'waiting' THEN '' 
//                          ELSE status_gangnamunni 
//                        END
// WHERE (phone_number = '' OR phone_number = 'Unknown')
//   AND (
//         status_livescore = 'waiting' OR
//         status_telegram = 'waiting' OR
//         status_carrot = 'waiting' OR
//         status_line = 'waiting' OR
//         status_naver = 'waiting' OR
//         status_google = 'waiting' OR
//         status_gangnamunni = 'waiting'
//       );
// ";




$sql = "UPDATE phone_status_table
SET 
    status_livescore = '',
    status_telegram = '',
    status_telegram_check = '',
    status_carrot = '',
    status_carrot_check = '',
    status_line = '',
    status_naver = '',
    status_google = '',
    status_gangnamunni = '',
    status_ncsoft = '',
    status_instagram = '',
    status_tiktok = '',
    status_coupang = ''

WHERE phone_status = 'unavailable' AND phone_number = '' OR phone_number = 'Unknown';
";



$result = mysqli_query($conn, $sql);
echo "<script>";
echo "let UID = sessionStorage.getItem('userId');";
echo 'window.history.back();';
echo "</script>";
