<?php
include '../dbconn.php';
if($_GET[email]) {
# 관리자 이름(닉네임)을 적어주세요.
$site_admin_name = "HealthTube";
 
# 관리자 이메일을 적어주세요.
$from="HealthTube@welcome.com";
 
# 아래부터는 수정 안하셔도 됩니다.
$subject="=?euc-kr?B?".base64_encode(stripslashes("이메일 인증 체크 인증키를 확인하세요."))."?=";
 
if(is_file("_head.php")) require_once "_head.php"; else exit("_head.php파일을 찾을 수 없습니다.확인해주세요.");
 
# 보안적인 이유로 추가함.
if (!get_magic_quotes_gpc()) {
$email = addslashes($email);
}
 
#제로보드 메일함수가 정확치 않아서 메일함수를 만들어 사용함.
function mail_AC_JOIN($fromname, $fromaddress, $toaddress, $subject, $message){
$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=euc-kr\n";
$headers .= "X-Priority: 3\n";
$headers .= "X-MSMail-Priority: Normal\n";
$headers .= "X-Mailer: Rwapm mail 1.0\n";
$headers .= "From: \"=?euc-kr?B?".base64_encode(stripslashes($fromname))."?=\" <".$fromaddress.">\n";
$headers .= "Content-Transfer-Encoding: base64\n";
$message = chunk_split(base64_encode(nl2br($message))); 
return mail($toaddress, $subject, $message, $headers);
}
 
function errormessage ($str){ 
 echo ' 
   <script type="text/JavaScript"> 
     window.alert ("'.$str.'");
   </script> 
 '; 
 exit; 
}
 
$auth_str = 'abcdefghijkmnopqrstuvwxyz23456789'; 
for($i=0,$email_number='',$l=strlen($auth_str)-1;$i<6;$i++) $email_number.= $auth_str[mt_rand(0,$l)]; // 중복 있는 6자리 문자열
$_SESSION['email_numbers'] = md5($email_numbers);
 
if (!preg_match("/^[A-Z0-9._-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z.]{2,6}$/i",$email)) errormessage ("이메일 주소가 올바른지 확인하세요.");
 
$comment="안녕하세요.\n"."3333 운영자 입니다.\n"."아래 인증 코드를 복사하여 가입 창 E-mail Check란에 넣어주십시오.\n\n"."<b>E-mail Check: <span style=\"color: red\">$email_numbers</span></b>\n\n"."E-mail Check를 타이핑하기 힘들때는 마우스로 코드를 더블클릭 후 Ctrl-C 를 눌러서 복사한후,\n"."E-mail Check란에서 Ctrl-V를 눌러서 붙여 넣기 하시면됩니다.";
 
$check=mysql_fetch_array(mysql_query("select count(*) from Heal_member where email='$email'"));
if($check[0]>0) exit("<script type=\"text/JavaScript\">alert('이미 등록되어 있는 E-Mail입니다')</script>");
 
if(!mail_AC_JOIN($site_admin_name, $from, $email, $subject, $comment)) exit("<script type=\"text/JavaScript\">alert('메일 발송 에러!!')</script>");
 
$is_url_to=explode("@",$email);
$is_url=$is_url_to[1];
?>
<script type="text/JavaScript">
alert('인증키가 <?=$email?>로 발송되었습니다.\n\n메일에 있는 E-mail Check를 확인해 가입창 E-mail Check란에 입력해 주십시오^^');
window.open("http://<?=$is_url?>");
</script>
<?}?>