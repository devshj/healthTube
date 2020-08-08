

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:160px;padding: 30px 0px;">
		<div class="container">
			<h3>&nbsp&nbsp&nbsp&nbsp<b>비밀번호 수정</b></h3>
			<div class="row">
				<div class="col-12" >
					<form name = "frm1" action="api/memberRegister/member_modify_confirm.php" method="post" enctype="multipart/form-data" role="form">
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
										<br><h4 style="font-weight:bold;">
										개인정보 확인을 위해 비밀번호를 입력해주세요.</h4>
										</label>
									</div>
									<!-- Password -->
									<div class="form-group">
										<label for="password" class="cols-sm-2 control-label" style="font-weight:bold;">현재 비밀번호</label>
										
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="password" id="password" value="" placeholder="현재 비밀번호를 입력해주세요."/>
											</div>
										</div>
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
			alert("비밀번호를 올바르게 입력해주세요.");
			document.getElementById("password").value = "";
			document.getElementById("password").focus();
			document.getElementById("password").value = "";
			return false;
		}
		var pw_check = /^(?=.*[a-zA-Z])((?=.*\d)(?=.*[?*~!^-_)(@$%&#])).{8,16}$/;

		if(!pw_check.test(pw)){
			alert("비밀번호를 올바르게 입력해주세요.");
			document.getElementById("password").focus();
			document.getElementById("password").value = "";
			return false;
		}
	}
	</script>
