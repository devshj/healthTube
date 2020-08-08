<?php

	include '../dbconn.php';

	$conn = new DBC();
	$conn->DBI();

	$sql = "delete from Heal_board where idx='".$_POST['idx']."'";
	$conn->DBQ($sql);
	$conn->DBE();

?>

<script type="text/javascript">
location.href="../../freeBoard.php";
</script>