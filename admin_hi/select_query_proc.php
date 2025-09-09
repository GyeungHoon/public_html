<?php
require_once('../common/config.php');
session_start();

if ($_POST['hCode'] ?? null == 'Insert') {
	$aledyId = "SELECT * FROM member where id = '$_POST[uname]';";

	$aledyIdRs = mysqli_query($conn, $aledyId);
	$rs = mysqli_fetch_array($aledyIdRs);

	if (null != $_POST['uname'] && $rs['id'] != $_POST['uname']) {
		$sql = "INSERT INTO `member` (id, psword,`name`,create_date) 
		VALUES ('$_POST[uname]','$_POST[password]','$_POST[name]', now())";

		mysqli_query($conn, $sql);
		echo "<script>alert(\"회원가입이 완료되었습니다.\");";
		echo 'window.location.href = "/login/login.php";';
		echo "</script>";
	} else if ($rs['id'] == $_POST['uname']) {
		echo "<script>";
		echo "alert(\"중복된 아이디입니다.\");";
		echo 'window.location.href = "/admin_hi/signup.php";';
		echo "</script>";
	}
} else if ($_GET['hCode'] == 'Delete') {

	// $idx = (int)$_GET['idx'];
	$sql = "delete from member where idx = $_GET[idx]";
	mysqli_query($conn, $sql);

	echo "<script>";
	echo "let UID = sessionStorage.getItem('userId');";
	echo 'window.history.back();';
	echo "</script>";
} else if ($_GET['hCode'] == 'logout') {
	// 로그인 로그 업데이트
	$sql = "UPDATE `member` SET login_log = '' WHERE idx = '1'";
	mysqli_query($conn, $sql);

	// 세션 종료
	unset($_SESSION['login_log']);
	session_destroy();

	// 로그아웃 후 페이지 리디렉션
	echo "<script>
			 alert('로그아웃이 완료되었습니다.');
			 window.location.replace('/login/login.php');
		   </script>";
} else {
	if ($_GET['val'] == '라스') {
		$sql = "UPDATE member set state = '라스' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '네이버') {
		$sql = "UPDATE member set state = '네이버' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '당근마켓') {
		$sql = "UPDATE member set state = '당근' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '카카오톡') {
		$sql = "UPDATE member set state = '카카오' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '라인') {
		$sql = "UPDATE member set state =  'LINE' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '텔레그램') {
		$sql = "UPDATE member set state =  'Telegram code' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '밴드') {
		$sql = "UPDATE member set state =  'BAND' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '구글') {
		$sql = "UPDATE member set state =  'Google' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '리니지') {
		$sql = "UPDATE member set state =  'NCSOFT' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '에오스') {
		$sql = "UPDATE member set state =  '에오스' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '인스타그램') {
		$sql = "UPDATE member set state =  'Instagram' where idx = '$_GET[idx]' ";
	} else if ($_GET['val'] == '틱톡') {
		$sql = "UPDATE member set state =  'Tiktok' where idx = '$_GET[idx]' ";
	}else if ($_GET['val'] == '쿠팡') {
		$sql = "UPDATE member set state =  '쿠팡' where idx = '$_GET[idx]' ";
	}

	mysqli_query($conn, $sql);

	echo "<script>";
	echo "let UID = sessionStorage.getItem('userId');";
	echo 'window.history.back();';
	echo "</script>";
}
