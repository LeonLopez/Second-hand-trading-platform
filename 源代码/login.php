<?php 
require 'config/config.php';
require 'config/connect_db.php';
if($_POST['submit']){
    $sql = "select * from user where username='".$_POST['username']."' and password='".$_POST['password']."';";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    if($numrows==1){
        $row = mysqli_fetch_assoc($result);
        if($row['active']==1){
            $_SESSION['USERNAME'] = $row['username'];
            $_SESSION['SNAME'] = $row['sname'];
            $_SESSION['USERID'] = $row['id'];
            header("Location:".$config_basedir);
        }
        else{
            echo "<h3>此账号还没完成验证，请您登陆您的注册邮箱，点击本平台的验证链接完成验证。<br/><a href='login.php'>返回登陆</a></h3>";
            
        }
    }
    else{
        header("Location:".$config_basedir."login.php?error=1");
    }
    
}
else{
    

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>登陆</title>
	<link rel="stylesheet" href="css/landing.css">
</head>
<body>
	<div class="header">
		<a href="index.php"><img src="images/LOGO.png" alt=""></a>
	    <div class="clear"></div>
	</div>

	<div class="content">

	<div class="left"></div>

	<div id="form">

		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" accept-charset="utf-8">
				账号：<input style="border: 2px solid #307ac1"  type="text" id="username" class="username" name="username">
				<div class="tips"></div>

				密码：<input style="border: 2px solid #307ac1"  type="password" id="password" class="password" name="password"><br/>
				<?php if($_GET['error']){
        echo "&nbsp;&nbsp;&nbsp;账号或密码不正确，请重新输入";
                }?>
				<div class="tips"></div>

				<div class="register">
					没有账号？<a href="register.php">点我注册</a>
				</div>


					<input type="submit" id="button" name="submit" value="登陆">
		</form>

	</div>

	<div class="right"></div>

    </div>
	<div class="foot">
		<div class="grey">
			<span>Copyright@2016 14级计科3班 软件工程<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;——GH GMZ CZL LHQ FDX——</span>
		</div>

		<div class="blue">
			
		</div>
	</div>
</body>
</html>
<?php 
}
?>