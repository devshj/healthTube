<meta charset="utf-8"/>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./php_mailer/src/PHPMailer.php"; 
require "./php_mailer/src/SMTP.php"; 
require "./php_mailer/src/Exception.php"; 

include '../dbconn.php';
$conn = new DBC();
$conn->DBI();

  $row = $conn->DBF();
  $rowcnt = $conn->resultRow();

	//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($row['email']){
		echo '<script> alert("아이디 혹은 패스워드를 입력해주세요."); history.back(); </script>';
	}else{

	if($rowcnt == 1)
	{
		if(!password_verify($password, $row['pass']))
			{
				$_SESSION['id'] = $row['id'];
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
$mail = new PHPMailer(true);

try {

    // 서버세팅    
    $mail -> SMTPDebug = 0;    // 디버깅 설정
    $mail -> isSMTP();               // SMTP 사용 설정

    $mail -> Host = "smtp.naver.com";                      // email 보낼때 사용할 서버를 지정
    $mail -> SMTPAuth = true;                                // SMTP 인증을 사용함
    $mail -> Username = "cshoon950@naver.com";  // 메일 계정
    $mail -> Password = "!";                   // 메일 비밀번호
    $mail -> SMTPSecure = "ssl";                             // SSL을 사용함
    $mail -> Port = 465;                                        // email 보낼때 사용할 포트를 지정
    $mail -> CharSet = "utf-8";                                // 문자셋 인코딩

    // 보내는 메일
    $mail -> setFrom("cshoon950@naver.com", "transmit");

    // 받는 메일
    $mail -> addAddress("cshoon80@gmail.com", "receive01");

    // 메일 내용
    $mail -> isHTML(true);                                                         // HTML 태그 사용 여부
    $mail -> Subject = "PHPMailer 발송 테스트 입니다.";                  // 메일 제목
    $mail -> Body = "PHPMailer 발송에 <b>성공</b>하였습니다.";    // 메일 내용
    
    // 메일 전송
    $mail -> send();
    
    echo "Message has been sent";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error : ", $mail -> ErrorInfo;
}
?>