<?php
include 'api/dbconn.php';

$conn = new DBC();
$conn->DBI();
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>섬머노트 테스트</b></h2>
			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<form action="api/get.php" method="post" enctype="multipart/form-data">
						<textarea class="summernote" name="contents"></textarea>
						<input type="submit"></input>
					<form>	
				</div>
			</div>
		</div>
	</section>
	<!--================Content Area =================-->

<?include 'footer.php';?>