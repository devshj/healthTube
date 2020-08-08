<?
include '../dbconn.php';
include '../pio/predictClass.php';
include '../pio/eventClass.php';

$conn = new DBC();
$conn->DBI();

$PIO = new Event($machineUrl."event.php");

$sql = "
SELECT a.idx, b.planner_idx
FROM
(
    SELECT idx
    FROM Heal_planner
    WHERE member_idx = '".$_SESSION['idx']."' and date = '".$_POST['date_from']."'
)a
INNER JOIN
(
    SELECT planner_idx
    FROM Heal_planner_video
    WHERE video_idx = '".$_POST['no']."'
)b ON a.idx = b.planner_idx
";
$conn->DBQ($sql);
$conn->DBE();
$res = $conn->resultRow();

if($res == 0){
  $sql = "insert into Heal_planner(member_idx, date) values('".$_SESSION['idx']."','".$_POST['date_from']."')";
  $conn->DBQ($sql);
  $conn->DBE();

  $sql = "select idx from Heal_planner order by idx desc limit 1";
  $conn->DBQ($sql);
  $conn->DBE();
  $row = $conn->DBF();

  $sql = "insert into Heal_planner_video(planner_idx, video_idx) values('".$row[0]."','".$_POST['no']."')";
  $conn->DBQ($sql);
  $conn->DBE();
}

if($_SESSION['idx'] != null){
  $entityId = 'u'.$_SESSION['idx']; //lastId (u + 회원 idx)
  $targetEntityId = 'i'.$_POST['no']; //lastId (i + 영상 idx)
  $PIO->setBuy($entityId, $targetEntityId);
}

  // if($res == 0){
  //   $sql = "insert into Heal_planner_video(planner_idx, video_idx) values('".$row[0]."','".$_POST['no']."')";
  //   $conn->DBQ($sql);
  //   $conn->DBE();
  // }

?>
<script type="text/javascript">
location.href="../../videoDetail.php?no=<?echo $_POST['no'];?>";
</script>
<?
?>
