<?php
	include '../dbconn.php';
  $conn = new DBC();
  $conn->DBI();

  $q = "update Heal_member SET unregister = '".date('Y. m. d')."' where id = '".$_SESSION['id']."'";
  $conn->DBQ($q);
  $conn->DBE();

  ?>
	<script type="text/javascript">alert("회원탈퇴가 완료되었습니다.");</script>
  <meta http-equiv="refresh" content="0 url=../../index.php" />
