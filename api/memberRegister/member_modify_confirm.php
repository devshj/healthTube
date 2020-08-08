<?php	
  include '../dbconn.php';

  $conn = new DBC();
  $conn->DBI();
	$sql = "select * from Heal_member where pass='".$_POST['password']."'";
  $conn->DBQ($sql);
  $conn->DBE();
  $row = $conn->DBF();
  $rowcnt = $conn->resultRow();
	$password = $_POST['password'];

	//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($_POST["password"] == null){
		echo '<script> alert("비밀번호를 입력해주세요."); history.back(); </script>';
	}else{

	if($rowcnt == 1)
	{
		if(!password_verify($password, $row['pass']))
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['idx'] = $row['idx'];
				?>
				<script type="text/javascript">
				window.location.href="../../member_modify.php"</script>
				
				<?
			}
			else
			{
				?>
				<script type="text/javascript">
				window.location.href="../../member_modify.php"</script>
				<?
			}
	}
	else
	{
		?>
			<script type="text/javascript">
			window.location.href="../../member_modify.php"</script>
			<?
		}
	}
	$conn->DBO(); // db객체 해제 (종료)
?>