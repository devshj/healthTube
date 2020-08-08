<?php include "api/validation.php";?>
<?include 'header.php';?>
<?include 'menu.php';?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:450px;padding: 100px 0px;">
		<div class="container">
			<h2><b>회원가입</b></h2>
			<div class="row">
				<div class="col-lg-12">
					<form action="api/memberRegister/member_ok.php" method="post" enctype="multipart/form-data" role="form">
						<!-- Banner -->
						<div class="container">
							<div class="row main">
								<div class="panel-heading">
								</div>
							</div> 									
								<h2 class="title" align="center"> HealthTube에 오신 것을 환영합니다. </h1>	
								<div class="main-login main-center">							
									<!-- Nickname -->
									<div class="form-group">
										<label for="username" class="cols-sm-2 control-label">닉네임</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" maxlength="20" class="form-control" name="nickname" required="required" id="nickname" value="" placeholder="닉네임을 입력해주세요." onchange="nicknameCheck()" onkeyup=""/>
											</div>
										</div>
									</div>	
							
									<!-- email address -->
									<div class="form-group">
										<label for="email" class="control-label " style="font-weight:bold;">이메일 주소</label><label style="opacity:0.5;"></label>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="이메일을 입력해주세요." onchange="emailCheck()" id="email" name="email" title="영대소문자 또는 숫자만 입력할 수 있습니다" value=""/>
											<span class="input-group-addon">@</span>
											<select class="form-control" name="emadress">
												<option value="naver.com">naver.com</option>
												<option value="gmail.com">gmail.com</option>
												<option value="daum.net">daum.net</option>
											</select>
											<span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
											<span class="button" href="api/memberRegister/mail_sample_naver.php" id="validationButton">인증하기</span>
										</div>
									</div>
								</div>
									<!-- Register Button -->
									<div class="form-group">
									<input type="submit" class="btn_2" value="  가입하기  " />
									</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!--================Content Area =================-->
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/register_ok.js"></script>

<?include 'footer.php';?>
