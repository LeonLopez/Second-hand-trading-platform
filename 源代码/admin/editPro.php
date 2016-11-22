<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once '../lib/string.func.php';
require_once '../lib/upload.func.php';
require_once 'checkAdmin.php';
checkAdmin();
if($_POST['submit']){
    
    $path="../uploads";
    $uploadFiles=uploadFile($path);
    $prosql = "update product set name='".$_POST['pname']."',categoryid=".$_POST['cid'].",quantity=".$_POST['quantity'].",price=".$_POST['price'].",description='".$_POST['description']."',date=now() where id=".$_POST['id'];
    
    $prores = $db->query($prosql);
    //echo $db->error;
    $proid = $_POST['id'];
    if($prores&&$proid){
        foreach($uploadFiles as $uploadFile){
               echo $uploadFile['name']."<br>";
               $sql = "insert into album(pid,image) values(".$proid.",'".$uploadFile['name']."');";
               $db->query($sql);
        }
        echo "<p>修改成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }
    else{
        echo "<p>修改失败!</p><a href='listPro.php' target='mainFrame'>重新修改</a>";
    }
    
}
else{
    if(isset($_GET['id'])==FALSE){
        header("Location:".$config_basedir."admin/listPro.php");
    }else{
        $prosql = "select product.*,category.id as cid,category.name as cname from product,category  where product.categoryid=category.id and product.id=".$_GET['id'];
        $prores = $db->query($prosql);
        $prorow = $prores->fetch_assoc();
        $catesql = "select * from category;";
        $cateres = $db->query($catesql);
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台后台管理系统</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>修改商品</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">商品名称</td>
		<td><input type="text" name="pname"  value="<?php echo $prorow['name'];?>" /></td>
	</tr>
	<tr>
		<td align="right">商品分类</td>
		<td>
		<select name="cid">
			<?php foreach($cateres as $row):?>
				<option value="<?php echo $row['id'];?>" <?php if($row['id']==$prorow['cid']){echo "selected=selected";} ?>  ><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td align="right">商品数量</td>
		<td><input type="text" name="quantity"  value="<?php echo $prorow['quantity'];?>" /></td>
	</tr>
	
	<tr>
		<td align="right">商品价格</td>
		<td><input type="text" name="price"  value="<?php echo $prorow['price'];?>" /></td>
	</tr>
	<tr>
		<td align="right">商品描述</td>
		<td>
			<textarea name="description" id="editor_id" style="width:100%;height:200px;" ><?php echo $prorow['description'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">商品图像</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
	    <td><input type="hidden" name="id" value="<?= $prorow['id'] ?>" ></td>
		<td ><input type="submit" name="submit" value="修改商品"/></td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
}
?>