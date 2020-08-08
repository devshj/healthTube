<?php
include 'api/dbconn.php';
include 'api/pio/predictClass.php';
include 'api/pio/eventClass.php';

$conn = new DBC();
$conn->DBI();

$PIO = new Event($machineUrl."event.php");

if(isset($_GET['no'])) {
  $no = $_GET['no'];
}

$sql = "select * from Heal_video where idx = '".$no."'";
$conn->DBQ($sql);
$conn->DBE();
$row=$conn->DBF();

// echo $_SESSION['idx'];

if($_SESSION['idx'] != null){
  $entityId = 'u'.$_SESSION['idx']; //lastId (u + 회원 idx)
  $targetEntityId = 'i'.$row['idx']; //lastId (i + 영상 idx)
  $PIO->setView($entityId, $targetEntityId);
	//print_r($PIO -> getEvent());
}
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b><?php echo $row['title']; ?></b></h2>
			<div class="row">



        <div class="col-lg-9">
		      <!-- <div class="card-body"> -->
		      <iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?echo $row['video_id'];?>"
		        frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
		         allowfullscreen>
		       </iframe>
		      <!-- </div> -->
		      <!-- card-body -->
		    </div>
		    <!-- /col-lg-9 card -->

		    <div class="col-lg-3 card">
          <div class="card-body">
  		      <h5 class="mt-3" style="font-weight: 500;"><strong>운동 강도:</strong> <?php echo $row['strength']; ?> </h5><br>
  		      <h5 style="font-weight: 500;"><strong>장비:</strong> <?php echo $row['category_equipment']; ?></h5>
          </div>

          <div class="card-footer text-muted">
  		      <div class="row mt-5">
              <html><hr class="mt-3 mb-3" color="Gainsboro" width=100%></html>
              <i class="fa fa-heart-o"></i>
  		        <!-- heart -->
  		        <div class="col-lg-4 text-center" id="scrab_area">
                <?
                $sql = "
                SELECT * FROM Heal_scrab WHERE member_idx = '".$_SESSION['idx']."' and video_idx = '".$row['idx']."'
                ";
                $conn->DBQ($sql);
                $conn->DBE();
                $scrab_cnt = $conn->resultRow();
                $scrab = $conn->DBF();
                if($scrab_cnt == 0 or $scrab['flag'] == 0){
                ?>
                <!-- <form action="./api/videoReg/scrab.php" method="post" id="heart_ins">
                  <input type="hidden" name="compare" value="ins">
                  <input type="hidden" name="no" value="<?php //echo $row['idx']; ?>">
                  <button type="button" id="btn_ins" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
                </form> -->

  		          <button type="button" id="btnInsert" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
                <script>
                  $("#btnInsert").click(function(){
                    $.ajax({
                      url: './api/videoReg/scrabInsert.php',
                      type: 'POST',
                      data: { video_no: '<?echo $row['idx'];?>', id: '<?echo $_SESSION['idx'];?>' },
                      success:function(data){
                        alert('추가 되었습니다!');
                        $("#scrab_area").html(data);
                      }
                    })
                  });
                </script>

                <?}else{?>
                  <!-- <form action="./api/videoReg/scrab.php" method="post" id="heart_del">
                    <input type="hidden" name="compare" value="del">
                    <input type="hidden" name="no" value="<?php //echo $row['idx']; ?>">
                    <button type="button" id="btn_del" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
                  </form> -->

                  <button type="button" id="btnDelete" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
                  <script>
                    $("#btnDelete").click(function(){
                      $.ajax({
                        url: './api/videoReg/scrabDelete.php',
                        type: 'POST',
                        data: { video_no: '<?echo $row['idx'];?>', id: '<?echo $_SESSION['idx'];?>' },
                        success:function(data){
                          alert('삭제 되었습니다!');
                          $("#scrab_area").html(data);
                        }
                      })
                    });
                  </script>
                <?}?>
  		        </div>

  		        <!-- calendar -->
  		        <div class="col-lg-4 text-center">
                <form action="./api/videoReg/planner.php" method="post" id="plan_ins">
                  <?if($_SESSION['idx'] != null){?>
      		          <button data-toggle="datepicker" type="button" id="calendarBtn" class="btn btn-flat btn-outline-dark btn-md">
                      <i class="fa fa-calendar"></i>
                    </button>
                  <?}else{?>
                    <button data-toggle="datepicker" type="button" id="calendarBtn" class="btn btn-flat btn-outline-dark btn-md" disabled="">
                      <i class="fa fa-calendar"></i>
                    </button>
                  <?}?>
                  <input type="hidden" name="no" value="<? echo $row['idx']; ?>">
                  <input data-toggle="datepicker" type="hidden" id="date_from" name="date_from" value="">
                </form>
  		        </div>

              <!-- <div class="modal fade bd-example-modal-lg" id="modalCalendar">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
                    </div>
                  </div>
                </div>
              </div> -->

  		        <!-- kakao share -->
  		        <div class="col-lg-4 text-center">
                <a id="kakao-link-btn" href="javascript:;">
                  <button type="button" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-share-alt"></i></button>
                </a>
                <script type='text/javascript'>
                  // 사용할 앱의 JavaScript 키를 설정해 주세요.
                  Kakao.init('8fd6a7bd6a948444bd2d8914deac088e');
                  // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
                  Kakao.Link.createDefaultButton({
                    container: '#kakao-link-btn',
                    objectType: 'feed',
                    content: {
                      title: '<?echo $row['title'];?>',
                      description: '#<?echo $row['category_body'];?> 운동',
                      imageUrl: '<?echo $row['thumb'];?>',
                      link: {
                        androidExecParams: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                        iosExecParams: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                        mobileWebUrl: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                        webUrl: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>'
                      }
                    },
                    buttons: [
                      {
                        title: '보기',
                        link: {
                          androidExecParams: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                          iosExecParams: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                          mobileWebUrl: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>',
                          webUrl: 'https://soohoon.co.kr/videoDetail.php?no=<?echo $row['idx'];?>'
                        }
                      }
                    ]
                  });
              </script>
  		        </div>
  		      </div>
  		      <!-- /row -->
          </div>
		    </div>
		    <!-- col-lg-3 -->

		    <div class="col-lg-9 mt-3">
		      <h5 style="font-weight:900;font-size:17px;"><?php echo $row['title']; ?></h5>
		      <h5 style="font-weight:400;font-size:15px;">조회수 <?php echo $row['view']; ?></h5>
		      <html><hr class="mt-3 mb-3" color="Gainsboro" width=100%></html>
		      <div class="row">
		        <!-- <div class="col-lg-1">
		          <img src="images/kisspng-circle-logo.png" alt="HealthTube-logo" height="100%" width="100%">
		        </div> -->

		        <div class="col-lg-11">
		          <h5 style="font-weight:500;">Queen Official</h5>
		          <h5 style="font-weight:200;">게시일: <?php echo substr($row['date'],0,10); ?></h5>
		        </div>

		        <div class="col-lg-12 mt-4">
		          <h5 style="font-weight:300;"><?php echo $row['content']; ?></h5>
		        </div>
		      </div>
		    </div>
		    <!-- col-lg-9 mt-3 card -->

		    <!-- 유사 영상 리스트 -->
		    <div class="col-lg-3 mt-3 card">
		    </div>
		    <!-- col-lg-3 mt-3 card -->

		    <!-- 댓글 입력란 -->
		    <div class="col-lg-9 mt-3" id="comments_area">
					<?
          $i=0;
					$idx = "";
		      // $sql = "
		      // SELECT a.idx AS '댓글인덱스', a.nickname AS '댓글닉네임', a.date AS '댓글게시일', a.hit AS '댓글추천수', a.content AS '댓글내용',
		      // b.idx AS '대댓글인덱스', b.review_idx AS '외래인덱스',b.nickname AS '대댓글닉네임', b.date AS '대댓글게시일', b.hit AS '대댓글추천수',
		      // b.content AS '대댓글내용'
		      // FROM Heal_video_review AS a
		      // LEFT JOIN Heal_video_re_review AS b on a.idx = b.review_idx";

          $sql = "
          SELECT a.idx AS '댓글인덱스', a.nickname AS '댓글닉네임', a.date AS '댓글게시일', a.hit AS '댓글추천수', a.content AS '댓글내용'
		      FROM Heal_video_review AS a
          WHERE a.video_idx = '".$row['idx']."'
          ORDER BY idx desc
          ";
		      $conn->DBQ($sql);
		      $conn->DBE();
		      $cnt = $conn->resultRow();
					?>
					<div class="comments-area">
						<h4><?php echo $cnt.' 댓글'; ?></h4>
            <div class="col-lg-12 text-right">
              <select class="order" id="order">
                <option value="res" selected>최신순</option>
                <option value="rec">추천순</option>
              </select>
            </div>
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
												<p class="date"><?php echo $row['댓글게시일'] ?> </p>
											</div>
											<div class="reply-btn" id="reply<?echo $row['댓글인덱스'];?>">
                        <div class="custom_like" id="like<?echo $row['댓글인덱스'];?>" class="btn-reply text-uppercase"><i class="fa fa-heart"></i> <?php echo $row['댓글추천수']; ?></div>
                        <script>
                          $("#like<?echo $row['댓글인덱스'];?>").click(function(){
                            $.ajax({
                              url: './api/videoReg/heart.php',
                              type: 'POST',
                              data: { no: '<?echo $row['댓글인덱스'];?>' },
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
					<!-- /comments-area -->
        </div>
        <!-- /col-lg-9 mt-3 -->

        <div class="col-lg-9">
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
					<!-- /comment-form -->
          <?}?>
        </div>
			</div>
		</div>

	</section>
	<!--================Content Area =================-->

<?include 'footer.php';?>
<link rel="stylesheet" href="js/datepicker/datepicker.css?ver=1">
<script src="js/datepicker/datepicker.js"></script>
<script src="js/datepicker/datepicker.ko-KR.js"></script>
<script>
var id = '<?echo $_SESSION['id'];?>';
  $(function(){
    if(id == ''){
      // alert('로그인이 필요한 서비스입니다!');
      // return false;
    } else {
      $('[data-toggle = "datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        language: 'ko-KR'
      });
      $("#calendarBtn").click(function(){
        $("#date_from").datepicker('setDate', $("#calendarBtn").html());
        $("#calendarBtn").blur(function(){
          $('.blog_area').hover(function(){
            $("#date_from").datepicker('setDate', $("#calendarBtn").html());
            $("#plan_ins").submit();
          });
        });
      });
    }
  });

  $(".order").change(function(){
    $.ajax({
      url: './api/videoReg/commentList.php',
      type: 'POST',
      data: { no: '<?echo $_GET['no'];?>', orderby: $("#order option:selected").val() },
      success:function(data){
        $("#comments_area").html(data);
      }
    })
  });

  $("#commentSub").click(function(){
    $.ajax({
      url: './api/videoReg/comment.php',
      type: 'POST',
      data: { no: '<?echo $_GET['no'];?>', id: '<?echo $_SESSION['id'];?>', contents: $("#comment").val(), orderby: $("#order option:selected").val()  },
      success:function(data){
        $("#comment").val('');
        $("#comments_area").html(data);
      }
    })
  });

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
