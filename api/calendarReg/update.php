<?
include '../dbconn.php';

$conn = new DBC();
$conn->DBI();

switch ($_POST['compare']){
  case '미완료':
  $sql = "update Heal_planner_video set status = '완료' where idx = '".$_POST['no']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  ?>
  <script>window.location.href="../../calendar.php?date_from=<?echo $_POST['date'];?>"</script>
  <?
  break;

  case '완료':
  $sql = "update Heal_planner_video set status = '미완료' where idx = '".$_POST['no']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  ?>
  <script>window.location.href="../../calendar.php?date_from=<?echo $_POST['date'];?>"</script>
  <?
  break;
}
?>
