<?
// header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');
include 'predictClass.php';
include 'eventClass.php';
/*
$PIO = new Event($machineUrl."event.php");

$entityId = 'u234'; //lastId (u + 회원 idx)
$PIO -> setUser($entityId);

$message = $PIO->event();
$message = json_decode($message); //디코딩 후 stdObject로 반환
echo $message->eventId."<br/>"; //성공 한 경우 eventId 반환
echo $message->message."<br/>"; //실패 시 에러 메시지 반환 (성공 할 경우 null)
*/

$PIO = new Predict($machineUrl."predict.php");
//$user = 'u1'; //유저 코드
//$num = 5; //추천받을 개수
$user = 'u1';
$num = 5;
$PIO -> setPredict($user, $num);

$message = $PIO->predict();
$resultJson = json_decode($message); //디코딩 후 stdObject로 반환

print_r($resultJson);

//$searchArr = array();

//for($i=0;$i<count($resultJson->itemScores);$i++){
	// echo $resultJson->itemScores[$i]->item."<br/>";
  //$searchArr[$i] = $resultJson->itemScores[$i]->item;
	//$itemCode[$i] = mb_substr($resultJson->itemScores[$i]->item,1);
//}

// print_r($searchArr);

//$inString = implode (",", $searchArr); //순위대로 아이템 넘버 정렬
//echo $inString;
// where a in()



/*
"d1","t2","a1","b1"


i1
i33
i9

없는 유저 코드는 인기 상품을 보여주게 되는데
카테고리를 추가적으로 보내도 카테고리를 적용해서 예측하지 않는다

http://192.168.56.1:7070/events.json?accessKey=ibWRlqjmIuu7pWykNQSQnXRtEtQI63OkvqE8gjoN09YR3ovXTh5xTnql-0qTzPrt&limit=-1&entityType=item
*/
?>
