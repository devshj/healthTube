<?php
include 'api/dbconn.php';
include 'api/pageClass.php';

$conn = new DBC();
$conn->DBI();
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================검색, 페이지네이션 =================-->
	<?
		if($_GET['search_text'] == null) {
			$searchText = " where title LIKE '%%'";
		} else {
			$searchText = " where title LIKE '%".$_GET['search_text']."%'";
		}

		$query = "select * from Heal_board $searchText and cate ='2' order by idx desc";
		$conn->DBQ($query);
		$conn->DBE();
		$cnt = $conn->resultRow();

		$total_row = $cnt;
		$list = 8;
		$block = 5;
		$page = new paging($_GET['page'], $list=8, $block=5, $total_row=$cnt);

		if(isset($_GET['search_text'])) {
			$page->setUrl("search_text=".$_GET['search_text']);
		}

		$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

		$page->setDisplay("prev_btn", "<"); // [이전]버튼을 [prev] text로 변경
		$page->setDisplay("next_btn", ">"); // 이와 같이 버튼을 이미지로 바꿀수 있음
		$page->setDisplay("end_btn", ">>");
		$page->setDisplay("start_btn", "<<");
		$page->setDisplay("class","page-item");
		$page->setDisplay("full");
		$paging = $page->showPage();
	?>
	<!--================검색, 페이지네이션 =================-->

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>비포 & 애프터</b></h2>
			<div class="row">

			<!--================left_sidebar =================-->

			<?php
				$sql = "select * from Heal_board $searchText and cate = '2' order by idx desc limit $limit, $list;";
				$conn->DBQ($sql);
				$conn->DBE();
				$cnt = $conn->resultRow();
				while($row=$conn->DBF()){
					if($cnt > '0') {
			?>
			<div class="col-lg-3 mb-5 mb-lg-0" style="margin-bottom: 0rem!important;">
				<div class="blog_left_sidebar">
					<article class="blog_item">
						<?if($row['img'] != null){?>
							<div class="blog_item_img">
								<img style="width: 25rem; height: 14rem; overflow: hidden" class="card-img rounded-0" src="api/boardImgUpload/<?php echo $row['img']; ?>" alt="">
							</div>
						<?}?>
						<?if($row['img'] == null){?>
							<div class="blog_item_img">
								<img style="width: 25rem; height: 14rem; overflow: hidden" class="card-img rounded-0" src="api/boardImgUpload/85d8ce590ad8981ca2c8286f79f59954.gif" alt="">
							</div>
						<?}?>
						<div class="blog_details" style="padding: 15px 10px 10px 10px;">
							<a class="d-inline-block" href="galleryBoardView.php?idx=<?php echo $row['idx'];?>">
								<h2><div style="width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo $row['title'];?></div></h2>
							</a>
							<!--<p>간추린 내용을 적어주자.</p>-->
							<ul class="blog-info-link">
								<li><a href="#"><i class="far fa-user"></i><?php echo $row['nickname'];?></a></li>
								<li><a href="#"><i class="far fa-clock"></i><?php echo $row['date'];?></a></li>
								<li><a href="#"><i class="far fa-eye"></i><?php echo $row['hit'];?></a></li>
							</ul>
						</div>
					</article>
				</div>
			</div>
			<?}} if($cnt < '1') { ?>
			<div class="col-lg-8 mb-5 mb-lg-0" style="margin-bottom: 0rem!important;">
				<div class="blog_left_sidebar mt-5">
					<article class="blog_item">
						<h4> 글이 존재하지 않습니다.&nbsp;&nbsp;&nbsp;글을 작성해 주세요. </h4>
					</article>
				</div>
			</div>
			<?}?>
			

		<!--================left_sidebar =================-->		
			
		</div>

			<?
			$session_id = $_SESSION['idx'];
			$sql = " select * from Heal_board where idx = '".$session_id."'  ";
			$conn->DBQ($sql);
			$conn->DBE();
			if($session_id != null) {
			?>
			<div class="form-group text-right mt-3">
				<a href="galleryBoardWrite.php">
					<button type="submit" class="button button-contactForm btn_2">글 작성하기</button>
				</a>
			</div>
			<?
			}
			else { ?>
			<div class="form-group text-right mt-3">
				<p> 로그인 후 글을 작성할 수 있습니다. <p>
			</div>
			<?}?>

		</div>

		<!--================paging & searchBar 수정 필요 =================-->
		<div class="col-lg-12 text-center mt-5">
			<nav class="blog-pagination justify-content-center d-flex">
				<ul class="pagination" style="justify-content: center;">
					<? echo $paging; ?>
				</ul>
			</nav>
		</div>

		<div class="col-lg-12 text-center mt-5 blog-pagination justify-content-center d-flex">
			<div class="col-lg-8 ">
				<form action="<?echo $_SERVER['PHP_SELF'];?>" method="GET">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="search_text" placeholder="Search Keyword . . ."
						value="<?if($_GET['search_text'] == null){}else{echo $_GET['search_text'];}?>">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-outline-secondary" id="searchButton">
								<span><i class="fa fa-search"></i></span>
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<!--================paging & searchBar =================-->

	</section>
	<!--================Content Area =================-->
<?include 'footer.php';?>