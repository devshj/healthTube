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

		$query = "select * from Heal_board $searchText and cate = '1' order by idx desc";
		$conn->DBQ($query);
		$conn->DBE();
		$cnt = $conn->resultRow();

		$total_row = $cnt;
		$list = 6;
		$block = 5;
		$page = new paging($_GET['page'], $list, $block, $total_row);

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
			<h2><b>커뮤니티</b></h2>
			<div class="row">

				<!--================left_sidebar =================-->
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="blog_left_sidebar">

						<!--================board =================-->
						
						<?php
							#글 출력
							$sql = "select * from Heal_board $searchText and cate = '1' order by idx desc limit $limit, $list;";
							$conn->DBQ($sql);
							$conn->DBE();
							$cnt = $conn->resultRow(); #resultRow()가 숫자 세는 함수 : 여기에 넣었어
							while($row=$conn->DBF()){
						?>
						<article class="blog_item" style="margin-bottom: 0px;">
							<? if ($cnt > '0') { ?>
							<div class="blog_details">
								<a class="d-inline-block" href="freeBoardView.php?idx=<?php echo $row['idx'];?>">
									<h2><?php echo $row['title'];?></h2>
								</a>
								<!--<p><?php echo $row['content'];?></p>-->
								<ul class="blog-info-link">
									<li><a href="#"><i class="far fa-user"></i><?php echo $row['nickname'];?></a></li>
									<!-- <li><a href="#"><i class="far fa-comments"></i><?php echo $row['hit'];?></a></li> -->
									<li><a href="#"><i class="far fa-clock"></i><?php echo $row['date'];?></a></li>
									<li><a href="#"><i class="far fa-eye"></i><?php echo $row['hit'];?></a></li>
								</ul>
							</div>
							<?}?>
						</article>
						<?}?>
						<? if($cnt < '1') { ?>
							<div class="blog_details">
								<h4> 글이 존재하지 않습니다.&nbsp;&nbsp;&nbsp;글을 작성해 주세요. </h4>
							</div>
						<?}?>


						<?
						$session_id = $_SESSION['idx'];
						$sql = " select * from Heal_board where idx = '".$session_id."'  ";
						$conn->DBQ($sql);
						$conn->DBE();
						if($session_id != null) {
						?>
						<div class="form-group text-right mt-3">
							<a href="freeBoardWrite.php">
								<button type="submit" class="button button-contactForm btn_2">글 작성하기</button>
							</a>
						</div>
						<?} else {?>
						<div class="form-group text-right mt-3">
							<p> 로그인 후 글을 작성할 수 있습니다. <p>
						</div>
						<?}?>

						<!--================board =================-->

						<!--================pagination =================-->
						<div class="col-lg-12 text-center mt-5">
							<nav class="blog-pagination justify-content-center d-flex">
								<ul class="pagination" style="justify-content: center;">
									<? echo $paging; ?>
								</ul>
							</nav>
						</div>

						<!--================pagination =================-->

					</div>
				</div>
				<!--================left_sidebar =================-->
				
				<!--================right_sidebar =================-->
				<div class="col-lg-4">
					<div class="blog_right_sidebar">

						<!--================search bar =================-->
						<aside class="single_sidebar_widget search_widget">
							<form action="<?echo $_SERVER['PHP_SELF'];?>" method="GET">
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="search_text" placeholder='Search Keyword...' value="<?if($_GET['search_text'] == null){}else{echo $_GET['search_text'];}?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
										<div class="input-group-append">
											<button class="btn" type="button"><i class="ti-search"></i></button>
										</div>
									</div>
								</div>
								<button class="button rounded-0 primary-bg text-white w-100 btn_2" type="submit">Search</button>
							</form>
						</aside>
						<!--================search bar =================-->


						<!--================Recent Post =================-->
						<aside class="single_sidebar_widget popular_post_widget">
							<h3 class="widget_title">최근 게시물</h3>
							<?php
								$sql = "select * from Heal_board where cate = '1' order by idx desc limit 0,3"; #limit 0,5
								$conn->DBQ($sql);
								$conn->DBE();
								$cnt = $conn->resultRow();
								while($row=$conn->DBF()){
							?>
							<div class="media post_item" style="text-overflow:ellipsis; overflow:hidden;">									
								<div class="media-body" style="padding-left: 0px;">
									<a href="freeBoardView.php?idx=<?php echo $row['idx'];?>">
										<h5><?php echo $row['title'];?></h5>
									</a>
									<p><?php echo $row['date'];?></p>
								</div>
							</div>
							<?}?>
						</aside>
						<!--================Recent Post =================-->
					</div>
				</div>
				<!--================right_sidebar =================-->				
			</div>
		</div>
	</section>
	<!--================Content Area =================-->

<?include 'footer.php';?>