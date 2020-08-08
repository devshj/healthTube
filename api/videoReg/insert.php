<?
include '../dbconn.php';
include '../pio/predictClass.php';
include '../pio/eventClass.php';

$conn = new DBC();

$PIO = new Event($machineUrl."event.php");

if(isset($_POST['category_purpose'])){
  $category_purpose = $_POST['category_purpose'];
}
if(isset($_POST['category_body'])){
  $category_body = $_POST['category_body'];
}
if(isset($_POST['category_equipment'])){
  $category_equipment = $_POST['category_equipment'];
}
if(isset($_POST['videoId'])){
  $videoId = $_POST['videoId'];
}
if(isset($_POST['title'])){
  $title = $_POST['title'];
}
if(isset($_POST['description'])){
  $description = $_POST['description'];
}
if(isset($_POST['channel'])){
  $channel = $_POST['channel'];
}
if(isset($_POST['channelId'])){
  $channelId = $_POST['channelId'];
}
if(isset($_POST['thumb'])){
  $thumb = $_POST['thumb'];
}

switch($_POST['category_purpose']) {
  case '바디빌딩':
  $p_id = 'p1';
  break;

  case '피트니스':
  $p_id = 'p2';
  break;

  case '다이어트':
  $p_id = 'p3';
  break;
}

switch($_POST['category_body']) {
  case '어깨':
  $b_id = 'u1';
  break;

  case '가슴':
  $b_id = 'u2';
  break;

  case '등':
  $b_id = 'u3';
  break;

  case '이두':
  $b_id = 'u4';
  break;

  case '삼두':
  $b_id = 'u5';
  break;

  case '엉덩이':
  $b_id = 'd1';
  break;

  case '허벅지':
  $b_id = 'd2';
  break;

  case '종아리':
  $b_id = 'd3';
  break;

  case '복근':
  $b_id = 'b1';
  break;

  case '허리':
  $b_id = 'b2';
  break;
}

switch($_POST['category_equipment']) {
  case '있음':
  $e_id = 'e1';
  break;

  case '없음':
  $e_id = 'e2';
  break;
}

$length = 1;

$list = '122333445';
$listLength = strlen($list);
$strength = '';
for($i=0; $i<$length; $i++){
  $strength .= $list[rand(0, $listLength - 1)];
}

try{
  $conn->DBI();
  $sql = "
  INSERT INTO Heal_video(video_id, title, content, date, category_body, category_equipment, body_id, equipment_id, strength, thumb, category_purpose, purpose_id)
  VALUES('".$videoId."','".$title."','".$description."','".date("Y-m-d H:i:s")."','".$category_body."','".$category_equipment."',
  '".$b_id."','".$e_id."','".$strength."','".$thumb."','".$category_purpose."','".$p_id."')
  ";
  $conn->DBQ($sql);
  $conn->DBE();

  $sql = "select * from Heal_video order by idx desc limit 1";
  $conn->DBQ($sql);
  $conn->DBE();
  $row=$conn->DBF();

  if($_SESSION['idx'] != null){
    $entityId = 'i'.$row['idx']; //lastId (i + 영상 idx)
    $categories = array("".$p_id."","".$b_id."","".$e_id."");
    $PIO->setItem($entityId, $categories);

    // $message = $PIO->event();
    // $message = json_decode($message); //디코딩 후 stdObject로 반환
    // echo $message->eventId."<br/>"; //성공 한 경우 eventId 반환
    // echo $message->message."<br/>"; //실패 시 에러 메시지 반환 (성공 할 경우 null)
  }

} catch(PDOException $e){
  echo "Error: " . $e->getMessage();
}
?>
