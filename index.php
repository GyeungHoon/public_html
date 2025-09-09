<?php
    require_once('common/config.php');
    // 175.196.164.90 안
    // 125.132.254.119 ㅈ
    // 211.54.90.64 이

// 허용할 IP 주소 목록
// $allowed_ips = array(
// 	// '175.196.164.90', // 안산
// 	'180.81.139.38', // 송도 C
// 	'125.132.254.119',//ㅈ
// 	'218.146.63.218', //부천 고객
// 	'112.159.6.182', //부천 고객
// 	'220.120.95.178', //최슨생
// 	'211.54.90.64', //이천 D
// 	'175.210.235.239',//부천
// 	'124.52.39.170', //용인 A
// 	'39.125.121.102'//아스콧 임시 IP  BT
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
	<?php require_once('common/config.php');
	session_start();
	if (!isset($_SESSION['id'])) {
		echo "
		    <script>
		        window.alert('로그인 후 이용해주세요');
		        location.href = 'https://oa1sms.iwinv.net/login/login.php';
		    </script>";
		header("Location: https://oa1sms.iwinv.net/login/login.php");
		exit();
	}
	?>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>SMS INBOUND</title>
	<link rel="stylesheet" href="/assets/css/reset.css">
	<link rel="stylesheet" href="/assets/css/index.css">
	<link rel="icon" href="../../assets/images/favicon_io/favicon-32x32.png" type="image/x-icon">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
	<div class="websms">
		<h2 class="ir_su">SMS INBOUND</h2>
		<div class="rst02">
			<table>
				<thead>
					<tr>
						<th>수신시간</th>
						<th>보낸사람</th>
						<th>받은사람</th>
						<th>기기명</th>
						<th>문자내용</th>
					</tr>
				</thead>
				<tbody id="rst">
				</tbody>
			</table>
		</div>
	</div>
	<script src="/assets/js/index.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		fun_load();

		setInterval(function() {
			location.reload();
		}, 300000); // 5분마다 새로고침
	</script>
</body>

</html>