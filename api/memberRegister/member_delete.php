<?php
	include './../dbconn.php';
  $conn = new DBC();
  $conn->DBI();
	
  // 패스워드 암호화
	const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10
	if($_POST['password']){ 
		$hash = password_hash($_POST['password'] , PASSWORD_DEFAULT, PASSWORD_COST);
	}

	$q = "delete from Heal_member where idx='".$_SESSION['idx']."'";
  $conn->DBQ($q);
  $conn->DBE();
  $rowcnt = $conn->resultRow();
	
	session_start();
	session_destroy();

	if($hash == $row['pass'])
	{	
	?>
	<script type="text/javascript">alert("탈퇴가 완료되었습니다..");</script>
	<meta http-equiv="refresh" content="0 url=../../index.php" />
	<?
	}
	else
	{
	?>
		<script type="text/javascript">alert("탈퇴가 완료되었습니다.");</script>
		<meta http-equiv="refresh" content="0 url=../../index.php" />
		<?
	}

?>
