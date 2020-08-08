<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>

<!------ Include the above in your HEAD tag ---------->
<?include 'header.php';?>
<?include 'menu.php';?>
<?include 'api/memberRegister/kakao_login.php';?>
	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:600px;padding: 100px 0px;">
		<div class="container">
		 <h2><b>로그인</b></h2><br>
			<div class="row">
				<div class="col-lg-11">
					<div class="row">
						<div class="col-md-4 login-sec">
							<form class="login-form" action="api/login_ok.php" method="post">

							<!-- Id -->
							<div class="form-group">
								<label for="exampleInputEmail1" class="text-uppercase">아이디</label>
								<input type="text" name="user_id" id="id"class="form-control" placeholder="" value="">
							</div>

							<!-- Password -->
							<div class="form-group">
								<label for="exampleInputPassword1" class="text-uppercase">비밀번호</label>
								<input type="password" name="user_pw" id="password" class="form-control" placeholder="" value="">
							</div>

							<!-- Login Button -->
							<div class="form-check">
								<button type="submit" class="btn_2" style="width:210pt" >로그인</button><br>
								<br>
							</div>

							<!-- Login Check -->
							<div class="form-check">
							<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
							<label class="custom-control-label" for="customControlAutosizing">아이디 저장</label>
							</div>
							<hr/>
							<!-- Id, Pw find or Register Button -->
							<div class="form-check">
								<label class="forlocation.hrem-check-label" >
									&nbsp&nbsp&nbsp&nbsp
									<small onclick="location.href='login_find.php'">아이디 찾기 &nbsp|&nbsp</small>
									<small onclick="location.href='pass_find.php'">비밀번호 찾기 &nbsp|&nbsp</small>
									<small onclick="location.href='register.php'" >회원가입</small>
								</label>
							</div>

							<div class="form-group">
							&nbsp&nbsp<a href="<?=$kakao_apiURL;?>"><img src="/img/kakao.png"></a>
							</div>
						</form>
					</div>
				<!-- banner -->
				<div class="col-md-8 banner-sec">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
			      <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
										<div class="carousel-caption d-none d-md-block">
											<div class="banner-text">
												<h1>HealthTube에 오신 것을 환영합니다.</h1>
												<p> 멘트
											</div>
										</div>
								</div>
							<div class="carousel-item">
							  <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
									<div class="carousel-caption d-none d-md-block">
								   <div class="banner-text">
										<h1>기계학습으로 당신에게 맞는 운동을 추천해드립니다.</h1>
										<p> 멘트
								   </div>
								  </div>
						   </div>
							 <div class="carousel-item">
							  <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
									<div class="carousel-caption d-none d-md-block">
								   <div class="banner-text">
										<h1>계획표를 받고 운동을 실천해보세요.</h1>
										<p> 멘트
								   </div>
								  </div>
						   </div>
						</div>
			   </div>
		  </div>
	</section>
	<!--================Content Area =================-->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>

	$(document).ready(function(){

    // 저장된 쿠키값을 가져와서 ID 칸에 넣어준다. 없으면 공백으로 들어감.
    var key = getCookie("key");
    $("#id").val(key);

    if($("#id").val() != ""){ // 그 전에 ID를 저장해서 처음 페이지 로딩 시, 입력 칸에 저장된 ID가 표시된 상태라면,
        $("#customControlAutosizing").attr("checked", true); // ID 저장하기를 체크 상태로 두기.
    }

    $("#customControlAutosizing").change(function(){ // 체크박스에 변화가 있다면,
        if($("#customControlAutosizing").is(":checked")){ // ID 저장하기 체크했을 때,
            setCookie("key", $("#id").val(), 7); // 7일 동안 쿠키 보관
        }else{ // ID 저장하기 체크 해제 시,
            deleteCookie("key");
        }
    });

    // ID 저장하기를 체크한 상태에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장.
    $("#id").keyup(function(){ // ID 입력 칸에 ID를 입력할 때,
        if($("#customControlAutosizing").is(":checked")){ // ID 저장하기를 체크한 상태라면,
            setCookie("key", $("#id").val(), 7); // 7일 동안 쿠키 보관
        }
    });
});

function setCookie(cookieName, value, exdays){
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

function deleteCookie(cookieName){
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

function getCookie(cookieName) {
    cookieName = cookieName + '=';
    var cookieData = document.cookie;
    var start = cookieData.indexOf(cookieName);
    var cookieValue = '';
    if(start != -1){
        start += cookieName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue);
}


</script>
<?include 'footer.php';?>
