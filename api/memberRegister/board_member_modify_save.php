<?
include ("../dbconn.php");

  // 패스워드 암호화
	const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10
	if($_POST['password'] == $_POST['pass2']){ 
		$hash = password_hash($_POST['pass'] , PASSWORD_DEFAULT, PASSWORD_COST);
	}else{
		?>
		<script> alert("비밀번호와 확인이 일치하지 않습니다.");
		window.location.href="../../member_modify.php"</script>
		<?
	}
// 4. 회원정보 적기
$query = "update Heal_member set pass = '".$_POST[password]."' where id = '".$_SESSION[id]."'";

echo "<script>alert('비밀번호 변경이 완료되었습니다.');location.href='../../index.php';</script>";
?>