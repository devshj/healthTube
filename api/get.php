<?
include 'dbconn.php';

header('Content-Type: text/html; charset=utf-8');
//echo('<pre>'); print_r($_GET); echo('</pre>');
//echo('<pre>'); print_r($_POST); echo('</pre>');
//echo $_FILES['file']['name'];

$contents = $_POST['contents'];
echo $contents;
/*
$conn = new DBC();
$conn->DBI();
$query ="INSERT INTO test(content) VALUES ('".$contents."')";
//$query ="SELECT * FROM test WHERE idx = 4";
$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
$conn->DBE(); //쿼리 실행

//$row = $conn->DBF();
//echo $row['idx']."  ".$row['content']."<br/>";
$conn->DBO();
*/
?>