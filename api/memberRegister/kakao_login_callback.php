<?php 
session_start(); 
// KAKAO LOGIN 
define('KAKAO_CLIENT_ID', '9d7a5f7a9bce390965391ae16f920f6d'); 
define('KAKAO_CLIENT_SECRET', '클아이언트 시크릿'); // 필수 아님 
define('KAKAO_CALLBACK_URL', 'https://soohoon.co.kr/kakaoLogin.php'); 
	
if ($_SESSION['kakao_state'] != $_GET['state']) { 
	// 오류가 발생하였습니다. 잘못된 경로로 접근 하신것 같습니다. 
} 

if ($_GET["code"]) { 
	//사용자 토큰 받기 
	$code = $_GET["code"]; 
	$params = sprintf( 'grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', KAKAO_CLIENT_ID, KAKAO_CALLBACK_URL, $code); 
	
	$TOKEN_API_URL = "https://kauth.kakao.com/oauth/token"; 
	$opts = array( 
		CURLOPT_URL => $TOKEN_API_URL, 
		CURLOPT_SSL_VERIFYPEER => false, 
		CURLOPT_SSLVERSION => 1, // TLS 
		CURLOPT_POST => true, 
		CURLOPT_POSTFIELDS => $params, 
		CURLOPT_RETURNTRANSFER => true, 
		CURLOPT_HEADER => false 
	); 
	
	$curlSession = curl_init(); 
	curl_setopt_array($curlSession, $opts); 
	$accessTokenJson = curl_exec($curlSession); 
	curl_close($curlSession); 
	
	$responseArr = json_decode($accessTokenJson, true); 
	$_SESSION['kakao_access_token'] = $responseArr['access_token']; 
	$_SESSION['kakao_refresh_token'] = $responseArr['refresh_token']; 
	$_SESSION['kakao_refresh_token_expires_in'] = $responseArr['refresh_token_expires_in']; 
	
	//사용자 정보 가저오기 
	$USER_API_URL= "https://kapi.kakao.com/v2/user/me"; 
	$opts = array( 
		CURLOPT_URL => $USER_API_URL, 
		CURLOPT_SSL_VERIFYPEER => false, 
		CURLOPT_SSLVERSION => 1, 
		CURLOPT_POST => true, 
		CURLOPT_POSTFIELDS => false, 
		CURLOPT_RETURNTRANSFER => true, 
		CURLOPT_HTTPHEADER => array( "Authorization: Bearer " . $responseArr['access_token'] ) 
	); 
	
	$curlSession = curl_init(); 
	curl_setopt_array($curlSession, $opts); 
	$accessUserJson = curl_exec($curlSession); 

	curl_close($curlSession); $me_responseArr = json_decode($accessUserJson, true); 
	
	if ($me_responseArr['id']) 
	{ // 회원아이디(kakao_ 접두사에 네이버 아이디를 붙여줌) 
		$mb_uid = 'kakao_'.$me_responseArr['id']; 
		// 회원가입 DB에서 회원이 있으면(이미 가입되어 있다면) 토큰을 업데이트 하고 로그인함 
		if (회원정보가 있다면) { 
			// 멤버 DB에 토큰값 업데이트 $responseArr['access_token'] 
			// 로그인 } // 회원정보가 없다면 회원가입 
		else { 
			// 회원아이디 $mb_uid 
			// properties 항목은 카카오 회원이 설정한 경우만 넘겨 받습니다. 
			$mb_nickname = $me_responseArr['properties']['nickname']; // 닉네임 
			$mb_profile_image = $me_responseArr['properties']['profile_image']; // 프로필 이미지 
			$mb_thumbnail_image = $me_responseArr['properties']['thumbnail_image']; // 프로필 이미지 
			$mb_email = $me_responseArr['kakao_account']['email']; // 이메일 
			$mb_gender = $me_responseArr['kakao_account']['gender']; // 성별 female/male 
			$mb_age = $me_responseArr['kakao_account']['age_range']; // 연령대 
			$mb_birthday = $me_responseArr['kakao_account']['birthday']; // 생일 
			// 멤버 DB에 토큰과 회원정보를 넣고 로그인 
			} 
	} else { 
		// 회원정보를 가져오지 못했습니다. 
		} 
	}