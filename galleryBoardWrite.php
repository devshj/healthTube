<?php
include 'api/dbconn.php';

$conn = new DBC();
$conn->DBI();

#URL 접근 관리
if($_SESSION['idx'] == null){
	?>
	<script>
		alert('로그인이 필요한 서비스입니다!');
		// history.back(-1);
		window.location.href="login.php";
	</script>
	<?
} else {

?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!-- include summernote -->
	<link rel="stylesheet" href="api/summernote2/summernote-bs4.css">
	<script type="text/javascript" src="api/summernote2/summernote-bs4.js"></script>

	<!-- 썸머노트 에디터 -->

	<script language="javaScript">
		function check_onclick() {
			theForm=document.frm1;

			theForm.submit();
	}
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.summernote').summernote({
				height: 400,
				tabsize: 2,
				codemirror: {
					mode: 'text/html',
					htmlMode: true,
					lineNumbers: true,
					theme: 'monokai'
				},
				callbacks: {
					onImageUpload : function(files, editor, welEditable) {
						console.log('image upload:', files);
						sendFile(files[0], editor, welEditable);
					},
				}
			});
			function sendFile(file,editor,welEditable) {
				data = new FormData();
				data.append("file", file);
				$.ajax({
					url: "api/boardSaveimg.php",
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					type: 'POST',
					success: function(data){
						var image = $('<img>').attr('src', '' + data);
						$('.summernote').summernote("insertNode", image[0]);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus+" "+errorThrown);
					}
				});
			}
			$('form').on('submit', function (e) {
				e.preventDefault();
			});
		});
	</script>
	<!-- 썸머노트 에디터 -->

	<!--================Content Area =================-->

	<section name="frm1" class="blog_area section_padding" style="min-height:800px;padding: 100px 0px;">
		<div class="container">
			<h2><b>글 작성</b></h2>
			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<form name="frm1" action="api/board/galleryBoardWriteOk.php" method="post" enctype="multipart/form-data">
						<div><input class="col-lg-12" rows="1" name="title" placeholder="25자 이내로 제목을 입력해 주세요." maxlength="25" required></input></div>
						<textarea class="summernote" id="summernote" name="content"></textarea>
						<div class="text-right">
							<input type="submit" class="button button-contactForm btn_2 mt-3" onclick="check_onclick();"></input>
						</div>
					<form>	
				</div>
			</div>
		</div>
	</section>

	<!--================Content Area =================-->

<?include 'footer.php'; }?>