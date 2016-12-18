<?php 
require_once 'config/config.php';
require_once 'config/connect_db.php';
require_once 'lib/string.func.php';
require_once 'lib/upload.func.php';
require_once 'checkUser.php';
checkUser();
if($_POST['submit']){
    
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    $userid = $_SESSION['USERID'];
    //print_r($uploadFiles);
    $prosql = "insert into product(name,categoryid,quantity,price,description,userid,date) values('".$_POST['pname']."',".$_POST['cid'].",".$_POST['quantity'].",".$_POST['price'].",'".$_POST['description']."',".$userid.",now());";
    $prores = $db->query($prosql);
    $proid = $db->insert_id;
    if($prores&&$proid){
        foreach($uploadFiles as $uploadFile){
               //echo $uploadFile['name']."<br>";
               $sql = "insert into album(pid,image) values(".$proid.",'".$uploadFile['name']."');";
               $db->query($sql);
        }
        $sql = "insert into published(userid,productid,date) values({$userid},{$proid},now());";
        $db->query($sql);
        echo "<p>发布成功!</p>";
    }
    else{
        echo "<p>发布失败!</p><a href='publish_product.php' target='contentiframe'>重新发布</a>";
    }
    
}
else{
$catesql = "select * from category;";
$cateres = $db->query($catesql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台</title>
<link href="./admin/styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./js/jquery-1.6.4.js"></script>
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
<h3>发布闲置</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" enctype="multipart/form-data">
<table width="90%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td >商品名称</td>
		<td><input type="text" name="pname"  placeholder="请输入商品名称"/></td>
	</tr>
	<tr>
		<td >商品分类</td>
		<td>
		<select name="cid">
			<?php foreach($cateres as $row):?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td >商品数量</td>
		<td><input type="text" name="quantity"  placeholder="请输入商品数量"/></td>
	</tr>
	
	<tr>
		<td >商品价格</td>
		<td><input type="text" name="price"  placeholder="请输入商品价格"/></td>
	</tr>
	<tr>
		<td >商品描述</td>
		<td>
			<textarea name="description" id="editor_id" style="width:100%;height:200px;"></textarea>
		</td>
	</tr>
	<tr>
		<td >商品图像</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加图片</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
	    <td></td>
		<td ><input type="submit" name="submit" value="发布闲置"/></td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
}
?>