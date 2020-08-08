<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start();
    session_destroy();?>
    <script type="text/javascript">alert("로그아웃 되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=../../index.php" />
  </body>
</html>