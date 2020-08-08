<?php
//머신 서버 코드 참고
/*
	$data = file_get_contents('php://input'); 
	$data = json_decode($data); //디코딩 후 stdObject로 반환
  //print_r($data);
	//echo $data->user."<br/>";
	//echo $data->eventTime."<br/>";

	$eventServerUrl = 'http://localhost:7070/events.json';
	//$accessKey = array('accessKey'=>'ibWRlqjmIuu7pWykNQSQnXRtEtQI63OkvqE8gjoN09YR3ovXTh5xTnql-0qTzPrt'); wine
	$accessKey = array('accessKey'=>'qUdgp9kyeG-uT2kl7BTl4H3iI68vWLQSkH3SAIti_6jPr_LyrJBGYoHeTLO0jAr2');

	function event($url, $key, $fields)
	{
		$url = $url.'?'.http_build_query($key, '', '&');
	 
		$ch = curl_init(); //핸들러 초기화
		curl_setopt($ch, CURLOPT_URL, $url); //URL 지정
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //필수
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //결과값을 return하게 되어 변수에 저장 가능
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); //POST로 보낼 데이터 지정하기
		curl_setopt($ch, CURLOPT_POST, true); //0이 default 값이며 POST 통신을 위해 1로 설정
		$response = curl_exec($ch);
		curl_close ($ch);

		return $response;
	}

	$setData = array(
										'event' => '$set',
										'entityType' => 'user',
										'entityId' => 'u1',
										'eventTime' => '12:00'
									);

	$setDataJson = json_encode($setData);

	$result = event($eventServerUrl, $accessKey, $setDataJson);

	$resultJson = json_decode($result);

	$eventId = $resultJson->eventId;
	$message = $resultJson->message; //에러 메시지(트랜잭션 적용 경우 에러 메시지 뜨면 rollback 후 다시 입력해야됨)

	echo $eventId;
	echo $message;
*/
	$data = file_get_contents('php://input'); 
	//$data = json_decode($data); //디코딩 후 stdObject로 반환
  print_r($data);
/*
	$setData = array(
										'event' => '$set',
										'entityType' => 'user',
										'entityId' => 'u1',
										'eventTime' => '12:00'
									);

	$setDataJson = json_encode($setData);
  print_r($setDataJson);
*/
?>