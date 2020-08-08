<?php
include 'api/dbconn.php';

if($_GET['date_from'] == null){
	$date_from = date('Y-m-d');
} else {
	$date_from = $_GET['date_from'];
}

if($_SESSION['idx'] == null){
	?>
	<script>
		alert('로그인이 필요한 서비스입니다!');
		// history.back(-1);
		window.location.href="login.php";
	</script>
	<?
} else {

$conn = new DBC();
$conn->DBI();
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
			<h2><b>캘린더</b></h2>
			<div class="row">

				<div class="col-lg-12 mt-4">
					<div class="row">
						<div class="col-lg-4 text-left">
							<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
								<input type="hidden" name="date_from" value="<?php echo date("Y-m-d", strtotime("".$date_from." -1 days")); ?>">
								<button type="submit" id="dayPrev" class="btn btn-rounded btn-light btn-xs date-move-btn"><</button>
							</form>
						</div>

						<div class="col-lg-4 mt-2 t-today-text text-center">
							<a class="t-today" style="font-weight:900;"><?php echo $date_from; ?></a>
						</div>

						<div class="col-lg-4 text-right">
							<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
								<input type="hidden" name="date_from" value="<?php echo date("Y-m-d", strtotime("".$date_from." +1 days")); ?>">
								<button type="submit" id="dayNext" class="btn btn-rounded btn-light btn-xs date-move-btn">></button>
							</form>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /col-lg-12 mt-4 -->

				<div class="col-lg-12 card mt-4">
					<div class="col-lg-12 text-left mt-2">
						<h5 style="font-weight:900;"><font color="blue">오늘의 운동</font></h5>
					</div>
				</div>
				<!-- col-lg-12 card mt-4 -->
				<div class="col-lg-12 card">
					<?
					$sql = "
					SELECT c.video_id, c.title, c.content, c.category_body, c.category_equipment, b.status, b.idx
					FROM
					(
					    SELECT idx
					    FROM Heal_planner
					    WHERE member_idx = '".$_SESSION['idx']."' AND date = '".$date_from."'
					)a
					INNER JOIN
					(
					    SELECT planner_idx, video_idx, status, idx
					    FROM Heal_planner_video
					)b
					ON a.idx = b.planner_idx
					INNER JOIN
					(
					    SELECT *
					    FROM Heal_video
					)c
					ON b.video_idx = c.idx
					";
					$conn->DBQ($sql);
					$conn->DBE();
          $resCnt=$conn->resultRow();

          if($resCnt == 0){
            echo '<p style="text-align:center;margin-top:50px;margin-bottom:50px;">데이터가 없습니다.</p>';
          }else{
  					while($row=$conn->DBF()){
  					?>
  					<div class="card-body" style="min-height:200px;">
  						<div class="row">
  							<div class="col-lg-5">
                  <iframe width="100%" height="200px" src="https://www.youtube.com/embed/<?echo $row['video_id'];?>"
        		        frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
        		         allowfullscreen>
        		       </iframe>
  							</div>

  							<div class="col-lg-5">
                  <strong><p><?php echo $row['title']; ?></p></strong>
                  <p><?php echo $row['content']; ?></p>
                  <div class="mt-5">
                    <button type="button" class="btn btn-outline-success btn-sm"><?php echo $row['category_body']; ?></button>
      							<button type="button" class="btn btn-outline-info btn-sm">
      								<?php
      								if($row['category_equipment'] == "있음"){
      									echo "장비 있음";
      								} else {
      									echo "장비 없음";
      								}
      								?>
      							</button>
                  </div>
  							</div>

  							<div class="col-lg-2 text-right">
									<!-- <button type="button" class="btn btn-danger mt-3">삭제</button>
									<button type="button" class="btn btn-primary mt-3">완료</button> -->
  								<ul>
  									<li>
											<form action="api/calendarReg/delete.php" method="post">
												<input type="hidden" name="idx" value="<?php echo $row['idx']; ?>">
												<input type="hidden" name="date" value="<?php echo $date_from; ?>">
												<button type="submit" class="btn btn-danger mt-5">삭제</button>
											</form>
										</li>
  									<li>
											<?
											if($row['status'] == '미완료'){?>
												<form action="api/calendarReg/update.php" method="post">
													<input type="hidden" name="compare" value="미완료">
													<input type="hidden" name="no" value="<?php echo $row['idx']; ?>">
													<input type="hidden" name="date" value="<?php echo $date_from; ?>">
													<button type="submit" class="btn btn-danger mt-3">미완료</button>
												</form>
											<?}else{?>
												<form action="api/calendarReg/update.php" method="post">
													<input type="hidden" name="compare" value="완료">
													<input type="hidden" name="no" value="<?php echo $row['idx']; ?>">
													<input type="hidden" name="date" value="<?php echo $date_from; ?>">
													<button type="submit" class="btn btn-primary mt-3">완료</button>
												</form>
											<?}?>
										</li>
  								</ul>
  							</div>
  						</div>
  					</div>
  					<!-- /card-body 1 planner video -->
						<html><hr color="Gainsboro" width=100%></html>
					<?}?>
				</div>
				<!-- /col-lg-12 card -->

				<!-- <div class="col-lg-12 card mt-4">
					<div class="col-lg-12 text-left mt-2">
						<h5 style="font-weight:900;"><font color="blue">메모</font></h5>
						<textarea style="margin-top:10px;" name="memo" class="form-control"></textarea>
					</div>
				</div> -->


				<!-- col-lg-12 card mt-4 -->
				<!-- <div class="col-lg-12">
					<textarea name="memo" class="form-control"></textarea>
				</div> -->
				<!-- col-lg-12 -->
				<?}?>

			</div>
			<!-- /row -->
		</div>
		<!-- container -->
	</section>
	<!--================Content Area =================-->

<?include 'footer.php'; }?>
