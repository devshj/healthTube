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

		$query = "select * from Heal_board $searchText order by idx desc";
		$conn->DBQ($query);
		$conn->DBE();
		$cnt = $conn->resultRow();

		$total_row = $cnt;
		$list = 3;
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
	
	<?
	if($_GET['search_text'] == null) {}else {
			$sql = "select * from Heal_board $searchText and cate = '1' order by idx desc limit $limit, $list;";
			$conn->DBQ($sql);
			$conn->DBE();
			$cnt = $conn->resultRow();
			while($row=$conn->DBF()){
	?>



	<!--================1Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>커뮤니티</b></h2>
			<div class="row">

				<!--================left_sidebar =================-->
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="blog_left_sidebar">

						<!--================board =================-->

						<div class="form-group text-right">
							<a href="freeBoardWrite.php">
								<button type="submit" class="button button-contactForm btn_2">글 작성하기</button>
							</a>
						</div>

						<?php

							$sql = "select * from Heal_board $searchText and cate = '1' order by idx desc limit $limit, $list;"; #limit 0,5 여따 where cate = '1' 어떻게 넣냐
							$conn->DBQ($sql);
							$conn->DBE();
							$cnt = $conn->resultRow();
							while($row=$conn->DBF()){
						?>
						<article class="blog_item" style="margin-bottom: 0px;">
							<div class="blog_details" style="text-overflow:ellipsis; overflow:hidden;">
								<a class="d-inline-block" href="freeBoardView.php?idx=<?php echo $row['idx'];?>">
									<h2><?php echo $row['title'];?></h2>
								</a>
								<!--<p><?php echo $row['content'];?></p>-->
								<ul class="blog-info-link">
									<li><a href="#"><i class="far fa-user"></i><?php echo $row['nickname'];?></a></li>
									<li><a href="#"><i class="far fa-comments"></i><?php echo $row['hit'];?></a></li>
									<li><a href="#"><i class="far fa-clock"></i><?php echo $row['date'];?></a></li>
								</ul>
							</div>
						</article>
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
										<input type="text" class="form-control" name="search_text" placeholder='Search Keyword' value="<?if($_GET['search_text'] == null){}else{echo $_GET['search_text'];}?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
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
	<!--================1Content Area =================-->
	<?}}?>

	<?
		if($_GET['search_text'] == null) {
	?>

	<!--================2Content Area =================-->
	<section class="blog_area single-post-area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>글 보기(커뮤니티)</b></h2>
			<div class="row">

				<!--================left_sidebar =================-->
				<div class="col-lg-8 posts-list">

					<!--================the content =================-->
					<?php
						$idx = $_GET['idx']; # bno함수에 idx값을 받아와 넣음
						# 데이터베이스에서 값 가져오기
						$sql = "select * from Heal_board where idx='".$idx."'"; # 받아온 idx값을 선택 
						$conn->DBQ($sql);
						$conn->DBE();
						$board = $conn->DBF();

						#댓글 개수 출력
						$cnt_sql = "select * from Heal_board_review where board_idx = '".$idx."' ";
						$conn->DBQ($cnt_sql);
						$conn->DBE();
						$count = $conn->resultRow(); #resultRow()가 숫자 세는 함수 : 여기에 넣었어
						$cnt_review=$conn->DBF();

						# 조회수
						$hit = "update Heal_board set hit = hit + 1 where idx = $idx";
						$conn->DBQ($hit);
						$conn->DBE();
						$hit_ok = 1;
					?>
						<!--<div class="feature-img">
							<img class="img-fluid" src="img/blog/single_blog_1.png" alt="">
						</div>-->
							<h2><?php echo $board['title'];?></h2>
							<ul class="blog-info-link mt-3 mb-4">
								<li><a href="#"><i class="far fa-user"></i><?php echo $board['nickname'];?></a></li>
								<li><a href="#"><i class="far fa-comments"></i><?php echo $count;?> Comments</a></li>
								<li><a href="#"><i class="far fa-clock"></i><?php echo $board['date'];?></a></li>
								<li><a href="#"><i class="far fa-eye"></i><?php echo $board['hit'];?></a></li>
							</ul>
							<p class="excert">
							<?
								#if ($board['img'] != null) { ?>
									<!--<img style="width: 25rem; height: 14rem; overflow: hidden" src="./api/boardImgUpload/<?php echo $board['img']; ?>">-->
							<?#}?>
								<div style="min-height:600px;padding: 15px 0px;">
									<?php echo $board['content'];?>
								</div>
							</p>
							<?
							# 버튼
							$id = $_SESSION['id'];
							$sql = "select * from Heal_member where id='".$id."'";
							$conn->DBQ($sql);
							$conn->DBE();
							while ($row = $conn->DBF()) {
								$session_nick = $row['nickname'];
							}
							?>
							<div class="form-group text-right">
								<? if($session_nick == $board['nickname']) {?>
								<a href="freeModify.php?idx=<?php echo $board['idx']; ?>">
									<button type="submit" class="button button-contactForm btn_2">수정하기</button>
								</a>
								<a href="api/board/BoardDelete.php?idx=<?php echo $board['idx']; ?>">
									<button type="submit" class="button button-contactForm btn_2">삭제하기</button>
								</a>
								<?}?>
								<a href="javascript:history.back()">
									<button type="submit" class="button button-contactForm btn_2">목록으로</button>
								</a>
							</div>
							<!--<div class="quote-wrapper">
							<div class="quotes">
							MCSE boot camps have its supporters and its detractors. Some people do not understand why you
							should have to spend money on boot camp when you can get the MCSE study materials yourself at
							a fraction of the camp price. However, who has the willpower to actually sit through a
							self-imposed MCSE training.
							</div>
							</div> 강조하는 단락 같은데 쓰고 싶으면 쓰고;--
						</div>
					</div>
					<!--================the content =================-->

					<!--================navigation =================-->
					<div class="navigation-top">

						<div class="d-sm-flex justify-content-between text-center">
							<!--<p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> Lily and 4 people like this</p>-->
							<div class="col-sm-4 text-center my-2 my-sm-0">
							<!-- <p class="comment-count"><span class="align-middle"><i class="far fa-comment"></i></span> 06 Comments</p> -->
							</div>
							<ul class="social-icons">
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fab fa-behance"></i></a></li>
							</ul>
						</div>

						<div class="navigation-area">
							<div class="row">



								
								<!--================이전 글 =================-->
								<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
								<?php
								$sql = " select * from Heal_board where cate = '1' and idx < '".$idx."' order by idx desc limit 1 ";
								$conn->DBQ($sql);
								$conn->DBE();
								$prev = $conn->DBF();
								if( $prev['idx'] != null) {
								?>
								
									<div class="thumb">
										<a href="freeBoardView.php?idx=<?php echo $prev['idx'];?>">
											<img class="img-fluid" src="img/post/preview.png" alt="">
										</a>
									</div>
									<div class="arrow">
										<a href="freeBoardView.php?idx=<?php echo $prev['idx'];?>">
											<span class="lnr text-white ti-arrow-left"></span>
										</a>
									</div>
									<div class="detials">
										<p>이전 글</p>
										<a href="#">
											<h4><div style="width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo $prev['title'];?></div></h4>
										</a>
									</div>
									<?}?>
								</div>
								<!--================이전 글 =================-->
						
								<!--================다음 글 =================-->
								<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
								<?php
								$sql = " select * from Heal_board where cate = '1' and idx > '".$idx."' order by idx limit 1 ";
								$conn->DBQ($sql);
								$conn->DBE();
								$next = $conn->DBF();
								if( $next['idx'] != null) {
								?>
									<div class="detials">
										<p>다음 글</p>
										<a href="freeBoardView.php?idx=<?php echo $next['idx'];?>">
											<h4><div style="width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo $next['title'];?></div></h4>
										</a>
									</div>
									<div class="thumb">
										<a href="freeBoardView.php?idx=<?php echo $next['idx'];?>">
											<img class="img-fluid" src="img/post/next.png" alt="">
										</a>
									</div>
									<div class="arrow">
										<a href="freeBoardView.php?idx=<?php echo $next['idx'];?>">
											<span class="lnr text-white ti-arrow-right"></span>
										</a>
									</div>
									<?}?>
								</div>
								<!--================다음 글 =================-->

							</div>
						</div>

					</div>
					<!--================navigation =================-->
				 
					<!--================author =================-
					<div class="blog-author">
						<div class="media align-items-center">
							<img src="img/blog/author.png" alt="">
							<div class="media-body">
								<a href="#">
									<h4>설서진</h4>
								</a>
								<p>안녕하세요 설서진 입니다. 저는 자유게시판과 비포&애프터를 담당하고 있습니다.</p>
							</div>
						</div>
					</div>

					<!--================comments =================-->
						<?
						$i=0;
						$sql = "
						SELECT a.idx AS '댓글인덱스', a.nickname AS '댓글닉네임', a.date AS '댓글게시일', a.hit AS '댓글추천수', a.content AS '댓글내용'
						FROM Heal_board_review AS a
						WHERE a.board_idx = '".$board['idx']."'
						ORDER BY idx desc
						";
						$conn->DBQ($sql);
						$conn->DBE();
						$cnt = $conn->resultRow();
						?>
						<div class="comments-area">
							<h4><?php echo $cnt.' 댓글'; ?></h4>
							<?while($row=$conn->DBF()){?>
							<div class="comment-list">
								<div class="single-comment justify-content-between d-flex">
									<div class="user justify-content-between d-flex">
										<div class="thumb">
											<img src="img/comment/comment_1.png" alt="">
										</div>
										<div class="desc">
											<p class="comment"><?php echo $row['댓글내용']; ?></p>
											<div class="d-flex justify-content-between">
												<div class="d-flex align-items-center">
													<h5>
														<a href="#"><?php echo $row['댓글닉네임']; ?></a>
													</h5>
													<p class="date"><?php echo $row['댓글게시일'] ?></p>
												</div>
												<div class="reply-btn" id="reply<?echo $row['댓글인덱스'];?>">
													<div class="custom_like" id="like<?echo $row['댓글인덱스'];?>" class="btn-reply text-uppercase"><i class="fa fa-heart"></i> <?php echo $row['댓글추천수']; ?></div>
													<script>
														$("#like<?echo $row['댓글인덱스'];?>").click(function(){
															$.ajax({
																url: './api/board/boardHeart.php',
																type: 'POST',
																data: { idx: '<?echo $row['댓글인덱스'];?>' },
																dataType: 'JSON',
																success:function(result){
																	$("#like<?echo $row['댓글인덱스'];?>").html(result.data);
																}
															})
														});
													</script>
												</div>
												<!-- /reply-btn -->
											</div>
										</div>
										<!-- /dsec -->
									</div>
								</div>
							</div>
							<!-- /1 comment -->
							<?
							//$idx = $row['댓글인덱스'];
							$i++;}?>
						</div>
					<!--================comments =================-->

					<!--================comments form =================-->
						<?
						if($_SESSION['id'] == null){}else{?>
						<div class="comment-form">
							<h4>댓글 남기기</h4>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder=""></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<button id="commentSub" type="button" class="button button-contactForm btn_2 btn-sm">댓글 달기</button>
							</div>
						</div>
						<?}?>
					<!--================comments form =================-->

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
										<input type="text" class="form-control" name="search_text" placeholder='Search Keyword' value="<?if($_GET['search_text'] == null){}else{echo $_GET['search_text'];}?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
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
	<?}?>

<?include 'footer.php';?>
<script>
//댓글
  $(function() {
    $('[data-toggle = "datepicker"]').datepicker({
      autoHide: true,
      zIndex: 2048,
      language: 'ko-KR'
    });
  });

  // $("#calendarBtn").change(function(){
  //   $("#date_from").val($(""))
  // })

  $("#commentSub").click(function(){
    $.ajax({
      url: '/api/board/boardComment.php',
      type: 'POST',
      data: { idx: '<?echo $_GET['idx'];?>', id: '<?echo $_SESSION['id'];?>', contents: $("#comment").val()  },
      success:function(data){
        $("#comment").val('');
        $("#comments_area").html(data);
      }
    })
  });

  var id = '<?echo $_SESSION['id'];?>';
  $("#btn_ins").click(function(){
    if(id == ''){
      alert('로그인이 필요한 서비스입니다!');
    }else{
      $("#heart_ins").submit();
    }
  })

  $("#btn_del").click(function(){
    if(id == ''){
      alert('로그인이 필요한 서비스입니다!');
    }else{
      $("#heart_del").submit();
    }
  })
</script>