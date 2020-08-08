<?php

	include '../dbconn.php';

	$conn = new DBC();
	$conn->DBI();

	$sql = "delete from Heal_board where idx='".$_GET['idx']."'";
	$conn->DBQ($sql);
	$conn->DBE();

?>

<script type="text/javascript">
alert("해당 게시글이 삭제되었습니다.");
location.href="../../freeBoard.php";
</script>