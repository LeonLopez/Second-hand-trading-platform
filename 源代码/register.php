<?php 
require 'config.php';
require 'connect_db.php';
if($_POST['submit']){
    if($_POST['password']==$_POST['sure_password']){
        $checksql = "select * from user where username= '".$_POST['username']."';";
        $checkresult = $db->query($checksql);
        $checknumrows = $checkresult->num_rows;
        if($checknumrows==1){
            header("Location:".$config_basedir."register.php?error=taken");

        }
        else{
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz
               ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
            for($i=0;$i<16;$i++){
                $randomstring.=$pattern{(mt_rand(32,126))};
            }
            $verifyurl = "http://127.0.0.1/Second-hand-trading-platform/verify.php";
            $verifystring = urlencode($randomstring);
            $verifyemail = urlencode($_POST['email']);
            $validusername = $_POST['username'];

            $sql = "insert into user(username,sname,password,phone,email,verifystring,active) values('".$_POST['username']."','".$_POST['sname']."','".$_POST['password']."','".$_POST['phone']."','".$_POST['email']."','".addslashes($randomstring)."',0);";
            $db->query($sql);
$mail_body=<<<_mail_
您好，$validusername，
请点击下面的链接验证你的账号：
$verifyurl?email=$verifyemail&verify=$verifystring
_mail_;
            mail($_POST['email'],"大学生二手交易平台用户验证", $mail_body);
            echo "<h3>验证邮件已经发送到你所指定的邮箱地址，请点击验证邮件里的链接以验证你的账号。</h3><br/>";
            echo "<h3><a href='".$config_basedir."'>返回首页</a></h3>";
        }

    }
    else{
        header("Location:".$config_basedir."register.php?error=pass");
    }

}
else {
    
    switch ($_GET['error']){
        case "pass":
            echo "密码不匹配";
            break;
        case "taken":
            echo "用户名已存在";
            break;
        
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>注册</title>
	<link rel="stylesheet" href="css/register.css">
</head>
<body>
	<div class="header">
		<a href="index.php"><img src="images/LOGO.png" alt=""></a>
		<h2 class="title_1">大学生二手交易平台</h2>
	    <h2 class="title_2">College Students' Secondhand Trading Platform</h2>
		
	    <div class="clear"></div>
	</div>

	<div class="content">
    <div id="form">

		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" accept-charset="utf-8">
			<div>
				<span>账号：</span><input style="border: 2px solid #307ac1"  type="text" id="username" class="username" name="username">
				<div class="tips"></div>
			</div>

			<div>
				<span>昵称：</span><input style="border: 2px solid #307ac1"  type="text" id="name" class="name" name="sname">
				<div class="tips"></div>
			</div>

			<div>
				<span>密码：</span><input style="border: 2px solid #307ac1"  type="password" id="password" class="password" name="password">
				<div class="tips"></div>
			</div>

			<div>
				确认密码：<input style="border: 2px solid #307ac1"  type="password" id="sure_password" class="sure_password" name="sure_password">
				<div class="tips"></div>
			</div>

			<div>
				联系方式：<input style="border: 2px solid #307ac1"  type="text" id="phone" class="phone" name="phone">
				<div class="tips"></div>
			</div>

			<div>
				<span>邮箱：</span><input style="border: 2px solid #307ac1"  type="text" id="email" class="email" name="email">
				<div class="tips"></div>
			</div>

			<div>
				<input type="submit" id="button" name="submit" value="注册">
			</div>


		</form>

	</div>

    </div>

	<div class="foot">
		<div class="grey">
			<span class="copyright">Copyright@2016 14级计科3班 软件工程<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;——GH GMZ CZL LHQ FDX——</span>
		</div>

		<div class="blue">
			
		</div>
	</div>
</body>
</html>
<?php 
}
?>