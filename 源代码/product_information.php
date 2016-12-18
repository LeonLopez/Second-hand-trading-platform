<?php 
require 'config/config.php';
if(isset($_GET['id'])){
    if(is_numeric($_GET['id'])==FALSE){

        header("Location:".$config_basedir);
    }
    else{
        $validproduct=$_GET['id'];
    }
}
else{
    header("Location:".$config_basedir);
}
require_once 'config/connect_db.php';
$prosql = "select product.id pid,product.*,user.* from product,user where user.id=product.userid and product.id={$validproduct};";
$prores = $db->query($prosql);
$prorow = $prores->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/index_style_header.css" />
    <link rel="stylesheet" type="text/css" href="css/index_style_footer.css" />
     <link rel="stylesheet" type="text/css" href="css/product_information.css" />
    <title>商品详情</title>
    
    </script>

</head>
<body>
    <!--页头开始-->
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
                <li><a href="personal_center.php" class="personal">个人中心</a></li>
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
            <li><a href="index.php" class="index active">首页</a></li>
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
    <!--页头结束-->
    <div id="content">
        <div class="saler_information">
            <?php 
					         $imgsql = "select * from album where pid=".$prorow['pid']." limit 1";
					         $images = $db->query($imgsql);
					         if($images){
					             $img = $images->fetch_assoc();
					             echo "<img src='uploads/".$img['image']."' alt='商品图1' class='img-responsive' width='304' height='236' >";
					         }
					         else{
					             echo "<img src='' alt='暂无图片'>";
					         }
					        ?>
            
            <form action="#" class="form-group">
                <div class="show_saler">
                    <p><span class="glyphicon glyphicon-search"></span> 名称：<span class="product_name"><?php echo $prorow['name']; ?></span></p>
                    <p><span class="glyphicon glyphicon-pushpin"></span> 价格：<span class="product_price"><?php echo $prorow['price']; ?></span></p>
                    <p><span class="glyphicon glyphicon-user"></span> 上传者：<span class="saler_name"><a href="#"><?php echo $prorow['sname']; ?><span class="glyphicon glyphicon-new-window"></span></a></span></p>
                    <p><span class="glyphicon glyphicon-map-marker"></span> 所在地：<span class="product_location"><?php echo $prorow['address']; ?></span></p>
                    <p><span class="glyphicon glyphicon-phone-alt"></span> 联系方式：<span class="product_phone">
                    <?php 
                    if(isset($_SESSION['USERNAME'])){
                       echo $prorow['phone'];
                    }
                    else{
                       echo "<a href='login.php'>登录后查看联系方式</a>"; 
                    }
                    
                    ?>
                    
                    </span></p>
                </div>
                <div class="choose-btn">
                    <button type="button" class="btn btn-success">立即购买</button>
                    <button type="button" class="btn btn-primary" onclick="addToCart(<?php echo $prorow['pid']; ?>)"><span class="     glyphicon glyphicon-shopping-cart"></span> 加入购物车</button>
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-star"></span> 关注</button>
                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-bullhorn"></span> 评价</button>
                </div>
            </form>
        </div>
        
        <div class="box_label">
                <h3>商品详情</h3>
        </div>
        <div class="product_main">
          <div class="main_row_one">
             <p class="saler_upload_main_one"><?php echo $prorow['description']; ?></p>   
        </div>
        <div class="box_label">
                <h3>图片展示</h3>
        </div>
        <div class="main_row_two">
           <ul class="show_pic_list">
           <?php 
					         $imgsql = "select * from album where pid=".$prorow['pid']." ";
					         $images = $db->query($imgsql);
					         if($images){
					             while($img = $images->fetch_assoc()){
					             echo "<li><a href='uploads/".$img['image']."' class='show_big' ><img src='uploads/".$img['image']."' alt='商品图' class='img-responsive mainimg_one' width='304' height='236'></a></li>";
					             }
					         }
					        ?>
               
               
               <li></li>
               <li></li>
               <li></li>
           </ul>
        </div>
            
          
        </div>
    </div>
    <!--页脚-->
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
    <!--页脚结束-->
    <script>
    function addToCart(id){
    	window.location='addToCart.php?id='+id;
        }
    </script>
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/show_big_pic.js"></script>
</body>
</html>