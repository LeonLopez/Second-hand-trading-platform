<?php 
require_once 'checkUser.php';
checkUser();
require_once 'config/connect_db.php';
$uid = $_SESSION['USERID'];
$sql = "select user.*,product.*,product.id pid from orders,product,user where orders.userid={$uid} and product.id=orders.productid and user.id={$uid};";
$res = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>购物车</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shopping-cart.css" rel="stylesheet">
    <!-- 以下两个插件用于在IE8以及以下版本浏览器支持HTML5元素和媒体查询，如果不需要用可以移除 -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
<div class="container">
   <?php foreach($res as $row):?>
    <div class="row">
        <div class="col-md-12">
            <div class = "goods goods-first">
                <input type = "checkbox" value="<?php echo $row['price']; ?>" />
                <?php 
					         $imgsql = "select * from album where pid=".$row['pid']." limit 1";
					         $images = $db->query($imgsql);
					         if($images){
					             $img = $images->fetch_assoc();
					             echo "<img src='uploads/".$img['image']."' >";
					         }
					         else{
					             echo "<img src='' alt='暂无图片'>";
					         }
					        ?>
               
                <dl class="dl-horizontal">
                    <dt>价格：</dt>
                    <dd><span class="price"><?php echo $row['price']; ?>元</span></dd>
                    <dt>所在地：</dt>
                    <dd><?php echo $row['address']; ?></dd>
                    <dt>联系方式：</dt>
                    <dd><?php echo $row['phone']; ?></dd>
                </dl>
<!--                 <div class="button"> -->
<!--                 	<button class="delete" type="button">删除</button> -->
                	
<!--                 </div> -->
            </div>
        </div>
    </div>
    <?php endforeach;?>

    <div class="row">
        <div class="col-md-12" class="pagination">
            <ul class="pagination">
                <li>
                    <a href="#">上一页</a>
                </li>
                <li>
                    <a href="#">1</a>
                </li>
                <li>
                    <a href="#">2</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
                <li>
                    <a href="#">4</a>
                </li>
                <li>
                    <a href="#">5</a>
                </li>
                <li>
                    <a href="#">下一页</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline" role="form">
                <div class="checkbox">
                    <label>
                          <input type="checkbox" class="checked-all"><strong style="margin-left: 10px;font-size: 16px">全选</strong>
                    </label>
                </div>
                <div class="form-group">
                    <label>总选中<span id="sum" style="color: red">0</span>元</label>
                    <button type="submit" class="btn btn-default">付款</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(function(){
        /*复选款点击事件*/
        /*根据复选框的状态改变其背景颜色*/
        /*选中商品为蓝色，不选为白色*/
        /*更新总选择商品的价钱*/
        $(".goods input:checkbox").click(function(){
            if($(this).is(':checked')){
                $(this).css("background-color","#307ac1");
                var oldSum = parseFloat($("#sum").text());
                var newSum = parseFloat($(this).val()) + oldSum;
                $("#sum").text(newSum);
            }
            else{
                $(this).css("background-color","#fff");
                var oldSum = parseFloat($("#sum").text());
                var newSum = oldSum - parseFloat($(this).val());
                $("#sum").text(newSum);
            }
        });
        /*全选复选框点击事件*/
    })
</script>
</body>
</html>
