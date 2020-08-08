<? include 'menu.php' ?>
<?include 'header.php';?>
<body>
	<!--::header part start::-->
	<!--<header class="main_menu home_menu">-->
	<header class="main_menu home_menu menu_fixed animated fadeInDown">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-12">
					<nav class="navbar navbar-expand-lg navbar-light">
						<a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"		aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
							<ul class="navbar-nav">

								<!--<li class="nav-item active">
								<li class="nav-item">
									<a class="nav-link" href="video.php">운동 영상</a>
								</li>-->

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">운동 영상</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="reVideo.php">추천&인기영상</a>
										<a class="dropdown-item" href="video.php">모든영상</a>
										<a class="dropdown-item" href="favorite.php">즐겨찾기</a>
									</div>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="freeBoard.php">커뮤니티</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="galleryBoard.php">비포 & 애프터</a>
								</li>
<?if(!isset($_SESSION['id'])){?>
								<li class="nav-item">
									<a class="nav-link" href="login.php">로그인</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="privacy.php">회원가입</a>
								</li>
<?}else{?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">마이페이지</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="calendar.php">캘린더</a>
										<a class="dropdown-item" href="favorite.php">즐겨찾기</a>
										<a class="dropdown-item" href="myPage.php">정보관리</a>
									</div>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="HealthTube/workSpace/SH/api/logout_ok.php">로그아웃</a>
								</li>
<?}?>
							</ul>
						</div>

					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header part end-->
