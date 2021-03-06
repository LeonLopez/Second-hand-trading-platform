<?php 
require_once 'checkUser.php';
checkUser();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>大学生二手交易平台</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/personal_center.css" rel="stylesheet">
    <!-- 以下两个插件用于在IE8以及以下版本浏览器支持HTML5元素和媒体查询，如果不需要用可以移除 -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="row" id="head">
        <div class="col-md-2">
            <p><img class="img-circle" src="images/logo.png"></p>
        </div>
        <div class="col-md-10">
            <h4>大学生二手交易平台</h4>
            <h4><small>College Students' Secondhand Trading Platform</small></h4>
        </div>
    </div >
    <div class="row" id="body">
        <div class="col-md-3">
           <div class="row">
               <img class="img-circle" src="images/headimage.jpg">
           </div>
            <div class="row">
                <h5><strong><?php echo $_SESSION['SNAME'];?></strong></h5>
            </div>
            <div class="row">
                <ul class="list-unstyled">
                    <li><button class="btn btn-default" id="main-btn">首页</button></li>
                    <li><button class="btn btn-default" id="cart-btn" style="background-color: #307ac1;color:#fff">购物车</button></li>
                    <li><button class="btn btn-default" id="psn-btn">个人资料</button></li>
                    <li><button class="btn btn-default" id="pbuy-btn">已购买</button></li>
                    <li><button class="btn btn-default" id="pcol-btn">已收藏</button></li>
                    <li><button class="btn btn-default" id="pb-btn">已发布</button></li>
                    <li><button class="btn btn-default" id="edit-pb-btn">编辑发布</button></li>
                    <li><button class="btn btn-default" id="exit-btn">退出</button></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <iframe
                    width="100%"
                    height="500px"
                    frameborder="0"
                    id = "contentiframe"
                    name = "contentiframe"
                    scrolling="yes"
                    src = "shopping_cart.php">
            </iframe>
        </div>
    </div>
    <div class="row" id="footer">
        <div class="col-md-12">
           <h5><small>copyright@2016 14级计科3班 软件工程</small></h5>
        </div>
    </div>
    <div class="row" id="trail">
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(function(){
        /*设置导航栏按钮背景色和字体颜色*/
        $("#body .col-md-3 button").click(function(){
            $("#body .col-md-3 button").css("background-color","#ffffff");
            $("#body .col-md-3 button").css("color","#307ac1");
            $(this).css("background-color","#307ac1");
            $(this).css("color","#ffffff");
        });
        /*首页按钮事件*/
        $("#main-btn").click(function(){
           location.href = "index.php";
        });
        /*购物车按钮事件*/
        $("#cart-btn").click(function(){
            $("#contentiframe").attr("src","shopping_cart.php");
        });
        /*个人资料按钮事件*/
        $("#psn-btn").click(function(){
            $("#contentiframe").attr("src","personal_inf_edit.php");
        });
        /*已购买按钮事件*/
        $("#pbuy-btn").click(function(){
            $("#contentiframe").attr("src","already_purchase.php");
        });
        /*已收藏按钮事件*/
        $("#pcol-btn").click(function(){
            $("#contentiframe").attr("src","already_collected.php");
        });
        /*已发布按钮事件*/
        $("#pb-btn").click(function(){
            $("#contentiframe").attr("src","published.php");
        });
        /*编辑发布按钮事件*/
        $("#edit-pb-btn").click(function(){
            $("#contentiframe").attr("src","publish_product.php");
        });
        /*退出按钮事件*/
        $("#exit-btn").click(function(){
            $("#contentiframe").attr("src","logout.php");
        });
    })
</script>
</body>
</html>
