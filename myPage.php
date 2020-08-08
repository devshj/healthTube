<?php
include 'api/dbconn.php';

$conn = new DBC();
$conn->DBI();
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:200px;padding: 100px 0px;">
		<div class="container">
			<h2><b>정보 관리</b></h2>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
							<div class="card-body">
									<nav>
											<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">비밀번호 수정</a>
													<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">회원탈퇴</a>
											</div>
									</nav>
									<div class="tab-content mt-3" id="nav-tabContent">
											<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
													<? include 'member_mo.php' ?>
											</div>
											<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
													<? include 'unRegister.php' ?>
											</div>
									</div>
							</div>
					</div>
				</div>
				<!-- /col-lg-12 -->
			</div>
			<!-- /row -->
		</div>
	</section>
	<!--================Content Area =================-->

<?include 'footer.php';?>
