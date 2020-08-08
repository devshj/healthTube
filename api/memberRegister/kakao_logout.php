<?php 
//연결 해제(탈퇴시) 
$access_token = 회원 토큰값; 

$UNLINK_API_URL = "https://kapi.kakao.com/v1/user/unlink"; 
$opts = array( 
			CURLOPT_URL => $UNLINK_API_URL, 
			CURLOPT_SSL_VERIFYPEER => false, 
			CURLOPT_SSLVERSION => 1,
			CURLOPT_POST => true, 
			CURLOPT_POSTFIELDS => false, 
			CURLOPT_RETURNTRANSFER => true, 
			CURLOPT_HTTPHEADER => array( "Authorization: Bearer " . $access_token ) 
			); 

$curlSession = curl_init(); 
curl_setopt_array($curlSession, $opts); 
$accessUnlinkJson = curl_exec($curlSession); 
curl_close($curlSession); $unlink_responseArr = json_decode($accessUnlinkJson, true); 

// 성공시 카카오 사용자 id ($unlink_responseArr['id'])값을 넘겨 받습니다. 회원정보의 카카오 id 값과 비교하시면 됩니다.
