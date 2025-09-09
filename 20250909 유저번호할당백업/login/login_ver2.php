
<html>

<head>
	<title>LOGIN</title>
	<link rel="icon" href="../assets/images/favicon_io/android-chrome-512x512.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
</head>

<body>
	<main>
		<form name="loginForm" action="login_proc_ver2.php" method="post">
			<h2>LOGIN</h2>

			<label>User ID</label>
			<input type="text" name="uname" placeholder="User Name"><br>
			<label>Password</label>
			<input type="password" name="password" placeholder="Password"><br>


			<div>
				<span>
					<label class="id_label" for="saveId">아이디 기억하기</label>
					<input type="checkbox" id="saveId" name="saveId">
				</span>
				<span>
					<label class="pw_label" for="savePassword">비밀번호 기억하기</label>
					<input type="checkbox" id="savePassword" name="savePassword">
				</span>
			</div>
			<button onClick="login()">로그인</button>
		</form>
	</main>


	<script>
		function setCookie(name, value, expiredays) {
			var todayDate = new Date();
			todayDate.setDate(todayDate.getDate() + expiredays);
			document.cookie = name + "=" + escape(value) + "; path=/; expires=" +
				todayDate.toGMTString() + ";"
		}

		function getCookie(name) {
			var search = name + "=";
			if (document.cookie.length > 0) {
				offset = document.cookie.indexOf(search);
				if (offset != -1) {
					offset += search.length;
					end = document.cookie.indexOf(";", offset);
					if (end == -1)
						end = document.cookie.length;
					return unescape(document.cookie.substring(offset, end));
				}
			}
		}

		function login() {
			if (document.loginForm.saveId.checked === true) {
				setCookie("id", document.loginForm.uname.value, 30);
			} else {
				setCookie("id", document.loginForm.uname.value, 0);
			}

			if (document.loginForm.savePassword.checked === true) {
				setCookie("password", document.loginForm.password.value, 30);
			} else {
				setCookie("password", document.loginForm.password.value, 0);
			}

			document.loginForm.method = "post";
			document.loginForm.action = "login_proc_ver2.php";
			document.loginForm.submit();
		}


		window.onload = function() {
			if (getCookie("id")) {
				document.loginForm.uname.value = getCookie("id");
				document.loginForm.saveId.checked = true;
			}
			if (getCookie("password")) {
				document.loginForm.password.value = getCookie("password");
				document.loginForm.savePassword.checked = true;
			}
		}
	</script>
</body>

</html>