<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';


if($_POST['submit']){
   $updatecatesql = "update category set name='".$_POST['cname']."' where id=".$_POST['cid'];
   $updatecateres = $db->query($updatecatesql);
   if($updatecateres){
      echo "修改成功！&nbsp;&nbsp;<a href='listCate.php'>查看分类列表</a>";
   }else{
      echo "修改失败！&nbsp;&nbsp;<a href='listCate.php'>重新修改</a>";
   }
}
else{
    if(isset($_GET['id'])==FALSE){
        header("Location:".$config_basedir."admin/listCate.php");
    }else{
        $catesql = "select * from category where id=".$_GET['id'];
        $cateres = $db->query($catesql);
        $caterow = $cateres->fetch_assoc();
       
    } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>二手交易平台后台管理系统</title>
</head>
<body>
<h3>修改分类</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
<table width="50%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="cname" value="<?= $caterow['name']?>"/></td>
	</tr>
	<tr>
	    <td><input type="hidden" name="cid" value="<?= $caterow['id'] ?>" ></td>
		<td><input type="submit" name="submit" value="确定修改" /></td>
	</tr>
    
</table>
</form>
</body>
</html>
<?php 
}
?>