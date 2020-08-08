<?
include '../dbconn.php';
include '../pio/predictClass.php';
include '../pio/eventClass.php';

$conn = new DBC();
$conn->DBI();

$PIO = new Event($machineUrl."event.php");

if($_SESSION['idx'] != null){
  $entityId = 'u'.$_SESSION['idx']; //lastId (u + 회원 idx)
  $targetEntityId = 'i'.$_POST['video_no']; //lastId (i + 영상 idx)
  $PIO->setBuy($entityId, $targetEntityId);
}

$sql = "select * from Heal_scrab where video_idx = '".$_POST['video_no']."' and member_idx = '".$_POST['id']."'";
$conn->DBQ($sql);
$conn->DBE();
$cnt = $conn->resultRow();

if($cnt == 0){
  $sql = "insert into Heal_scrab(member_idx, video_idx, date)
  values('".$_POST['id']."','".$_POST['video_no']."','".date('Y-m-d')."')";
  $conn->DBQ($sql);
  $conn->DBE();
} else {
  $sql = "update Heal_scrab set flag = 1 where member_idx = '".$_POST['id']."'";
  $conn->DBQ($sql);
  $conn->DBE();
}
?>
<html>
<head>
</head>
  <body>
    <button type="button" id="btnDelete" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
    <script>
      $("#btnDelete").click(function(){
        $.ajax({
          url: './api/videoReg/scrabDelete.php',
          type: 'POST',
          data: { video_no: '<?echo $_POST['video_no'];?>', id: '<?echo $_SESSION['idx'];?>' },
          success:function(data){
            alert('삭제 되었습니다!');
            $("#scrab_area").html(data);
          }
        })
      });
    </script>
  </body>
</html>
