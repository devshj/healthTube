<? 
	include '../dbconn.php';

	$conn = new DBC();
	$conn->DBI();

	$id = $_SESSION['id'];
	$sql = "select * from Heal_member where id='".$id."'";
	$conn->DBQ($sql);
	$conn->DBE();
	while ($row = $conn->DBF()) {
		$nickname = $row['nickname'];
	}
	
	$idx = $_POST['idx'];
	$hit = $_POST['hit'];
	$title = $_POST['title'];
	$date = date('y-m-d');
	$content = $_POST['content'];
		if($content != "") {
			preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($content), $out5);
		  $test = "";
			for($i=0; $i< sizeof($out5[1]); $i++) {
				eregi("[^= '/]*\.(gif|jpg|bmp|png)", $out5[1][$i], $regText2);
				$test .= $regText2[0] .",";
			}
			$test = rtrim($test, ",");
		}

	$sql = "update Heal_board set title='".$title."',date='".$data."', hit='".$hit."', img='".$test."', content='".$content."' where idx='".$idx."'";
	$conn->DBQ($sql);
	$conn->DBE();

?>

<script type="text/javascript">
alert("수정이 완료되었습니다.");
location.href="../../galleryBoardView.php?idx=<?echo $idx;?>";
</script>