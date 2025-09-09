<?php
require_once('../common/config.php');
// 175.196.164.90 안
// 125.132.254.119 ㅈ
// 211.54.90.64 이

// // 허용할 IP 주소 목록
// $allowed_ips = array(
// 	// '175.196.164.90', // 안산
// 	'180.81.139.38', // 송도
// 	'125.132.254.119', //ㅈ
// 	'218.146.63.218', //부천 고객
// 	'112.159.6.182', //부천 고객
// 	'220.120.95.178', //최슨생
// 	'211.54.90.64', //이천
// 	'175.210.235.239', //부천
// 	'124.52.39.170', //용인
// 	'39.125.121.102' //아스콧 임시 IP
// );

// // 접속자의 IP 주소
// $visitor_ip = $_SERVER['REMOTE_ADDR'];

// // 접속자 IP가 허용된 IP 목록에 없는 경우 차단
// if (!in_array($visitor_ip, $allowed_ips)) {
// 	// 접근 거부 메시지 출력
// 	die('Access Denied');
// }
?>
<html>

<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/select_query.css">
	<link rel="icon" href="../../assets/images/favicon_io/favicon-32x32.png" type="image/x-icon">
	<?php require_once('../common/config.php'); ?>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<?php
	session_start();


	$sql = "SELECT * from member where idx != 1";
	$result = mysqli_query($conn, $sql);
	$totalUser = 0;
	$sql_login_chk = "select * from member where idx = '1' ";
	$result_login_chk = mysqli_query($conn, $sql_login_chk);
	//   $rs_login_chk = mysqli_fetch_array($result_login_chk);


	while ($rs = mysqli_fetch_array($result_login_chk)) {
		if ($_SESSION['login_log'] !== $rs['login_log'] || $_SESSION['login_log'] == '') {
			echo '<script type="text/javascript">';
			echo 'alert("비정상적인 로그인 시도");';
			echo 'window.location.href = "../login/login.php";';
			echo '</script>';
		}

		// if ($_GET['key'] !== $rs['login_log']) {
		// 	echo '<script type="text/javascript">';
		// 	echo 'alert("비정상적인 로그인 시도");';
		// 	echo 'window.location.href = "../login/login.php";';
		// 	echo '</script>';
		// }

	}





	?>
</head>

