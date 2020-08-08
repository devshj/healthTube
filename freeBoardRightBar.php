
				<div class="col-lg-4">
					<div class="blog_right_sidebar">

						<!--================search bar =================-->
						<aside class="single_sidebar_widget search_widget">
							<form action="<?echo $_SERVER['PHP_SELF'];?>" action="freeBoard.php" method="GET">
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="search_text" placeholder='Search Keyword' value="<?if($_GET['search_text'] == null)
										{}else{echo $_GET['search_text'];}?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
										<div class="input-group-append">
											<button class="btn" type="button"><i class="ti-search"></i></button>
										</div>
									</div>
								</div>
								<button class="button rounded-0 primary-bg text-white w-100 btn_2" type="submit">Search</button>
							</form>
						</aside>
						<!--================search bar =================-->

						<!--================category =================--><!--
						<aside class="single_sidebar_widget post_category_widget">
							<h4 class="widget_title">카테고리</h4>
							<ul class="list cat-list">
								<li>
									<a href="#" class="d-flex">
										<p>앙</p>
										<p>(글 개수)</p>
									</a>
								</li>
								<li>
									<a href="#" class="d-flex">
										<p>앙2</p>
										<p>(글 개수)</p>
									</a>
								</li>
								<li>
									<a href="#" class="d-flex">
										<p>앙3</p>
										<p>(글 개수)</p>
									</a>
								</li>
								<li>
									<a href="#" class="d-flex">
										<p>앙4</p>
										<p>(글 개수)</p>
									</a>
								</li>
							</ul>
						</aside>					
						<!--================category =================-->

						<!--================Recent Post =================-->
						<aside class="single_sidebar_widget popular_post_widget">
							<h3 class="widget_title">최근 게시물</h3>
							<?php
								$sql = "select * from Heal_board where cate = '1' order by idx desc limit 0,3"; #limit 0,5
								$conn->DBQ($sql);
								$conn->DBE();
								$cnt = $conn->resultRow();
								while($row=$conn->DBF()){
							?>
							<div class="media post_item" style="text-overflow:ellipsis; overflow:hidden;">									
								<div class="media-body" style="padding-left: 0px;">
									<a href="freeBoardView.php?idx=<?php echo $row['idx'];?>">
										<h5><?php echo $row['title'];?></h5>
									</a>
									<p><?php echo $row['date'];?></p>
								</div>
							</div>
							<?}?>
						</aside>
						<!--================Recent Post =================-->

					</div>
				</div>