<?php
	include "../dbconn.php";

  // 패스워드 암호화
	const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10
	if($_POST['password'] == $_POST['pass2']){ 
		$hash = password_hash($_POST['pass'] , PASSWORD_DEFAULT, PASSWORD_COST);
		echo $hash;
	}else{
		?>
		<script> alert("비밀번호와 확인이 일치하지 않습니다.");
		window.location.href="../../register.php"</script>
		<?
	}

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

	try{
		$conn->DBI(); //DB 접속

	 $query = "insert into Heal_member (id,pass,nickname,email,phone_num) 
		VALUES(:id,:pass,:nickname,:email,:phone_num)";

	$conn->DBQ($query);

	$conn->result->bindParam(':nickname', $nickname); //바인드 변수로 들어갈 변수 지정
	$conn->result->bindParam(':email', $email);

	// insert a row
	$id = $_POST['id'];
	$pass = $hash;
  $nickname = $_POST['nickname'];
	$email = $_POST['email'].'@'.$_POST['emadress'];
	$phone_num = $_POST['phone_num'];

	$conn->DBE();
		
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo "<script>alert('가입이 완료 되었습니다.');location.href='../../index.php';</script>";
?>

<meta charset="utf-8" />
<meta http-equiv="refresh" content="0 url=/"> 



