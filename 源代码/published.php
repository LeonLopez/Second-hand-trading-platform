
<?php 
require_once 'checkUser.php';
checkUser();
require_once 'config/connect_db.php';
$uid = $_SESSION['USERID'];
$sql = "select user.*,product.*,product.id pid from published,product,user where published.userid={$uid} and product.id=published.productid and user.id={$uid};";
$res = $db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/shopping-cart.css">
	<link rel="stylesheet" type="text/css" href="css/already_purchase.css">

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

                <div class="button">
                	<button class="delete" type="button" onclick="delPro(<?php echo "";?>)">删除</button>
                	<!-- 下面的按钮是编辑发布的链接 -->
                    <a href="publish_product.php"><button type="button">编辑</button></a>	
                    <button  type="button">下架</button>
                </div>

            </div>
        </div>
    </div>
    <?php endforeach;?>
<!--     <div class="row"> -->
<!--         <div class="col-md-12" class="pagination"> -->
<!--             <ul class="pagination"> -->
<!--                 <li> -->
<!--                     <a href="#">上一页</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">1</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">2</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">3</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">4</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">5</a> -->
<!--                 </li> -->
<!--                 <li> -->
<!--                     <a href="#">下一页</a> -->
<!--                 </li> -->
<!--             </ul> -->
<!--         </div> -->
<!--     </div> -->

</div>
<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

	$("button[class='delete']").bind('click',function(){
	   $(this).parent("div").parent('div').parent("div").parent('div').next('div').children('div').children('div').addClass('border');
       $(this).parent("div").parent('div').remove();
	})

</script>
</body>
</html>