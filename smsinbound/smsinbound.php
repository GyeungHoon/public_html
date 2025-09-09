<?php
	// POST로 들어온 데이터 JSON 디코드?????
	$data = json_decode(file_get_contents('php://input'), true);
	

    // 데이터 유효성 검사
    if (empty($data["date"]) || empty($data["from"]) || empty($data["to"]) || empty($data["message"]) || empty($data["androidId"])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid input data."]);
        exit;
    }


	// 불필요한 앱꼬리 문구 삭제
	$data["message"] = preg_replace("'\n\n---------------------------------------------------------------------\s\[문자자동전달\]\s앱에서\s발송하였습니다\. \nSend\sfrom\s\[문자자동전달\]\sApp\n--------------------------------------------\srain5neyo@sooft\s--------'", "", $data["message"]);
	
	
	//디버깅용도 (삭제 해도 이슈 없음)
	//print_r($data);
	//echo $data["date"];
	//echo "<br>";
	//echo $data["from"];
	//echo "<br>";
	//echo $data["to"];
	//echo "<br>";
	// echo $data["message"];
	
	//echo "<br>";
	//echo "<br>";
	//echo "<br>";
	//echo "<br>";
	//echo $data["message"];
	//디버깅용 끝 (삭제 해도 이슈 없음)
	
	
	
	
	//변수 저장
	$date = $data["date"];
	$from = $data["from"];
	$to = $data["to"];
	$message = $data["message"];
	$androidId = $data["androidId"];
	
	//echo "<br>";
	//echo $data["androidId"];
	
	//메시지함수에서 인증번호 시작자리 찾기, 찾은 후 +6자리 추출, ATH_NO변수에 넣기
	//echo strpos($message,"인증번호:")."번째";
	//echo substr($message,strpos($message,":")+1,6);


	$passcode_temp1 = strpos($message,"인증번호:");
	$passcode_temp2 = substr($message,$passcode_temp1,20);
	$passcode = preg_replace("/[^0-9]/", "",$passcode_temp2);
	// echo $passcode;

	
	//DB INSERT
	//$conn = mysqli_connect("primedb.sldb.iwinv.net", "admin_web_sms", "DBVMware1!", "IC_WEB_SMS_IN");


    // 클라이언트 IP 확인 (안산 이천 공통으로 사용하려고 임시로 설정)
    $client_ip = $_SERVER['REMOTE_ADDR'];


    // 데이터베이스 연결
    $conn1 = mysqli_connect("primedb.sldb.iwinv.net", "admin_web_sms", "DBVMware1!", "WEB_SMS_IN");
    $conn2 = mysqli_connect("primedb.sldb.iwinv.net", "admin_web_sms", "DBVMware1!", "IC_WEB_SMS_IN");


	//이유는 모르겠으나 컬럼명까지 작성하면 Insert가 안됨...;; from컬럼명에 뭔가 제약이 있는건지..?
	$sql  = "
	INSERT INTO maintable (
        date,
        `from`,
        `to`,
        message,
        ATH_NO,
        androidId
    ) VALUES (
        '$date',
        '$from',
        '$to',
        '$message',
		'$passcode',
		'$androidId'
    )";



    if ($client_ip === '175.196.165.13') {
        // WEB_SMS_IN에 INSERT
        $result1 = mysqli_query($conn1, $sql);
        if ($result1 === false) {
            echo "WEB_SMS_IN Error: " . mysqli_error($conn1);
        }

        // IC_WEB_SMS_IN에도 INSERT
        $result2 = mysqli_query($conn2, $sql);
        if ($result2 === false) {
            echo "IC_WEB_SMS_IN Error: " . mysqli_error($conn2);
        }
    } else {
        // 기본적으로 IC_WEB_SMS_IN에만 INSERT
        $result = mysqli_query($conn2, $sql);
        if ($result === false) {
            echo "IC_WEB_SMS_IN Error: " . mysqli_error($conn2);
        }
    }

    // 데이터베이스 연결 닫기
    mysqli_close($conn1);
    mysqli_close($conn2);
	




?>





