<?php
/*
@class predict 
@date 2019 05 21
@author Shin Hyen Jun
@brief prediction IO Predict API

[사용법]
1. 객체를 생성해 줍니다. (생성 시 API url을 매개변수로 전달)
$PIO = new predict($machineUrl."predict.php");

2. 추천 데이터 세팅.
*추천
$user = 'u1'; //유저 코드
$num = 5; //추천받을 개수
$PIO -> setPredict($user, $num);

*카테고리를 이용한 추천
$user = 'u1'; //유저 코드
$num = 5; //추천받을 개수
$categories = array("d1","t1"); //카테고리
$PIO -> setPredictCate($user, $num, $categories);

3. API 서비스 요청
$message = $PIO->predict();	
$resultJson = json_decode($message); //디코딩 후 stdObject로 반환
print_r($message);

for($i=0;$i<count($resultJson->itemScores);$i++){
	echo "상품 : ".$resultJson->itemScores[$i]->item." (예측점수 : ".$resultJson->itemScores[$i]->score.")<br/>";
	//$itemCode[$i] = mb_substr($resultJson->itemScores[$i]->item,1);
}
	
//$inString = implode (",", $itemCode); //순위대로 아이템 넘버 정렬
//echo $inString;
*/
//header('Content-Type: application/json');
include 'machineInfo.php';
header('Content-Type: text/html; charset=UTF-8');

class predict
{
	private $setJson, $url;

	public function __construct($url) 
	{
		$this->url = $url;
	}

	public function setPredict($user, $num)
	{
		$this->setJson = array(
														'accessKey' => 'ibWRlqjmIuu7pWykNQSQnXRtEtQI63OkvqE8gjoN09YR3ovXTh5xTnql-0qTzPrt', 
														'user'=>  $user, 
														'num'=> (int)$num
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function setPredictCate($user, $num, $categories)
	{
		$this->setJson = array(
														'accessKey' => 'ibWRlqjmIuu7pWykNQSQnXRtEtQI63OkvqE8gjoN09YR3ovXTh5xTnql-0qTzPrt', 
														'user'=> $user, 
														'num'=> (int)$num,
														'categories' => $categories
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function getEvent()
	{
	 return $this->setJson;
	}

	public function predict()
	{
		$ch = curl_init(); //핸들러 초기화
		curl_setopt($ch, CURLOPT_URL, $this->url); //URL 지정
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //필수
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //결과값을 return하게 되어 변수에 저장 가능
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->setJson); //POST로 보낼 데이터 지정하기
		curl_setopt($ch, CURLOPT_POST, true); //0이 default 값이며 POST 통신을 위해 1로 설정
		$response = curl_exec($ch);
		curl_close ($ch);
		return $response;
	}
}
?>