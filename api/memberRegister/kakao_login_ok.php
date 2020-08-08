<?php	
  include '../dbconn.php';
  $conn = new DBC();
  $conn->DBI();

	$sql = "select * from Heal_member where nickname='".$_POST['nickname']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  $row = $conn->DBF();
  $rowcnt = $conn->resultRow();

	//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($_POST["nickname"] != $row['nickname'] || $_POST["email"] != $row['email']){
		echo '<script> alert("닉네임 혹은 이메일을 입력해주세요."); history.back(); </script>';
	}else{

	if($rowcnt == 1)
	{
		if(!password_verify($password, $row['pass']))
			{
				$_SESSION['nickname'] = $row['nickname'];
				$_SESSION['idx'] = $row['idx'];
				?>
				<script type="text/javascript">
				window.location.href="../../index.php"</script>
				
				<?
			}
			else
			{
				?>
				<script type="text/javascript">alert("비밀번호가 일치하지 않습니다!");
				window.location.href="../../login.php"</script>
				<?
			}
	}
	else
	{
		?>
			<script type="text/javascript">alert("아이디와 비밀번호를 확인해주세요.");
			window.location.href="../../login.php"</script>
			<?
		}
	}
	$conn->DBO(); // db객체 해제 (종료)
?>