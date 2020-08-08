<?php
	include '../dbconn.php';
	$conn = new DBC();
	$conn->DBI();

	$sql = "select * from Heal_board where idx='".$_GET['idx']."'";
	$conn->DBQ($sql);
	$conn->DBE();
	$row = $conn->DBF();
?>
<!DOCTYPE html>
<meta charset="utf-8" />
<script>
var con_test = confirm("해당 게시글을 정말 삭제하시겠습니까?");
if(con_test == true){
	<?
		$sql = "delete from Heal_board where idx='".$_GET['idx']."'";
		$conn->DBQ($sql);
		$conn->DBE();
	?>
	location.href="../../freeBoard.php";
}
else if(con_test == false){
	location.href="../../freeBoardView.php?idx=<?php echo $row['idx'];?>";
}
</script>
</html>