<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';

if($_POST['submit']){
    if($_POST['cname']!=""&&strlen($_POST['cname'])>0){
        $sql = "insert into category(name) values('".$_POST['cname']."');";
        $res = $db->query($sql);
        if($res){
            echo "添加成功！&nbsp;&nbsp;<a href='addcate.php'>继续添加</a>&nbsp;&nbsp;<a href='listcate.php'>查看分类列表</a>";
        }
        else{
            echo "添加失败！&nbsp;&nbsp;<a href='listcate.php'>重新添加</a>";
        }
    }
    else{
        echo "<script>
            alert('请先输入分类名称再添加');
            window.location='addCate.php';
            
            </script>";
        
    }
}
else{
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>二手交易平台后台管理系统</title>
</head>
<body>
<h3>添加分类</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
<table width="50%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="cname" placeholder="请输入分类名称"/></td>
	</tr>
	<tr>
	    <td></td>
		<td colspan="2"><input type="submit" name="submit" value="添加分类" /></td>
	</tr>

</table>
</form>
</body>
</html>
<?php 
}
?>