<?php
	include 'dbconn.php';
	$conn = new DBC();
	$conn->DBI();

	// id 중복체크
	$sql = "select id from Heal_member";
	$conn->DBQ($sql);
	$conn->DBE();
	$cntPro_code = $conn->resultRow();
	for($i=0; $i<$cntPro_code; $i++) { $id[$i] = $conn->DBF(); }
	for($i=0; $i<$cntPro_code; $i++) { $id_arr[$i] = $id[$i]['id']; }

	// nickname 중복체크
	$sql = "select nickname from Heal_member";
	$conn->DBQ($sql);
	$conn->DBE();
	$cntPro_code = $conn->resultRow();
	for($i=0; $i<$cntPro_code; $i++) { $nickname[$i] = $conn->DBF(); }
	for($i=0; $i<$cntPro_code; $i++) { $nickname_arr[$i] = $nickname[$i]['nickname']; }

	// email 중복체크
	$sql = "select email from Heal_member";
	$conn->DBQ($sql);
	$conn->DBE();
	$cntPro_code = $conn->resultRow();
	for($i=0; $i<$cntPro_code; $i++) { $email[$i] = $conn->DBF(); }
	for($i=0; $i<$cntPro_code; $i++) { $email[$i] = $email[$i]['email']; }
	$conn->DBO(); // db객체 해제 (종료)
?>