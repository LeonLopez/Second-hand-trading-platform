<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
checkAdmin();

if($_POST['submit']){
   $updateusersql = "update user set username='{$_POST['username']}',password='{$_POST['password']}',sname='{$_POST['sname']}',phone='{$_POST['phone']}',email='{$_POST['email']}',address='{$_POST['address']}' where id={$_POST['id']};";
   
   $updateuserres = $db->query($updateusersql);
   if($updateuserres){
      echo "修改成功！&nbsp;&nbsp;<a href='listUser.php'>查看用户列表</a>";
   }else{
      echo "修改失败！&nbsp;&nbsp;<a href='listUser.php'>重新修改</a>";
   }
}
else{
    if(isset($_GET['id'])==FALSE){
        header("Location:".$config_basedir."admin/listUser.php");
    }else{
        $usersql = "select * from user where id=".$_GET['id'];
        $userres = $db->query($usersql);
        $userrow = $userres->fetch_assoc();
        
    } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>二手交易平台后台管理系统</title>
</head>
<body>
<h3>修改用户</h3>
<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
<table width="50%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">用户名</td>
		<td><input type="text" name="username" value="<?= $userrow['username']?>" /></td>
	</tr>
	<tr>
		<td align="right">密码</td>
		<td><input type="password" name="password" value="<?= $userrow['password']?>" /></td>
	</tr>
	<tr>
		<td align="right">昵称</td>
		<td><input type="text" name="sname" value="<?= $userrow['sname']?>" /></td>
	</tr>
	<tr>
		<td align="right">联系方式</td>
		<td><input type="text" name="phone" value="<?= $userrow['phone']?>" /></td>
	</tr>
	<tr>
		<td align="right">电子邮箱</td>
		<td><input type="text" name="email" value="<?= $userrow['email']?>" /></td>
	</tr>
	<tr>
		<td align="right">地址</td>
		<td><input type="text" name="address" value="<?= $userrow['address']?>" /></td>
	</tr>
	<tr>
	    <td><input type="hidden" name="id" value="<?= $userrow['id'] ?>" ></td>
		<td><input type="submit" name="submit" value="确定修改" /></td>
	</tr>
    
</table>
</form>
</body>
</html>
<?php 
}
?>