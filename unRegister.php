<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:160px;padding: 30px 0px;">
		<div class="container">
			<h3><b>&nbsp&nbsp&nbsp회원 탈퇴</b></h3>
			<div class="row">
				<div class="col-lg-12">
					<form name = "frm1" action="api/memberRegister/member_delete.php" method="post" enctype="multipart/form-data" role="form">
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
										안전한 회원탈퇴를 위해, &nbsp비밀번호를 확인해 주세요.</h3>
										비밀번호 확인 후 아이디는 즉시 탈퇴됩니다.<br>
										탈퇴 후에는 아이디와 데이터는 복구할 수 없으니 신중하게 선택해 주세요.
										</label>
									</div>								
									<!-- Password -->
									<div class="form-group">
										<label for="password" class="cols-sm-2 control-label" style="font-weight:bold;">비밀번호 확인</label>
										<div class="cols-sm-10">
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="password" maxlength="20" required="required" class="form-control" name="password" id="password" value="" placeholder="비밀번호를 입력해주세요."/>
											</div>
										</div>
									</div>
									<!-- Register Button -->
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