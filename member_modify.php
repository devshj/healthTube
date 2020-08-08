<?include 'header.php';?>
<?include 'menu.php';?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:250px;padding: 100px 0px;">
		<div class="container">
			<h2>&nbsp&nbsp<b>비밀번호 수정</b></h2>
			<div class="row">
				<div class="col-12" >
					<form name = "frm1" action="api/memberRegister/board_member_modify_save.php" method="post" enctype="multipart/form-data" role="form">
						<!-- Banner -->
						<div class="container">
							<div class="row main">
								<div class="panel-heading">
								</div>
							</div> 									
								<div class="main-login main-center">							
									<!-- ment -->
									<div class="form-group">
										<label for="text" class="cols-sm-2 control-label" style="font-weight:bold;">
										<br><h3 style="font-weight:bold;">
										주기적인 비밀번호 변경을 통해 개인정보를 안전하게 보호하세요.</h3>
										</label>
									</div>
									<!-- Password -->
									<div class="form-group">
										<label for="password" class="cols-sm-2 control-label" style="font-weight:bold;">새 비밀번호</label>
										
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="password" id="password" value="" placeholder="새 비밀번호를 입력해주세요."/>
											</div>
										</div>
									</div>
									
									<!-- Password Confirm -->
									<div class="form-group">
										<label for="confirm" class="cols-sm-2 control-label" style="font-weight:bold;">새 비밀번호 확인</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="pass2" id="pass2" value="" placeholder="새 비밀번호를 확인해주세요." onchange="passCheck()"/>
											</div>
										</div>
									</div>
									<div class="form-group">
										- 비밀번호는 8~16자로 영문 대 소문자, 숫자, 특수문자를 조합하셔서 사용할 수 있어요.<br>
										- 쉬운 비밀번호나 자주 쓰는 사이트의 비밀번호가 같을 경우, 도용되기 쉬워 주기적으로 변경하여 사용하는 것이 좋습니다.<br>
										- 비밀번호에 특수문자를 추가하여 사용하시면 기억하기도 쉽고, 비밀번호 안전도가 높아져 도용의 위험이 줄어듭니다.<br>
									<!-- Register Button -->
									</div>
									<div class="form-group">
									<input type="submit" class="btn_2" value="  확인  " />
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
	<script>
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
	</script>
<?include 'footer.php';?>
