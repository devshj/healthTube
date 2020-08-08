<?php
/*
@class event
@date 2019 05 21
@author Shin Hyen Jun
@brief prediction IO Predict API

[사용법]
1. 객체를 생성해 줍니다. (생성 시 API url을 매개변수로 전달)
$PIO = new Event($machineUrl."event.php");

2. 이벤트 데이터 세팅.
*회원가입 시
$entityId = 'userCode'; //lastId (u + 회원 idx)
$PIO -> setUser($entityId);

*영상 등록 시
$entityId = 'videoCode'; //lastId (i + 영상 idx)
$categories = array("d2","t2","a2","b2");
$PIO -> setItem($entityId, $categories);

*회원이 영상 조회 시
$entityId = 'userCode'; //lastId (u + 회원 idx)
$targetEntityId = 'videoCode'; //lastId (i + 영상 idx)
$PIO -> setView($entityId, $targetEntityId);

*회원이 영상 즐겨찾기 시
$entityId = 'userCode'; //lastId (u + 회원 idx)
$targetEntityId = 'videoCode'; //lastId (i + 영상 idx)
$PIO -> setBuy($entityId, $targetEntityId);

*세팅된 json데이터 조회 
print_r($PIO -> getEvent());

3. API 서비스 요청
$message = $PIO->event();	
$message = json_decode($message); //디코딩 후 stdObject로 반환
echo $message->eventId."<br/>"; //성공 한 경우 eventId 반환
echo $message->message."<br/>"; //실패 시 에러 메시지 반환 (성공 할 경우 null)
*/
//header('Content-Type: application/json');
//header('Content-Type: text/html; charset=UTF-8');
include 'machineInfo.php';

class Event
{
	private $setJson, $url;

	public function __construct($url) 
	{
		$this->url = $url;
	}
  
	public function setUser($entityId)
	{
		$this->setJson = array(
														'event' => '$set',
														'entityType' => 'user',
														'entityId' => $entityId,
														'eventTime' => date("c")
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function setItem($entityId, $categories)
	{
		$this->setJson = array(
														'event' => '$set',
														'entityType' => 'item',
														'entityId' => $entityId,
														'properties' => [
															"categories" => $categories
														],
														'eventTime' => date("c")
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function setView($entityId, $targetEntityId)
	{
		$this->setJson = array(
														'event' => 'view',
														'entityType' => 'user',
														'entityId' => $entityId,
														'targetEntityType' => 'item',
														'targetEntityId' => $targetEntityId,
														'eventTime' => date("c")
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function setBuy($entityId, $targetEntityId)
	{
		$this->setJson = array(
														'event' => 'buy',
														'entityType' => 'user',
														'entityId' => $entityId,
														'targetEntityType' => 'item',
														'targetEntityId' => $targetEntityId,
														'eventTime' => date("c")
													);
		$this->setJson = json_encode($this->setJson);
	}

	public function getEvent()
	{
	 return $this->setJson;
	}

	public function event()
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