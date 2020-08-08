<?php
include 'api/dbconn.php';

header('Content-Type: text/html; charset=UTF-8');
define("MAX_RESULTS", 10);

if (isset($_POST['submit']) || isset($_POST['page']))
{
  $keyword = $_POST['keyword'];
  $page = $_POST['page'];

  if (empty($keyword))
  {
    $response = array(
      "type" => "error",
      "message" => "Please enter the keyword."
    );
  }
}
?>
<?include 'header.php';?>
<?include 'menu.php';?>

	<!--================Content Area =================-->
	<section class="blog_area section_padding" style="min-height:1100px;padding: 100px 0px;">
		<div class="container">
      <form id="keywordForm" method="post" action="">
        <h3 class="my-4"><strong>검색 youtube api</strong></h3>
        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="input-group">
              <input type="text" class="form-control" id="keyword" name="keyword" placeholder="검색어를 입력하세요 . . ." value="<?echo $keyword;?>">
              <span class="input-group-btn">
                <button class="btn btn-outline-secondary" type="submit" id="submit" name="submit">
                  <span><i class="fa fa-search"></i></span>
                </button>
             </span>
            </div>
            <!-- /input-group -->
          </div>
          <!-- /col-lg-12 -->
          <div class="col-lg-12 mb-4">
          <?php
            if (!empty($keyword))
            {
              $apikey = 'AIzaSyAK8j0Id--PxxAdgDCuvBTiIVISx_TyPoM';
              $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey . '&order=viewCount&type=video'
              . '&pageToken=' . $page;

              $ch = curl_init();

              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_VERBOSE, 0);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              $response = curl_exec($ch);

              curl_close($ch);
              $data = json_decode($response);
              $value = json_decode(json_encode($data), true);

              echo "영상 개수 : ".number_format($value['pageInfo']['totalResults'])."<br/>";
              echo "<br/>";
              //$prev = $value['prevPageToken'];
              //$next = $value['nextPageToken'];?>
              <div class="row">
                <?
                for ($i = 0; $i < MAX_RESULTS; $i++) {
                  $thumb = $value['items'][$i]['snippet']['thumbnails']['medium']['url']; // 썸네일
                  $videoId = $value['items'][$i]['id']['videoId'];                        // 영상 ID
                  $title = $value['items'][$i]['snippet']['title'];                       // 영상 제목
                  $description = $value['items'][$i]['snippet']['description'];           // 영상 설명
                  $channel = $value['items'][$i]['snippet']['channelTitle'];              // 영상 채널
                  $channelId = $value['items'][$i]['snippet']['channelId'];               // 채널 ID
                ?>
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-4 text-left">
                      <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?echo $videoId;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <!-- /col-lg-4 text-left -->
                    <div class="col-lg-8 text-left">
                      <?
                      echo "영상 ID : ".$videoId."<br/>";
                      echo "영상 제목: ".$title."<br/>";
                      echo "영상 설명 : ".$description."<br/>";
                      echo "영상 채널 : ".$channel."<br/>";
                      echo "채널 ID : ".$channelId."<br/>";
                      echo "썸네일 : ".$thumb."<br/>";

                      $title = str_replace("'","",$title);
                      $title = str_replace('"','',$title);

                      $description = str_replace("'","",$description);
                      $description = str_replace('"','',$description);

                      $channel = str_replace("'","",$channel);
                      $channel = str_replace('"','',$channel);

                      $channelId = str_replace("'","",$channelId);
                      $channelId = str_replace('"','',$channelId);
                      ?>
                    </div>
                    <!-- /col-lg-6 text-left -->
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-6">
                        </div>

                        <div class="col-lg-2">
                          <select class="form-control" id="category_purpose<?echo $i;?>">
                            <option value='nan' selected>-- 목적 --</option>
                            <option value="바디빌딩">체형을 키움</option>
                            <option value="피트니스">탄력있는 몸매</option>
                            <option value="다이어트">체중 줄이기</option>
                          </select>
                        </div>

                        <div class="col-lg-2">
                         <select class="form-control" id="category_body<?echo $i;?>">
                           <option value='nan' selected>-- 부위 --</option>
                           <optgroup label="상체">
                             <option value="어깨">어깨</option>
                             <option value="가슴">가슴</option>
                             <option value="등">등</option>
                             <option value="이두">이두</option>
                             <option value="삼두">삼두</option>
                           </optgroup>

                           <optgroup label="하체">
                             <option value="엉덩이">엉덩이</option>
                             <option value="허벅지">허벅지</option>
                             <option value="종아리">종아리</option>
                           </optgroup>

                           <optgroup label="전신">
                             <option value="허리">허리</option>
                             <option value="복근">복근</option>
                           </optgroup>
                         </select>
                       </div>

                       <div class="col-lg-2">
                         <select class="form-control" id="category_equipment<?echo $i;?>">
                           <option value='nan' selected>-- 장비 --</option>
                           <option value="있음">장비 있음</option>
                           <option value="없음">장비 없음</option>
                         </select>
                       </div>
                      </div>
                      <!-- /row -->
                    </div>

                    <div class="col-lg-2 text-right">
                      <button type="button" id="subBtn<?echo $i;?>" class="btn btn-outline-secondary">등록</button>
                    </div>
                    <script>
                      $("#subBtn<?echo $i;?>").click(function(){
                        if($("#category_purpose<?echo $i;?>").val() == "nan"){
                          alert('목적을 선택해주세요!');
                          return false;
                        }else if($("#category_body<?echo $i;?>").val() == "nan"){
                          alert('부위를 선택해주세요!');
                          return false;
                        }else if($("#category_equipment<?echo $i;?>").val() == "nan"){
                          alert('장비를 선택해주세요!');
                          return false;
                        }
                        $.ajax({
                          url: "./api/videoReg/insert.php",
                          type: "POST",
                          data:{ category_body: $("#category_body<?echo $i;?>").val(), category_equipment: $("#category_equipment<?echo $i;?>").val(),
                          videoId: "<?echo $videoId;?>", title: "<?echo $title;?>", description: "<?echo $description;?>",
                          channel: "<?echo $channel;?>", channelId: "<?echo $channelId;?>", thumb: "<?echo $thumb;?>", category_purpose: $("#category_purpose<?echo $i;?>").val() },
                          success:function(data)
                          {
                            alert('성공!');
                            // alert(data);
                          }
                        })
                      });
                    </script>
                    <html><hr class="mt-3 mb-3" color="black" width=100%></html>
                  </div>
                  <!-- /row -->
                </div>
                <!-- /col-lg-12 -->
              <?}?>
            </div>
            <!-- /row -->
          <?}?>
          </div>
          <!-- /col-lg-12 mb-4 -->
          <div class="col-lg-12 mb-4" style="text-align:center">
            <?if(isset($value['prevPageToken'])){?>
              <button type="submit" class="btn btn-outline-primary" name="page" value="<?echo $value['prevPageToken']?>">이전</button>
            <?}if(isset($value['nextPageToken'])){?>
              <button type="submit" class="btn btn-outline-primary" name="page" value="<?echo $value['nextPageToken']?>">다음</button>
            <?}?>
          </div>
        </div>
        <!-- /row -->
      </form>
  		</div>
      <!-- /container -->
  	</section>
  	<!--================Content Area =================-->

<?include 'footer.php';?>
