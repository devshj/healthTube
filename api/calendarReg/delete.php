<?
include '../dbconn.php';

$conn = new DBC();
$conn->DBI();

// $sql = "update Heal_planner_video set flag = 0 where idx = '".$_POST['idx']."'";
$sql = "delete Heal_planner_video where idx = '".$_POST['idx']."'";
$conn->DBQ($sql);
$conn->DBE();
?>
<script>window.location.href="../../calendar.php?date_from=<?echo $_POST['date'];?>"</script>
