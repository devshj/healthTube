<?
include '../dbconn.php';

$conn = new DBC();
$conn->DBI();

// $sql = "delete from Heal_scrab where member_idx = '".$row[0]."'";
$sql = "update Heal_scrab set flag = 0 where member_idx = '".$_POST['id']."'";
$conn->DBQ($sql);
$conn->DBE();
?>
<html>
<head>
</head>
  <body>
    <button type="button" id="btnInsert" class="btn btn-flat btn-outline-dark btn-md"><i class="fa fa-heart"></i></button>
    <script>
      $("#btnInsert").click(function(){
        $.ajax({
          url: './api/videoReg/scrabInsert.php',
          type: 'POST',
          data: { video_no: '<?echo $_POST['video_no'];?>', id: '<?echo $_SESSION['idx'];?>' },
          success:function(data){
            alert('추가 되었습니다!');
            $("#scrab_area").html(data);
          }
        })
      });
    </script>
  </body>
</html>
