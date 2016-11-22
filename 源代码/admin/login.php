<?php 
require '../config/config.php';
require '../config/connect_db.php';
if($_POST['submit']){
    $sql = "select * from admin where username='".$_POST['username']."' and password='".$_POST['password']."';";
    $result = $db->query($sql);
    $numrows = $result->num_rows;
    if($numrows==1){
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION['ADMINNAME'] = $row['username'];
            header("Location:".$config_basedir."admin/index.php");
       
    }
    else{
        header("Location:".$config_basedir."admin/login.php?error=1");
    }
    
}
else{
    

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>管理员登陆</title>
	<link rel="stylesheet" href="styles/landing.css">
	
</head>
<body>
	<div id="header">
        <div class="logo_bgm">
			<img src="images/LOGO.png" alt="网站logo" />
		</div>
            
            <h2 class="head_text fr">二手交易平台后台管理系统</h2>
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