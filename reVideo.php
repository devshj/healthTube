<?php
include 'api/dbconn.php';
include 'api/pageClass.php';

$conn = new DBC();
$conn->DBI();

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

<?
if($_GET['search_text'] == null){
	$searchText = " WHERE title LIKE '%%'";
} else {
	$searchText = " where title LIKE '%".$_GET['search_text']."%' ";
}
if($_GET['top_1'] == null and $_GET['top_2'] == null and $_GET['top_3'] == null and $_GET['top_4'] == null and $_GET['top_5'] == null
 and $_GET['bot_1'] == null and $_GET['bot_2'] == null and $_GET['bot_3'] == null and $_GET['core_1'] == null and $_GET['core_2'] == null
 and $_GET['equipment_1'] == null and $_GET['equipment_1'] == null)
 {
		$searchBody = ' ';
 }else
 {
		$searchBody = " and category_body in ('".$_GET['top_1']."','".$_GET['top_2']."','".$_GET['top_3']."','".$_GET['top_4']."','".$_GET['top_5']."'
		,'".$_GET['bot_1']."','".$_GET['bot_2']."','".$_GET['bot_3']."','".$_GET['core_1']."','".$_GET['core_2']."') ";
 }

// 페이징
$query = "select * from Heal_video $searchText $searchBody order by idx desc";
$conn->DBQ($query);
$conn->DBE();
$cnt = $conn->resultRow();

$total_row = $cnt;
$list = 8;
$block = 5;
$page = new paging($_GET['page'], $list, $block, $total_row);

if(isset($_GET['search_text']) or isset($_GET['top_1']) or isset($_GET['top_2']) or isset($_GET['top_3']) or isset($_GET['top_4']) or isset($_GET['top_5'])
 or isset($_GET['bot_1']) or isset($_GET['bot_2']) or isset($_GET['bot_3']) or isset($_GET['core_1']) or isset($_GET['core_2'])
 or isset($_GET['equipment_1']) or isset($_GET['equipment_2'])){
	$page->setUrl("search_text=".$_GET['search_text']."&top_1=".$_GET['top_1']."&top_2=".$_GET['top_2']."&top_3=".$_GET['top_3']."&top_4=".$_GET['top_4'].
	"&top_5=".$_GET['top_5']."&bot_1=".$_GET['bot_1']."&bot_2=".$_GET['bot_2']."&bot_3=".$_GET['bot_3']."&core_1=".$_GET['core_1']."&core_2=".$_GET['core_2'].
	"&equipment_1=".$_GET['equipment_1']."&equipment_2=".$_GET['equipment_2']);
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

<!--================Blog Area =================-->
<!--<section class="blog_area section_padding" style="padding: 50px 0px;">-->
<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
	<div class="container">
		<h2><b>추천&인기영상</b></h2>
		<div class="row">
			<div class="col-lg-12">
				<form action="<?echo $_SERVER['PHP_SELF'];?>" method="GET">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="search_text" placeholder="검색어를 입력하세요 . . ."
						value="<?if($_GET['search_text'] == null){}else{echo $_GET['search_text'];}?>">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-outline-secondary" id="searchButton">
								<span><i class="fa fa-search"></i></span>
							</button>
						</span>
					</div>
				</form>
			</div>
			<!-- /col-lg-12 -->

			<?
			$sql = "
			select * from Heal_video $searchText $searchBody order by idx desc limit $limit, $list;
			";
			$conn->DBQ($sql);
			$conn->DBE();
			while($row=$conn->DBF()){
				?>
				<div class="col-lg-3 mt-3">
					<div class="card">
						<a href="videoDetail.php?no=<?echo $row['idx'];?>">
							<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo $row['video_id']; ?>/0.jpg">
							<p style="text-align:center;margin-top:10px;">
								<?php echo str_replace($row['title'],mb_substr($row['title'],0,27,"utf-8")."...",$row['title']); ?>
							</p>
						</a>
						<div class="text-center mt-2 mb-2">
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
					<!-- /card -->
				</div>
				<!-- /col-lg-3 mt-3 -->
				<?}?>
				<div class="col-lg-12 text-center mt-5">
					<nav class="blog-pagination justify-content-center d-flex">
						<ul class="pagination" style="justify-content: center;">
							<?echo $paging; ?>
						</ul>
					</nav>
				</div>

			</div>
			<!-- /row -->

		</div>
		<!-- /container -->
	</section>

	<?include 'footer.php'; }?>
