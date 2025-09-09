<?php
 require_once('../common/config.php');

 $data = isset($_POST['TowerWaitingNum']) ? $_POST['TowerWaitingNum'] : '';
 $normalized_data = preg_replace("/[\s,]+/", " ", trim($data));
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
 $quoted_numbers = array_map(function($number) {
     return "'" . trim($number) . "'";
 }, $final_numbers);
 $formatted_string = implode(",", $quoted_numbers);
 $sql = "UPDATE phone_status_table SET status_telegram = 'waiting' WHERE phone_number IN ($formatted_string);";
 $result = mysqli_query($conn, $sql);
	echo "<script>";
	echo "let UID = sessionStorage.getItem('userId');";
	echo 'window.history.back();';
	echo "</script>";
?>