<?php include "api/validation.php";?>
<?include 'header.php';?>
<?include 'menu.php';?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:800px;padding: 100px 0px;">
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
								<h2 class="title" align="center"> HealthTube에 오신 것을 환영합니다. </h1><br>
								<div class="main-login main-center">							
										<!-- Id -->
									<div class="form-group">
										<label for="name" class="cols-sm-2 control-label" style="font-weight:bold;">아이디</label>
										<label style="opacity:0.5;">(아이디는 5~15자의 영문 대 소문자, 숫자로만 사용하셔야 합니다.)</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" maxlength="20" required="required" class="form-control" name="id" id="id" value="" placeholder="아이디를 입력해주세요."  onchange="idCheck()" />
											</div>
										</div>
									</div>
									
									<!-- Password -->
									<div class="form-group">
										<label for="password" class="cols-sm-2 control-label" style="font-weight:bold;">비밀번호</label>
										<label style="opacity:0.5;">(비밀번호는 8~16자로 영문 대 소문자, 숫자, 특수문자를 사용하셔야 합니다.)</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="password" id="password" value="" placeholder="비밀번호를 입력해주세요." onchange="passCheck()"/>
											</div>
										</div>
									</div>
									
									<!-- Password Confirm -->
									<div class="form-group">
										<label for="confirm" class="cols-sm-2 control-label" style="font-weight:bold;">비밀번호 재확인</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="pass2" id="pass2" value="" placeholder="비밀번호를 확인해주세요."/>
											</div>
										</div>
									</div>
									<!--
									<div class="alert alert-success" id="alert_success">비밀번호가 일치합니다.</div>
									<div class="alert alert-danger" id="alert_danger">비밀번호가 일치하지 않습니다.</div>
									-->

									<!-- Nickname -->
									<div class="form-group">
										<label for="username" class="cols-sm-2 control-label" style="font-weight:bold;" >닉네임</label>
										<label style="opacity:0.5;">(닉네임은 5~10자의 영문 대 소문자 및 숫자로만 사용하셔야 합니다.)</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" maxlength="20" class="form-control" name="nickname" required="required" id="nickname" value="" placeholder="닉네임을 입력해주세요." onchange="nicknameCheck();" />
											</div>
										</div>
									</div>
							
									<!-- Phone Number -->
									<div class="form-group">
										<label for="phone" class="cols-sm-2 control-label" style="font-weight:bold;">휴대폰 번호</label>
										<label style="opacity:0.5;">(휴대폰 번호는 숫자만 사용하셔야 합니다.)</label>
										<div class="cols-sm-3">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" maxlength="12" class="form-control" name="phone_num" id="phone_num" required="required" value="" placeholder="휴대폰 번호를 입력해주세요." onchange="phoneCheck(this);"  />
											</div>
										</div>
									</div>				
									
									<!-- email address -->
									<div class="form-group">
										<label for="email" class="control-label " style="font-weight:bold;">이메일 주소</label>
										<label style="opacity:0.5;">(이메일은 영문 대 소문자 및 숫자만 사용하셔야 합니다.)</label>
										<div class="input-group">
											<input class="form-control" type="text" placeholder="이메일을 입력해주세요." onchange="emailCheck()" id="email" name="email" title="영대소문자 또는 숫자만 입력할 수 있습니다" value=""/>
											<span class="input-group-addon">@</span>
											<select class="form-control" name="emadress">
												<option value="naver.com">naver.com</option>
												<option value="gmail.com">gmail.com</option>
												<option value="daum.net">daum.net</option>
											</select>
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

<script language="javascript">
	//아이디 검증
	function idCheck()
	{
		var users = <?php echo json_encode($id_arr); ?>;
		var userId = document.getElementById("id").value;

		for(var i =0; i < users.length; i++)
		{
			if ( userId == users[i])
			{
				document.getElementById("id").focus();
				document.getElementById("id").value = "";
				return alert(userId + "는 존재하는 아이디 입니다.");
			}
		}

		var chkmachine = /^[A-za-z0-9]{5,15}$/g;

		if(!chkmachine.test($("input[name=id]").val()))
		{
			alert("아이디는 5~15자의 영문 소문자, 대문자, 숫자로만 사용 가능합니다.");
			document.getElementById("id").focus();
			document.getElementById("id").value = "";
			return false;
		}
		else
		{
			alert("'" + document.getElementById("id").value + "' 는 사용가능한 아이디 입니다");
			document.getElementById("password").focus();
			return true;
		}
	}

	// 비밀번호 검증
	function passCheck()
	{
		var pw = $("#password").val();
		if(pw.length<8|| pw.length>16){
			alert("비밀번호는 8~16자로 영문자, 숫자, 특수문자를 사용 하셔야합니다.");
			document.getElementById("password").value = "";
			document.getElementById("password").focus();
			document.getElementById("password").value = "";
			return false;
		}
		var pw_check = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*[?*~!^-_)(@$%&#])).{8,16}$/;

		if(!pw_check.test(pw)){
			alert("영문, 숫자, 특수문자의 조합으로 입력해주세요.");
			document.getElementById("password").focus();
			document.getElementById("password").value = "";
			return false;
		}
	}

	// 닉네임 검증
	function nicknameCheck()
	{
		var users = <?php echo json_encode($nickname_arr); ?>;
		var userNick = document.getElementById("nickname").value;

		for(var i =0; i < users.length; i++)
		{
			if ( userNick == users[i])
			{
				document.getElementById("nickname").focus();
				document.getElementById("nickname").value = "";
				return alert(userNick + "는 이미 존재하는 닉네임 입니다.");
			}
		}

		var chkmachine = /^[A-za-z0-9]{5,10}$/g;

		if(!chkmachine.test($("input[name=nickname]").val()))
		{
			alert("닉네임은 5~10자의 영문자 및 숫자만 사용 가능합니다.");
			document.getElementById("nickname").focus();
			document.getElementById("nickname").value = "";
			return false;
		}
		else
		{
			alert("'" + document.getElementById("nickname").value + "' 는 사용가능한 닉네임 입니다");
			document.getElementById("nickname").focus();
			return true;
		}
	}

	//핸드폰 번호 검증
  function phoneCheck(obj)
  {
    var string = obj.value;
    var pattern = /^[0-9]{10,11}$/g;
		if(!pattern.test($("input[name=phone_num]").val()))
		{
			alert("올바른 휴대폰 번호를 작성해주세요.");
			document.getElementById("phone_num").focus();
			document.getElementById("phone_num").value = "";
			return false;
		}
  } 

	// 이메일 검증
	function emailCheck()
	{
		var pattern = /^[A-Za-z0-9+]*$/;
		if(!pattern.test(document.getElementById('email').value))
		{
			alert("이메일은 영어 대문자와 소문자 그리고 숫자만 가능합니다.");
			document.getElementById('email').value = "";
			document.getElementById('email').foucs();
			return false;
		}
	}
</script>
<?include 'footer.php';?>