<body>
	<main>
		<div class="topSection">
			<section class="userManagement">
				<h2 class="ir_su">고객관리박스</h2>
				<div class="ufSelect">
					<h3 class="ir_su">고객 및 플랫폼 선택박스</h3>
					<form action="#">
						<label class="ir_su" for="user">사용자목록</label>
						<select name="user" id="user">
							<option selected disabled>고객을 선택해주세요.</option>
							<?php while ($rs = mysqli_fetch_array($result)) {
								if ($totalUser <= count($rs)) {
									$totalUser++;
								}
							?>
								<option value="<?= $rs['idx'] ?>"><?= $rs['name'] ?>/<?= $rs['id'] ?></option>
							<?php } ?>
						</select>

						<label class="ir_su" for="type">문자종류목록</label>
						<select name="type" id="type">
							<option selected disabled>문자종류를 선택해주세요.</option>
							<option value="라스">라스 문자</option>
							<option value="네이버">네이버 문자</option>
							<option value="당근마켓">당근마켓 문자</option>
							<option value="카카오톡">카카오톡 문자</option>
							<option value="라인">라인 문자</option>
							<option value="텔레그램">텔레그램 문자</option>
							<option value="밴드">밴드 문자</option>
							<option value="구글">구글 문자</option>
							<option value="리니지">리니지 문자</option>
							<option value="에오스">에오스 문자</option>
							<option value="인스타그램">인스타그램 문자</option>
							<option value="틱톡">틱톡 문자</option>
							<option value="쿠팡">쿠팡 문자</option>
						</select>
						<button type="button" onclick="search();">완료</button>
					</form>
				</div>
				<div class="userAdd">
					<button type="button" onClick="location.href='/admin_hi/signup.php'"> 고객등록</button>
				</div>
				<div class="userLogout">
					<button type="button" onClick="location.href='/admin_hi/select_query_proc.php?hCode=logout'"> 로그아웃</button>
				</div>
				<div class="totalUser">
					<span>현재 등록된 고객수 : <?= $totalUser ?></span>
				</div>

				<!-- 별칭 시작순서 조작 -->
				<!-- <div class="inputNum">
					<form method="get" action="/task_order/task_order_proc.php">
					<label for="inputNum">별칭시작번호 </label>
					<input type="number" name="inputNum" value="1" min="1" max="400">
					<button type="submit" value="전송"> 전송 </button>
					</form>
				</div> -->


				<!-- coin  -->

				<?php
				$sql = "SELECT * from las_tool_user ORDER BY name ASC";
				$result = mysqli_query($conn, $sql);
				?>

				<div class="coinAdd">
					<form method="get" action="/admin_hi/coin_qeury_proc.php">
						<label for="coinAddNum">코인추가</label>
						<select name="coinAddUser" id="coinAddUser">
							<option selected disabled>고객을 선택해주세요.</option>
							<?php
							while ($rs = mysqli_fetch_array($result)) {
							?>
								<option title="계정 : <?= $rs['user_id'] ?>" value="<?= $rs['no'] ?>"> <?= $rs['service'] ?> | <?= $rs['name'] ?> | 잔여코인 : <?= $rs['coin'] ?> </option>
							<?php } ?>
						</select>
						<input type="number" name="coinAddNum" id="coinAddNum" min="1" max="9999">
						<button type="submit">완료</button>
					</form>
				</div>


				<?php
				$sql = "SELECT * from las_tool_user ORDER BY name ASC";
				$result = mysqli_query($conn, $sql);
				?>
				<div class="coinMinus">
					<form method="get" action="/admin_hi/coin_qeury_proc.php">
						<label for="coinMinusNum">코인제거</label>
						<select name="coinMinusUser" id="coinMinusUser">
							<option selected disabled>고객을 선택해주세요.</option>
							<?php
							while ($rs = mysqli_fetch_array($result)) {
							?>
								<option title="계정 : <?= $rs['user_id'] ?>" value="<?= $rs['no'] ?>"> <?= $rs['service'] ?> | <?= $rs['name'] ?> | 잔여코인 : <?= $rs['coin'] ?> </option>
							<?php } ?>
						</select>
						<input type="number" name="coinMinusNum" id="coinMinusNum" min="1" max="9999">
						<button type="submit">완료</button>
					</form>
				</div>

				<?php
				$sql = "SELECT * from las_tool_user_history ORDER BY name ASC";
				$result = mysqli_query($conn, $sql);
				?>
				<div class="coin_history_info">
					<h3>코인이력</h3>
					<div>
						<?php
						while ($rs = mysqli_fetch_array($result)) {
							// if($rs['name'] !== '텔레생성용_내부용' && $rs['name'] !== '카카오발송팀'){}
						?>
							<div><span>닉네임 : <?= $rs['name'] ?></span> &nbsp; <span>이전코인 : <?= $rs['old_coin'] ?></span> &nbsp; <span>현재코인 : <?= $rs['new_coin'] ?></span></div>
						<?php } ?>
					</div>
				</div>
				<!-- /coin  -->


			</section>
			<section class="userList">
				<h2 class="ir_su">고객 및 플랫폼 목록</h2>
				<?php
				$sql = "SELECT * from member where idx != 1";
				$result = mysqli_query($conn, $sql);
				$userNum = 0;
				?>
				<ul>
					<?php while ($rs = mysqli_fetch_array($result)) {
						if ($userNum <= count($rs)) {
							$userNum++;
						}
					?>
						<li><?= $userNum ?>. <span><?= $rs['name'] ?></span> 고객명 (ID : <?= $rs['id'] ?> ) 현재 <span><?= $rs['state'] ?></span> 만 보여지는 중 <span class="userIdx"></span></li>
						<button type="button" onClick="location.href='/admin_hi/select_query_proc.php?hCode=Delete&idx=<?= $rs['idx'] ?>'">고객삭제</button>
						<hr />
					<?php } ?>
				</ul>
			</section>

		</div>

		<!-- 번호 waiting -->
		<!-- 번호 waiting 추가 -->
		<section class="towerSection">
			<div class=towerAdd>
				<h3>웨이팅 추가</h3>
				<div>
					<div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumLas"><span>* </span>라이브스코어</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumLas" id="TowerWaitingNumLas"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTelegram"><span>* </span>텔레그램</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTelegram" id="TowerWaitingNumTelegram"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>



						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCarrot"><span>* </span>당근마켓</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCarrot" id="TowerWaitingNumCarrot"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumLine"><span>* </span>라인</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumLine" id="TowerWaitingNumLine"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumNaver"><span>* </span>네이버</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumNaver" id="TowerWaitingNumNaver"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCoupang"><span>* </span>쿠팡</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCoupang" id="TowerWaitingNumCoupang"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCarrotCheck"><span>* </span>당근마켓체크</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCarrotCheck" id="TowerWaitingNumCarrotCheck"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

					</div>
					<div>


						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumGoogle"><span>* </span>구글</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumGoogle" id="TowerWaitingNumGoogle"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumGangnamunni"><span>* </span>강남언니</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumGangnamunni" id="TowerWaitingNumGangnamunni"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumNcsoft"><span>* </span>엔씨소프트</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumNcsoft" id="TowerWaitingNumNcsoft"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumInstagram"><span>* </span>인스타그램</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumInstagram" id="TowerWaitingNumInstagram"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTiktok"><span>* </span>틱톡</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTiktok" id="TowerWaitingNumTiktok"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerAddWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTelegramCheck"><span>* </span>텔레그램체크</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTelegramCheck" id="TowerWaitingNumTelegramCheck"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>


					</div>
				</div>
			</div>
			<!-- 번호 waiting 추가 끝 -->


			<!-- 번호 waiting 제거 -->
			<div class="towerDelete">
				<h3>웨이팅 제거</h3>
				<div>
					<div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumLas"><span>* </span>라이브스코어</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumLas" id="TowerWaitingNumLas"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTelegram"><span>* </span>텔레그램</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTelegram" id="TowerWaitingNumTelegram"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>


						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCarrot"><span>* </span>당근마켓</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCarrot" id="TowerWaitingNumCarrot"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumLine"><span>* </span>라인</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumLine" id="TowerWaitingNumLine"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumNaver"><span>* </span>네이버</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumNaver" id="TowerWaitingNumNaver"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCoupang"><span>* </span>쿠팡</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCoupang" id="TowerWaitingNumCoupang"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumCarrotCheck"><span>* </span>당근마켓체크</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumCarrotCheck" id="TowerWaitingNumCarrotCheck"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
					</div>
					<div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumGoogle"><span>* </span>구글</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumGoogle" id="TowerWaitingNumGoogle"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumGangnamunni"><span>* </span>강남언니</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumGangnamunni" id="TowerWaitingNumGangnamunni"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumNCsoft"><span>* </span>엔씨소프트</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumNcsoft" id="TowerWaitingNumNcsoft"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumInstagram"><span>* </span>인스타그램</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumInstagram" id="TowerWaitingNumInstagram"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>

						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTiktok"><span>* </span>틱톡</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTiktok" id="TowerWaitingNumTiktok"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>
						<div class="TowerWaiting">
							<form method="post" action="/admin_hi/towerDeleteWaiting_proc.php">
								<div class="dust-class">
									<label for="TowerWaitingNumTelegramCheck"><span>* </span>텔레그램체크</label>
									<textarea class="txt-input" type="text" name="TowerWaitingNumTelegramCheck" id="TowerWaitingNumTelegramCheck"></textarea>
								</div>
								<button type="submit">완료</button>
							</form>
						</div>


					</div>
				</div>
			</div>
		</section>
		<!-- 번호 waiting 제거 끝 -->
		<!-- /번호 waiting -->



		<section class="numberUpdate">
			<div class=phoneNumber>
				<h3>고객계정 번호업데이트</h3>
				<div>
					<?php
					$sql = "SELECT * from member ORDER BY name ASC";
					$result = mysqli_query($conn, $sql);
					?>
					<div class="numberUpdate_form">
						<form method="post" action="/admin_hi/numberUpdate_proc.php" onsubmit="return validateNumberUpdate()">
							<select name="user" id="user">
								<option selected disabled>고객을 선택해주세요.</option>
								<?php while ($rs = mysqli_fetch_array($result)) {
									if ($totalUser <= count($rs)) {
										$totalUser++;
									}
								?>
									<option value="<?= $rs['idx'] ?>"><?= $rs['name'] ?>/<?= $rs['id'] ?></option>
								<?php } ?>
							</select>

							<div class="dust-class">
								<label for="numberUpdate"><span>* </span>번호덮어쓰기</label>
								<textarea class="txt-input" name="numberUpdate" id="numberUpdate" oninput="this.value = this.value.replace(/[^0-9\n ]/g, '')" placeholder="01012345678&#10;01098765432&#10;01011112222"></textarea>
							</div>
							<button type="submit">완료</button>
						</form>
					</div>
					<?php
					$sql = "SELECT * from member ORDER BY name ASC";
					$result = mysqli_query($conn, $sql);
					?>
					<div class="numberUpdate_form">
						<form method="post" action="/admin_hi/numberUpdate_proc.php" onsubmit="return validateAddNumber()">
							<select name="user" id="user">
								<option selected disabled>고객을 선택해주세요.</option>
								<?php while ($rs = mysqli_fetch_array($result)) {
									if ($totalUser <= count($rs)) {
										$totalUser++;
									}
								?>
									<option value="<?= $rs['idx'] ?>"><?= $rs['name'] ?>/<?= $rs['id'] ?></option>
								<?php } ?>
							</select>
							<div class="dust-class">
								<label for="addnumber"><span>* </span>번호추가</label>
								<textarea class="txt-input" type="text" name="addnumber" id="addnumber" oninput="this.value = this.value.replace(/[^0-9\n ]/g, '')" placeholder="01012345678&#10;01098765432&#10;01011112222"></textarea>
							</div>
							<button type="submit">완료</button>
						</form>
					</div>
					<?php
					$sql = "SELECT * from member ORDER BY name ASC";
					$result = mysqli_query($conn, $sql);
					?>
					<div class="numberUpdate_form">
						<form method="post" action="/admin_hi/numberUpdate_proc.php" onsubmit="return validateDeleteNumber()">
							<select name="user" id="user">
								<option selected disabled>고객을 선택해주세요.</option>
								<?php while ($rs = mysqli_fetch_array($result)) {
									if ($totalUser <= count($rs)) {
										$totalUser++;
									}
								?>
									<option value="<?= $rs['idx'] ?>"><?= $rs['name'] ?>/<?= $rs['id'] ?></option>
								<?php } ?>
							</select>
							<div class="dust-class">
								<label for="deleteNumber"><span>* </span>번호삭제</label>
								<textarea class="txt-input" type="text" name="deleteNumber" id="deleteNumber" oninput="this.value = this.value.replace(/[^0-9\n ]/g, '')" placeholder="01012345678&#10;01098765432&#10;01011112222"></textarea>
							</div>
							<button type="submit">완료</button>
						</form>
					</div>
				</div>
			</div>


			<div class=memberPhoneNumber>
				<h3>고객보유번호</h3>
				<div>
					<?php
					$sql = "SELECT * from member ORDER BY name ASC";
					$result = mysqli_query($conn, $sql);
					?>
					<div class="numberUpdate_form">
						<select name="user" id="user" onchange="showCustomerInfo(this.value)">
							<option selected disabled>고객을 선택해주세요.</option>
							<?php while ($rs = mysqli_fetch_array($result)) {
								if ($totalUser <= count($rs)) {
									$totalUser++;
								}
							?>
								<option value="<?= $rs['idx'] ?>"><?= $rs['name'] ?>/<?= $rs['id'] ?></option>
							<?php } ?>
						</select>
					</div>
										<!-- 고객 정보 표시 영역 -->
						<div id="customerInfo" style="margin-top: 5px; height: 300px; overflow-y: auto; padding: 15px; border: 2px solid #007bff; border-radius: 8px; background-color: #f8f9fa;">
						<h4 style="color: #007bff; margin-bottom: 10px;">고객 정보</h4>
						<div id="customerDetails"></div>
					</div>
				</div>
			</div>

		</section>
	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../assets/js/select_query.js"></script>
	<script>
		// 폼 검증 함수들
		function validateNumberUpdate() {
			const userSelect = document.querySelector('form[onsubmit="return validateNumberUpdate()"] select[name="user"]');
			const numberUpdate = document.querySelector('form[onsubmit="return validateNumberUpdate()"] textarea[name="numberUpdate"]');
			
			if (!userSelect.value || userSelect.value === '') {
				alert('고객을 선택해주세요.');
				return false;
			}
			
			if (!numberUpdate.value.trim()) {
				alert('번호를 입력해주세요.');
				numberUpdate.focus();
				return false;
			}
			
			return true;
		}
		
		function validateAddNumber() {
			const userSelect = document.querySelector('form[onsubmit="return validateAddNumber()"] select[name="user"]');
			const addnumber = document.querySelector('form[onsubmit="return validateAddNumber()"] textarea[name="addnumber"]');
			
			if (!userSelect.value || userSelect.value === '') {
				alert('고객을 선택해주세요.');
				return false;
			}
			
			if (!addnumber.value.trim()) {
				alert('번호를 입력해주세요.');
				addnumber.focus();
				return false;
			}
			
			return true;
		}
		
		function validateDeleteNumber() {
			const userSelect = document.querySelector('form[onsubmit="return validateDeleteNumber()"] select[name="user"]');
			const deleteNumber = document.querySelector('form[onsubmit="return validateDeleteNumber()"] textarea[name="deleteNumber"]');
			
			if (!userSelect.value || userSelect.value === '') {
				alert('고객을 선택해주세요.');
				return false;
			}
			
			if (!deleteNumber.value.trim()) {
				alert('번호를 입력해주세요.');
				deleteNumber.focus();
				return false;
			}
			
			return true;
		}
		
		function showCustomerInfo(idx) {
			console.log('Selected idx:', idx);
			
			if (idx === '' || idx === null) {
				document.getElementById('customerInfo').style.display = 'none';
				return;
			}
			
			// AJAX로 고객 정보 가져오기
			$.ajax({
				url: 'getCustomerInfo.php',
				method: 'POST',
				data: { idx: idx },
				dataType: 'json',
				success: function(response) {
					console.log('AJAX Response:', response);
					
					if (response.success) {
						let html = '<table style="width: 100%; border-collapse: collapse;">';
						html += '<tr><td style="padding: 5px; border: 1px solid #ddd; background: #f0f0f0; font-weight: bold;">이름</td><td style="padding: 5px; border: 1px solid #ddd;">' + (response.data.name || 'N/A') + '</td></tr>';
						html += '<tr><td style="padding: 5px; border: 1px solid #ddd; background: #f0f0f0; font-weight: bold;">ID</td><td style="padding: 5px; border: 1px solid #ddd;">' + (response.data.id || 'N/A') + '</td></tr>';
						html += '<tr><td style="padding: 5px; border: 1px solid #ddd; background: #f0f0f0; font-weight: bold;">상태</td><td style="padding: 5px; border: 1px solid #ddd;">' + (response.data.state || 'N/A') + '</td></tr>';
						html += '<tr><td style="padding: 5px; border: 1px solid #ddd; background: #f0f0f0; font-weight: bold;">전화번호</td><td style="padding: 5px; border: 1px solid #ddd;">' + (response.data.phone_numbers_display || '등록된 번호 없음') + '</td></tr>';
						html += '</table>';
						
						console.log('Setting customerDetails innerHTML');
						const customerDetails = document.getElementById('customerDetails');
						const customerInfo = document.getElementById('customerInfo');
						
						if (customerDetails && customerInfo) {
							customerDetails.innerHTML = html;
							customerInfo.style.display = 'block';
							console.log('Customer info displayed successfully');
							console.log('customerInfo element:', customerInfo);
							console.log('customerInfo display style:', customerInfo.style.display);
							console.log('customerInfo computed style:', window.getComputedStyle(customerInfo).display);
						} else {
							console.log('Elements not found:', {
								customerDetails: !!customerDetails,
								customerInfo: !!customerInfo
							});
						}
					} else {
						console.log('Error:', response.message);
						alert('고객 정보를 가져올 수 없습니다: ' + response.message);
					}
				},
				error: function(xhr, status, error) {
					console.log('AJAX Error:', xhr.responseText);
					alert('오류가 발생했습니다: ' + error);
				}
			});
		}
	</script>
	<script>
		// 콤보박스완료 후 새로고침
		if (!sessionStorage.getItem('refreshed')) {
			sessionStorage.setItem('refreshed', 'true');
		}
		document.addEventListener('visibilitychange', function() {
			if (document.visibilityState === 'visible') {
				if (sessionStorage.getItem('refreshed')) {
					sessionStorage.removeItem('refreshed');
					location.reload();
				}
			}
		});
	</script>
</body>

</html>