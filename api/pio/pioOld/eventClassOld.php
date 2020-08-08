<?php
//header('Content-Type: application/json');
class event
{
	//element = {event($set, view, buy), entityType(user, item), entityId, eventTime, properties, targetEntityType(item), targetEntityId}
	private $event, $entityType, $entityId, $eventTime, $properties, $targetEntityType, $targetEntityId, $setJson, $url;
/*	
	public function __construct($url) 
	{
		$this->url = $url;
		$this->setJson = array(
											'event' => '$set',
											'entityType' => 'user',
											'entityId' => 't3',
											'eventTime' => date("c")
										);
		$this->setJson = json_encode($this->setJson);
	}
*/

	public function __construct($url) 
	{
		$this->url = $url;
		$this->setJson = array(
											'event' => '$set',
											'entityType' => 'item',
											'entityId' => 's12',
											'properties' => [
												"categories" => ["d9","t9","a9","b9"]
											],
											'eventTime' => date("c")
										);
		$this->setJson = json_encode($this->setJson);
	}


	public function setEvent($event)
	{
	 $this->event = (string)$event;
	}

	public function getEvent()
	{
	 return $this->event;
	}

	public function event()
	{
		//$url = "http://63c24916.ngrok.io/event.php";
		//$url = "http://63c24916.ngrok.io/predict.php";	
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

	$PIO = new event("http://9fd6486d.ngrok.io/event.php");
	$message = $PIO->event();
	//print_r($PIO->event());
	
	$message = json_decode($message); //디코딩 후 stdObject로 반환
	echo $message->eventId."<br/>";
	echo $message->message."<br/>";
/*
setUser()
{
  "event" : "$set",
  "entityType" : "user", (o)
  "entityId" : "u0",
  "eventTime" : "2014-11-02T09:39:45.618-08:00"
}

setItem()
{
  "event" : "$set",
  "entityType" : "item", (o)
  "entityId" : "i0", 
  "properties" : {
    "categories" : ["c1", "c2"]
  }
  "eventTime" : "2014-11-02T09:39:45.618-08:00"
}

setView()
{
  "event" : "view",
  "entityType" : "user",
  "entityId" : "u0",
  "targetEntityType" : "item",
  "targetEntityId" : "i0",
  "eventTime" : "2014-11-10T12:34:56.123-08:00"
}

setBuy()
{
  "event" : "buy",
  "entityType" : "user",
  "entityId" : "u0",
  "targetEntityType" : "item",
  "targetEntityId" : "i0",
  "eventTime" : "2014-11-10T13:00:00.123-08:00"
}
*/
?>