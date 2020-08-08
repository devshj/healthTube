<?include 'header.php';?>
<?include 'menu.php';?>
<?
/*
if(isset($_SESSION['id'])){
	echo "세션 존재";
}else{
	echo "세션 미 존재";
}
*/
?>
    <!-- banner part start-->
    <section class="banner_part">
				<div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <div class="banner_text text-center">
                        <div class="banner_text_iner">
                            <h2>Join <span>now</span> </h2>
                            <p>get in shape today</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!--::exclusive_item_part start::-->
    <section class="about_us section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div class="section_tittle">
                        <p>편리한 기능</p>
                        <h2>무료로 가입하세요!</h2>
                        <span>무료로 가입하고 다양한 기능지원과 영상을 추천 받으세요</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <div class="our_feature">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single_feature_item">
                                    <div class="feature_item_icon">
                                        <span class="fas fa-hand-holding-heart"></span>
                                    </div>
                                    <h3><a href="reVideo.php">추천 서비스</a></h3>
                                    <p>기계학습으로 당신에게 알맞은 영상을 추천 받으세요.</p>
                                </div>
                                <div class="single_feature_item">
                                    <div class="feature_item_icon">
                                        <span class="far fa-heart"></span>
                                    </div>
                                    <h3><a href="favorite.php">즐겨찾기</a></h3>
                                    <p>소장하고 싶은 영상을 스크랩하세요.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="about_img">
                        <img src="img/about_bg.png" alt="#">
                    </div>
                </div>
									
                <div class="col-lg-4">
                    <div class="our_feature">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single_feature_item">
                                    <div class="feature_item_icon">
                                        <span class="far fa-calendar-check"></span>
                                    </div>
                                    <h3> <a href="calendar.php">일정관리</a></h3>
                                    <p>일정을 관리하고 진행상태를 모니터링 할 수 있는 캘린더를 이용해 자신의 일정을 계획하고 관리하세요.</p>
                                </div>
                                <div class="single_feature_item">
                                    <div class="feature_item_icon">
                                        <span class="far fa-comments"></span>
                                    </div>
                                    <h3><a href="freeBoard.php">커뮤니티</a></h3>
                                    <p>커뮤니티를 이용해 회원들과 운동팁 및 영양정보등을 공유하세요.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay_icon">
            <img src="img/animate_icon/icon_1.png" class="amitated_icon_1" alt="animate_icon">
            <img src="img/animate_icon/icon_2.png" class="amitated_icon_2" alt="animate_icon">
            <img src="img/animate_icon/icon_3.png" class="amitated_icon_3" alt="animate_icon">
            <img src="img/animate_icon/icon_4.png" class="amitated_icon_4" alt="animate_icon">
            <img src="img/animate_icon/icon_5.png" class="amitated_icon_5" alt="animate_icon">
        </div>
    </section>
    <!--::exclusive_item_part end::-->

    <!-- extends part start
    <section class="extends_part section_padding">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-5">
                    <div class="extends_img">
                        <img src="img/excuses_video_bg.png" alt="">
                        <div class="extends_video">
                            <div class="intro_video_iner text-center d-flex align-items-center">
                                <div class="intro_video_icon">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="ti-control-play"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="extends_member_text">
                        <h2>Make yourself <br>
                            stronger than your excuses</h2>
                        <p>Creature moveth behold darkness that fill very and don't. Together one Living rule.
                            Saying you're light called years i be beast bring tree don herb evening the called tree
                            green of</p>
                        <ul>
                            <li><span class="ti-pencil-alt"></span>Earth his there multiply she'd one open made years
                                called fill</li>
                            <li><span class="ti-ruler-pencil"></span>Earth his there multiply she'd one open made years
                                called</li>
                        </ul>
                        <a href="#" class="btn_2">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team part end-->

    <!--::exclusive_item_part start::
    <section class="our_offer" style="padding: 0px 0px 30px;">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-5">
                    <div class="section_tittle">
                        <p>best Courses</p>
                        <h2>Why you Join with us</h2>
                        <span>Stars fowl deep she greater bearing to seed dont is let you're appear first thing saying
                            it years abundantly fowl tree you shall also</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="single_offer_part">
                        <div class="single_offer">
                            <img src="img/offer_img_1.png" alt="offer_img_1">
                            <div class="hover_text">
                                <h2>Fitness Training</h2>
                                <p>Fly replenish dominion evening make veriety of </p>
                                <a href="#" class="offer_btn"><span class="flaticon-slim-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="single_offer_part">
                        <div class="single_offer">
                            <img src="img/offer_img_2.png" alt="offer_img_1">
                            <div class="hover_text">
                                <h2>Fitness Training</h2>
                                <p>Fly replenish dominion evening make veriety of </p>
                                <a href="#" class="offer_btn"><span class="flaticon-slim-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="single_offer_part">
                        <div class="single_offer">
                            <img src="img/offer_img_3.png" alt="offer_img_1">
                            <div class="hover_text">
                                <h2>Fitness Training</h2>
                                <p>Fly replenish dominion evening make veriety of </p>
                                <a href="#" class="offer_btn"><span class="flaticon-slim-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="single_offer_part">
                        <div class="single_offer">
                            <img src="img/offer_img_4.png" alt="offer_img_1">
                            <div class="hover_text">
                                <h2>Fitness Training</h2>
                                <p>Fly replenish dominion evening make veriety of </p>
                                <a href="#" class="offer_btn"><span class="flaticon-slim-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::exclusive_item_part end::-->

<?include 'footer.php';?>
