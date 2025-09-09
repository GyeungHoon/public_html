<?php
    require_once('../common/config.php');
    // 175.196.164.90 안
    // 125.132.254.119 ㅈ
    // 211.54.90.64 이


// 허용할 IP 주소 목록
$allowed_ips = array(
	// '175.196.164.90', // 안산
	'180.81.139.38', // 송도
	'125.132.254.119',//ㅈ
	'218.146.63.218', //부천 고객
	'112.159.6.182', //부천 고객
	'220.120.95.178', //최슨생
	'211.54.90.64', //이천
	'175.210.235.239',//부천
	'124.52.39.170', //용인
	'39.125.121.102'//아스콧 임시 IP
);

    // 접속자의 IP 주소
    $visitor_ip = $_SERVER['REMOTE_ADDR'];

    // 접속자 IP가 허용된 IP 목록에 없는 경우 차단
    if (!in_array($visitor_ip, $allowed_ips)) {
        // 접근 거부 메시지 출력
        die('Access Denied');
    }
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/signup.css">
     <link rel="icon" href="../../assets/images/favicon_io/favicon-32x32.png" type="image/x-icon">
</head>
<body>
     <main>
          <form action="select_query_proc.php" method="post">
               <input type="hidden" name = "hCode" value="Insert" >
               
               <h2>SIGN UP</h2>
               <?php if (isset($_POST['error'])) { ?>
                    <p class="error"><?php echo $_POST['error']; ?></p>
               <?php } ?>

               <?php if (isset($_POST['success'])) { ?>
                    <p class="success"><?php echo $_POST['success']; ?></p>
               <?php } ?>

               <label>고객명(고객사)</label>
               <?php if (isset($_POST['name'])) { ?>
                    <input type="text" 
                         name="name" 
                         placeholder="Name"
                         value="<?php echo $_POST['name']; ?>"><br>
               <?php }else{ ?>
                    <input type="text" 
                         name="name" 
                         placeholder="Name"><br>
               <?php }?>

               <label>ID</label>
               <?php if (isset($_POST['uname'])) { ?>
                    <input type="text" 
                         name="uname" 
                         placeholder="User Name"
                         value="<?php echo $_POST['uname']; ?>"><br>
               <?php }else{ ?>
                    <input type="text" 
                         name="uname" 
                         placeholder="User Name"><br>
               <?php }?>


               <label>Password</label>
               <input type="password" 
                    name="password" 
                    placeholder="Password"><br>

          

               <button type="submit">Sign Up</button>
               
          </form>
     </main>
</body>
</html>