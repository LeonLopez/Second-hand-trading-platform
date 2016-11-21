<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once '../lib/string.func.php';
require_once '../lib/upload.func.php';

if($_POST['submit']){
    
    $path="../uploads";
    $uploadFiles=uploadFile($path);
    //print_r($uploadFiles);
    $prosql = "insert into product(name,categoryid,quantity,price,description,date) values('".$_POST['pname']."',".$_POST['cid'].",".$_POST['quantity'].",".$_POST['price'].",'".$_POST['description']."',now());";
    $prores = $db->query($prosql);
    $proid = $db->insert_id;
    if($prores&&$proid){
        foreach($uploadFiles as $uploadFile){
               echo $uploadFile['name']."<br>";
               $sql = "insert into album(pid,image) values(".$proid.",'".$uploadFile['name']."');";
               $db->query($sql);
        }
        echo "<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }
    else{
        echo "<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
    }
    
}
else{
$catesql = "select * from category;";
$cateres = $db->query($catesql);
if(!$cateres){
    echo "<script>
            alert('暂无分类，请先输入分类名称');
            window.location='addCate.php';
           </script>";
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
<h3>添加商品</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">商品名称</td>
		<td><input type="text" name="pname"  placeholder="请输入商品名称"/></td>
	</tr>
	<tr>
		<td align="right">商品分类</td>
		<td>
		<select name="cid">
			<?php foreach($cateres as $row):?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td align="right">商品数量</td>
		<td><input type="text" name="quantity"  placeholder="请输入商品数量"/></td>
	</tr>
	
	<tr>
		<td align="right">商品价格</td>
		<td><input type="text" name="price"  placeholder="请输入商品价格"/></td>
	</tr>
	<tr>
		<td align="right">商品描述</td>
		<td>
			<textarea name="description" id="editor_id" style="width:100%;height:200px;"></textarea>
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
	    <td></td>
		<td ><input type="submit" name="submit" value="添加商品"/></td>
	</tr>
</table>
</form>
</body>
</html>
<?php 
}
?>