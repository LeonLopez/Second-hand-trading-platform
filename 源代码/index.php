<?php 
require 'config/config.php';
require 'config/connect_db.php';
require_once 'lib/index.page.func.php';

$keywords=$_GET['keywords']?$_GET['keywords']:null;
$where=$keywords?"where product.name like '%{$keywords}%'":null;
$sql = "select * from product {$where} order by date desc ";
$res = $db->query($sql);
$totalRows = $res->num_rows;
$pageSize = 16;
$totalPage = ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;

$prosql = "select * from product {$where} order by date desc  limit {$offset},{$pageSize}";
$prores = $db->query($prosql);

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
		<h3 class="logo_headline"><a href="index.php">大学生二手交易平台</a></h2>
		<ul id="top_nav">
			<li><a href="index.php" class="index active">首页</a></li>
			<li><a href="#" class="classify">分类</a></li>
			<li><a href="#" class="publish">发布闲置</a></li>
		</ul>
		<div class="search">
			
				<input type="text" id="search_goods" placeholder="搜你所想" onkeypress="search()" value="<?php echo $keywords?>"/>
				<input type="button" id="search_btn" value="搜索" onclick="search()">
			
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
				<?php foreach ($prores as $row):?>
					<li class="item">
						<a href="productDetail.php?id=<?php echo $row['id'];?>" class="product_img" target="_blank">
							<?php 
					         $imgsql = "select * from album where pid=".$row['id']." limit 1";
					         $images = $db->query($imgsql);
					         if($images){
					             $img = $images->fetch_assoc();
					             echo "<img src='uploads/".$img['image']."' alt=''>";
					         }
					         else{
					             echo "<img src='' alt='暂无图片'>";
					         }
					        ?>
							
						</a>
						<div class="info">
							<div class="price"><?php echo $row['price']; ?></div>
							<div class="name"><a href="productDetail.php?id=<?php echo $row['id'];?>" ><?php echo $row['name']; ?></a></div>
							<div class="details">
								<a href="productDetail.php?id=<?php echo $row['id'];?>" >详情</a>
							</div>
							<div class="like">
								<a href="#">收藏</a>
							</div>
						</div>
					</li>
				<?php endforeach;?>	
					<li class="item fixed"></li>
					<li class="item fixed"></li>
					<li class="item fixed"></li>
				</ul>
			</div>
			 
			<div class="pager">
					<div class="pagerbar">
						<?php if($totalRows>$pageSize):
			                  echo showPage($page, $totalPage,"keywords={$keywords}");
                              endif;
                        ?> 
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
	<script type="text/javascript">
	function search(){
		if(event.keyCode==13 || document.getElementById("search_btn").value=="搜索"){
			var val=document.getElementById("search_goods").value;
			window.location="index.php?keywords="+val;
		}
	}
	</script>
</body>
</html>