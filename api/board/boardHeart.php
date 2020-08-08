<?
include '../dbconn.php';
$conn=new DBC();
$conn->DBI();

$sql = "update Heal_board_review set hit = hit + 1 where idx = '".$_POST['idx']."'";
$conn->DBQ($sql);
$conn->DBE();

$sql = "select hit from Heal_board_review where idx = '".$_POST['idx']."'";
$conn->DBQ($sql);
$conn->DBE();
$cnt = $conn->DBF();

try {
		## 마무리
		$result['success']	= true;
		$result['data']		  = "
    <i class='fa fa-heart'></i> ".$cnt[0]."
    ";
	} catch(exception $e) {
	} finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
?>