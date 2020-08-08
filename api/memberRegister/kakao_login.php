<?php 
// KAKAO LOGIN 
define('KAKAO_CLIENT_ID', '9d7a5f7a9bce390965391ae16f920f6d'); 
define('KAKAO_CLIENT_SECRET', '클아이언트 시크릿'); // 필수 아님 
define('KAKAO_CALLBACK_URL', 'https://soohoon.co.kr/kakaoLogin.php'); // 콜백URL 

// 카카오 로그인 접근토큰 요청 예제 
$kakao_state = md5(microtime() . mt_rand()); // 보안용 값 
$_SESSION['kakao_state'] = $kakao_state; $kakao_apiURL = "https://kauth.kakao.com/oauth/authorize?client_id=".KAKAO_CLIENT_ID."&redirect_uri=".urlencode(KAKAO_CALLBACK_URL)."&response_type=code&state=".$kakao_state; ?>

