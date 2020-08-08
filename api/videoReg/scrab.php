<?
include '../dbconn.php';
include '../pio/predictClass.php';
include '../pio/eventClass.php';

$conn = new DBC();
$conn->DBI();

$PIO = new Event($machineUrl."event.php");

switch($_POST['compare']){
  case 'ins':
  $sql = "select idx from Heal_member where id = '".$_SESSION['id']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  $row=$conn->DBF();

  $sql = "select * from Heal_scrab where video_idx = '".$_POST['no']."' and member_idx = '".$row[0]."'";
  $conn->DBQ($sql);
  $conn->DBE();
  $res=$conn->resultRow();

  if($res == 0){
    $sql = "insert into Heal_scrab(member_idx, video_idx, date)
    values('".$row[0]."','".$_POST['no']."','".date('Y-m-d')."')";
    $conn->DBQ($sql);
    $conn->DBE();
  }else{
    $sql = "update Heal_scrab set flag = 1 where video_idx = '".$_POST['no']."'";
    $conn->DBQ($sql);
    $conn->DBE();
  }

  if($_SESSION['idx'] != null){
    $entityId = 'u'.$_SESSION['idx']; //lastId (u + 회원 idx)
    $targetEntityId = 'i'.$_POST['no']; //lastId (i + 영상 idx)
    $PIO->setBuy($entityId, $targetEntityId);

    $message = $PIO->event();
  }

  ?>
  <script type="text/javascript">
  location.href="../../videoDetail.php?no=<?echo $_POST['no'];?>";
  </script>
  <?
  break;

  case 'del':
  $sql = "update Heal_scrab set flag = 0 where video_idx = '".$_POST['no']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  ?>
  <script type="text/javascript">
  location.href="../../videoDetail.php?no=<?echo $_POST['no'];?>";
  </script>
  <?
  break;
}
?>
