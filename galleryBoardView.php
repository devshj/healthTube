<?php
include 'api/dbconn.php';

$conn = new DBC();
$conn->DBI();
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area single-post-area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>글 보기(비포&애프터)</b></h2>
			<div class="row">

				<!--================left_sidebar =================-->
				<div class="col-lg-12 posts-list">

					<!--================the content =================-->

					<?php
						$idx = $_GET['idx']; # bno함수에 idx값을 받아와 넣음
						# 데이터베이스에서 값 가져오기
						$sql = "select * from Heal_board where idx='".$idx."'"; # 받아온 idx값을 선택 
						$conn->DBQ($sql);
						$conn->DBE();
						$board = $conn->DBF();

						#댓글 개수 출력
						$cnt_sql = "select * from Heal_gallery_review where gallery_idx = '".$idx."' ";
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

					<div class="single-post">
						<div class="blog_details">
							<h2><?php echo $board['title'];?></h2>
							<ul class="blog-info-link mt-3 mb-4">
								<li><a href="#"><i class="far fa-user"></i><?php echo $board['nickname'];?></a></li>
								<li><a href="#"><i class="far fa-comments"></i><?php echo $count;?> Comments</a></li>
								<li><a href="#"><i class="far fa-clock"></i><?php echo $board['date'];?></a></li>
								<li><a href="#"><i class="far fa-eye"></i><?php echo $board['hit'];?></a></li>
							</ul>
							<p class="excert">
								<pre>
<?php echo $board['content'];?>








								</pre>
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
								<? if($session_nick == $board['nickname']) { ?>
								<a href="galleryModify.php?idx=<?php echo $board['idx']; ?>">
									<button type="submit" class="button button-contactForm btn_2">수정하기</button>
								</a>
								<a href="api/board/galleryBoardDelete.php?idx=<?php echo $board['idx']; ?>">
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
							</div> 강조하는 단락 같은데 쓰고 싶으면 쓰고;-->
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
								$sql = " select * from Heal_board where idx < '".$idx."' and cate = '2' order by idx desc limit 1 ";
								$conn->DBQ($sql);
								$conn->DBE();
								$prev = $conn->DBF();
								if( $prev['idx'] != null) {
								?>
								
									<div class="thumb">
										<a href="galleryBoardView.php?idx=<?php echo $prev['idx'];?>">
											<img class="img-fluid" src="img/post/preview.png" alt="">
										</a>
									</div>
									<div class="arrow">
										<a href="galleryBoardView.php?idx=<?php echo $prev['idx'];?>">
											<span class="lnr text-white ti-arrow-left"></span>
										</a>
									</div>
									<div class="detials">
										<p>이전 글</p>
										<a href="galleryBoardView.php?idx=<?php echo $prev['idx'];?>">
											<h4><div style="width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
												<?php echo $prev['title'];?>
											</div></h4>
										</a>
									</div>
									<?}?>
								</div>
								<!--================이전 글 =================-->
						
								<!--================다음 글 =================-->
								<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
								<?php
								$sql = " select * from Heal_board where idx > '".$idx."' and cate = '2' order by idx limit 1 ";
								$conn->DBQ($sql);
								$conn->DBE();
								$next = $conn->DBF();
								if( $next['idx'] != null) {
								?>
									<div class="detials">
										<p>다음 글</p>
										<a href="galleryeBoardView.php?idx=<?php echo $next['idx'];?>">
											<h4><div style="width:250px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
												<?php echo $next['title'];?>
											</div></h4>
										</a>
									</div>
									<div class="thumb">
										<a href="galleryBoardView.php?idx=<?php echo $next['idx'];?>">
											<img class="img-fluid" src="img/post/next.png" alt="">
										</a>
									</div>
									<div class="arrow">
										<a href="galleryBoardView.php?idx=<?php echo $next['idx'];?>">
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
				 
					<!--================author =================
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
						select a.idx AS '댓글인덱스', a.nickname AS '댓글닉네임', a.date AS '댓글게시일', a.hit AS '댓글추천수', a.content AS '댓글내용'
						FROM Heal_gallery_review AS a
						WHERE a.gallery_idx = '".$board['idx']."'
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
																url: './api/board/galleryBoardHeart.php',
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


			</div>
		</div>
	</section>
	<!--================Content Area =================-->

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
      url: '/api/board/galleryBoardComment.php',
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
<? echo $session_nick;?>

<? echo $board['nickname'];?>