<?php
 require_once('../common/config.php');

 $coinAddUser = isset($_GET['coinAddUser']) ? intval($_GET['coinAddUser']) : 0;
 $coinAddNum = isset($_GET['coinAddNum']) ? intval($_GET['coinAddNum']) : 0;

 $sql = "UPDATE las_tool_user SET coin = coin + $coinAddNum WHERE `no` = '$coinAddUser'";
 $result = mysqli_query($conn, $sql);


 $coinMinusUser = isset($_GET['coinMinusUser']) ? intval($_GET['coinMinusUser']) : 0;
 $coinMinusNum = isset($_GET['coinMinusNum']) ? intval($_GET['coinMinusNum']) : 0;

 $sql = "UPDATE las_tool_user SET coin = coin - $coinMinusNum WHERE `no` = '$coinMinusUser'";
 $result = mysqli_query($conn, $sql);
	echo "<script>";
	echo "let UID = sessionStorage.getItem('userId');";
	echo 'window.history.back();';
	echo "</script>";
?>