<?
	//header('Content-Type: application/json');
	header('Content-Type: text/html; charset=UTF-8');

	function predict($fields)
	{
		$url = "http://63c24916.ngrok.io/predict.php";
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

  $user = $_GET['user'];
	$num = $_GET['num'];

	$setData = array(  
										'user' => $user,
										'num' => $num
									);
	$setDataJson = json_encode($setData);

	$result = predict($setDataJson);
	
	$resultJson = json_decode($result);
  //print_r($resultJson);

	for($i=0;$i<count($resultJson->itemScores);$i++){
		echo "상품 : ".$resultJson->itemScores[$i]->item." (예측점수 : ".$resultJson->itemScores[$i]->score.")<br/>";
		//$itemCode[$i] = mb_substr($resultJson->itemScores[$i]->item,1);
	}
	
	//$inString = implode (",", $itemCode); 순위대로 아이템 넘버 정렬
	//echo $inString;

/*
	$event = $resultJson->event;
	$entityType = $resultJson->entityType;
	$entityId = $resultJson->entityId;
	$eventTime = $resultJson->eventTime;
  
	echo "<br/>";
	echo $event."  ".$entityType."  ".$entityId."  ".$eventTime;
*/

?>