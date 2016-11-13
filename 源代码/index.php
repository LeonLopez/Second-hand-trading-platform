<?php 
require 'config.php';
require 'connect_db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>大学生二手交易平台</title>
	<link rel="stylesheet" type="text/css" href="css/index_style.css" />
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/img_slider.js"></script>
</head>
<body>
	<div id="top">
		<div class="top_bar">
			<ul class="top_left">
			    <?php if(isset($_SESSION['USERNAME'])==FALSE){?>
				<li><a href="login.php" class="login">登录</a></li>
				<li><a href="register.php" class="sign">注册</a></li>
				<?php }
				      else{
				?>
				<li>欢迎您，<?php echo $_SESSION['SNAME'];  ?></li>
				<li><a href="logout.php" >注销</a></li>
				<?php } ?>
			</ul>
			<ul class="top_right">
				<li><a href="#" class="personal">个人中心</a></li>
				<li><a href="#" class="shopping">购物车</a></li>
				<li><a href="#" class="favorite">收藏夹</a></li>
				<li><a href="#" class="annoucement">公告</a></li>
			</ul>
		</div>
	</div>
	<div id="header">
		<div class="logo_bgm">
			<img src="images/LOGO.png" alt="网站logo" />
		</div>
		<h3 class="logo_headline"><a href="#">大学生二手交易平台</a></h2>
		<ul id="top_nav">
			<li><a href="#" class="index active">首页</a></li>
			<li><a href="#" class="classify">分类</a></li>
			<li><a href="#" class="publish">发布闲置</a></li>
		</ul>
		<div class="search">
			<form action="#">
				<input type="text" id="search_goods" placeholder="搜你所想" />
				<input type="submit" id="search_btn" value="搜索">
			</form>
		</div>
	</div>
	<div id="content">
		<div class="banner">
			<div class="goods_list_box">
				<ul class="goods_list">
					<li>
						<div class="bike">
							<b></b>
							<a href="#">闲置单车</a>		
						</div>
					</li>
					<li>
						<div class="electrical">
							<b></b>
							<a href="#">闲置电器</a>		
						</div>
					</li>
					<li>
						<div class="books">
							<b></b>
							<a href="#">闲置图书</a>		
						</div>
					</li>
					<li>
						<div class="digit">
							<b></b>
							<a href="#">闲置数码</a>		
						</div>
					</li>
					<li>
						<div class="cloth">
							<b></b>
							<a href="#">闲置服饰</a>		
						</div>
					</li>
					<li>
						<div class="other">
							<b></b>
							<a href="#">闲置其他</a>		
						</div>
					</li>
				</ul>
			</div>
			<div class="index_slider">
				<div id="img_roll">
				<a href="#">
						<img src="images/index-slider/1.jpg" alt="广告1">
						<img src="images/index-slider/2.jpg" alt="广告2">
						<img src="images/index-slider/3.jpeg" alt="广告3">
				</a>
				<div class="img_index_out">
           			 <div class="img_index">
              			 <span class="selected"></span>
               			 <span></span>
               			 <span></span>
           			 </div>
        		</div>
			</div>
			</div>
		</div>
		<div class="product_list">
			<div class="box_label">
				<a href="#" id="new-pro"class="labels">最新发布</a>
			</div>
			<div class="line"></div>
			<div class="item-list">
				<ul class="items cleafix">
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/1.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">450</div>
							<div class="name"><a href="#">新百伦运动鞋</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/2.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">180</div>
							<div class="name"><a href="#">女士手表</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/3.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">3000</div>
							<div class="name"><a href="#">苹果手机</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/4.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">90</div>
							<div class="name"><a href="#">电热毯</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/1.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">450</div>
							<div class="name"><a href="#">新百伦运动鞋</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/2.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">180</div>
							<div class="name"><a href="#">女士手表</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/3.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">3000</div>
							<div class="name"><a href="#">苹果手机</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/4.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">90</div>
							<div class="name"><a href="#">电热毯</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/1.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">450</div>
							<div class="name"><a href="#">新百伦运动鞋</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/2.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">180</div>
							<div class="name"><a href="#">女士手表</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/3.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">3000</div>
							<div class="name"><a href="#">苹果手机</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/4.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">90</div>
							<div class="name"><a href="#">电热毯</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/1.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">450</div>
							<div class="name"><a href="#">新百伦运动鞋</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/2.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">180</div>
							<div class="name"><a href="#">女士手表</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/3.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">3000</div>
							<div class="name"><a href="#">苹果手机</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/4.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">90</div>
							<div class="name"><a href="#">电热毯</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/1.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">450</div>
							<div class="name"><a href="#">新百伦运动鞋</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/2.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">180</div>
							<div class="name"><a href="#">女士手表</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/3.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">3000</div>
							<div class="name"><a href="#">苹果手机</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item">
						<a href="#" class="product_img" target="_blank">
							<img src="images/product-list/4.jpg" alt="">
						</a>
						<div class="info">
							<div class="price">90</div>
							<div class="name"><a href="#">电热毯</a></div>
							<div class="details">
								<a href="#">详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
					<li class="item fixed"></li>
					<li class="item fixed"></li>
				</ul>
			</div>
			<div class="pager">
					<div class="pagerbar">
						<a class="current" href="javascript:;">1</a>
						<a href="javascript:;">2</a>
						<a href="javascript:;">3</a>
						<a href="javascript:;">4</a>
						<a href="javascript:;">下页</a>
						<a class="last" href="javascript:;" title="末页">末页</a>
					</div>
				</div>
		</div>
	</div>
	<div id="footer">
		<div class="line"></div>
		<div class="other_links">
			<h4>友情链接</h4>
			<ul class="left_link">
				<li><a href="#">链接1</a></li>
				<li><a href="#">链接2</a></li>
				<li><a href="#">链接3</a></li>
				<li><a href="#">链接4</a></li>
			</ul>
			<ul class="right_link">
				<li><a href="#">链接1</a></li>
				<li><a href="#">链接2</a></li>
				<li><a href="#">链接3</a></li>
				<li><a href="#">链接4</a></li>
			</ul>
		</div>
		 <footer><p>Copyright @ 2016 14级计科3班 软件工程</p></footer>
	</div>
</body>
</html>