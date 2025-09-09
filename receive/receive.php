
<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once('../common/config.php');


if (!isset($_SESSION['id'])) {
    echo "<script>";
    echo "alert('로그인 상태가 아닙니다. 로그인 페이지로 이동합니다.');";
    // echo "window.location.replace = 'http://localhost:8088/login/login.php';";
    echo "</script>";
    header("Location: login/login.php");
    exit;
}


$user_id = $_SESSION['id'];
$service = '';
$sql = "SELECT * FROM las_tool_user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $service = $row['service'];
    $coin = $row['coin'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/receive.css">
    <title>Activation Number</title>
</head>

<body>
    <header>

    </header>
    <main>
        <section class="user_info">
            <div> <?php echo $service . " _ " . $user_id; ?> 님 환영합니다.</div>
            <div>
                <span>발급가능 : <?php echo $coin ?></span>
                <form action="/receive/receive_proc.php" method="post" target="hidden_iframe" onsubmit="showMessage();">
                    <input type="hidden" name="user_id" value="<?php $user_id ?>">
                    <input type="hidden" name="service" value="<?php $service ?>">
                    <button type="submit">번호발급</button>
                </form>
            </div>
        </section>
        <iframe name="hidden_iframe" style="display:none;"></iframe>
        <section class="activation_info">
            <div id="copyMessage">복사되었습니다!</div>
            <table>
                <thead>
                    <tr>
                        <th>받는사람</th>
                        <th>서비스</th>
                        <th>인증번호</th>
                        <th>사용자명</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody id="rst">
                </tbody>
            </table>
        </section>
    </main>
    <footer>

    </footer>
    <script>
        function showMessage() {
            alert("폼이 제출되었습니다! 작업이 완료되면 자동으로 반영됩니다.");
        }

        setInterval(function() {
            $.ajax({
                url: 'https://oa1sms.iwinv.net/receive/sms_not_receive.php',
                type: 'GET',
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.error('Error: ' + error); // 오류 처리
                }
            });
        }, 60000); // 3분마다 실행 (180000ms = 1분)
    </script>
    <script src="../assets/js/receive.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>