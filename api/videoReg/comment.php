<?
include '../dbconn.php';
$conn = new DBC();
$conn->DBI();

$sql = "select * from Heal_member where id = '".$_POST['id']."'";
$conn->DBQ($sql);
$conn->DBE();
$row=$conn->DBF();

$sql = "insert into Heal_video_review(video_idx, nickname, date, content)
values('".$_POST['no']."','".$row['nickname']."','".date("Y-m-d")."','".$_POST['contents']."')";
$conn->DBQ($sql);
$conn->DBE();

if($_POST['orderby'] == 'res'){
  $sql = "
  SELECT idx AS '댓글인덱스', nickname AS '댓글닉네임', date AS '댓글게시일', hit AS '댓글추천수', content AS '댓글내용'
  FROM Heal_video_review
  WHERE video_idx = '".$_POST['no']."'
  ORDER BY idx desc
  ";
} else if($_POST['orderby'] == 'rec'){
  $sql = "
  SELECT idx AS '댓글인덱스', nickname AS '댓글닉네임', date AS '댓글게시일', hit AS '댓글추천수', content AS '댓글내용'
  FROM Heal_video_review
  WHERE video_idx = '".$_POST['no']."'
  ORDER BY hit desc
  ";
}
$conn->DBQ($sql);
$conn->DBE();
$cnt = $conn->resultRow();
?>
<html>
  <head>
  </head>
  <body>
    <div class="comments-area">
      <h4><?php echo $cnt.' 댓글'; ?></h4>
      <div class="col-lg-12 text-right">
        <select class="order" id="order">
          <option value="res" <?if($_POST['orderby'] == 'res'){echo 'selected';}?>>최신순</option>
          <option value="rec" <?if($_POST['orderby'] == 'rec'){echo 'selected';}?>>추천순</option>
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
  </body>
</html>
