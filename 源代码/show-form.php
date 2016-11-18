
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
				<span>账号：</span><input style="border: 2px solid #307ac1"  type="text" id="username" class="username" name="username" value='<?= $defaults['username']?>' /><br/>
				<?php if(isset($errors['username'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['username'];
                }?>
				<div class="tips"></div>
			</div>

			<div>
				<span>昵称：</span><input style="border: 2px solid #307ac1"  type="text" id="name" class="name" name="sname" value='<?= $defaults['sname']?>'><br/>
				<?php if(isset($errors['sname'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['sname'];
                }?>
				<div class="tips"></div>
			</div>

			<div>
				<span>密码：</span><input style="border: 2px solid #307ac1"  type="password" id="password" class="password" name="password" value='<?= $defaults['password']?>'><br/>
				<?php if(isset($errors['password'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['password'];
                }?>
				<div class="tips"></div>
			</div>

			<div>
				确认密码：<input style="border: 2px solid #307ac1"  type="password" id="sure_password" class="sure_password" name="sure_password" value='<?= $defaults['sure_password']?>'><br/>
				<?php if(isset($errors['sure_password'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['sure_password'];
                }?>
				<div class="tips"></div>
			</div>

			<div>
				联系方式：<input style="border: 2px solid #307ac1"  type="text" id="phone" class="phone" name="phone" value='<?= $defaults['phone']?>'><br/>
				<?php if(isset($errors['phone'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['phone'];
                }?>
				<div class="tips"></div>
			</div>

			<div>
				<span>邮箱：</span><input style="border: 2px solid #307ac1"  type="text" id="email" class="email" name="email" value='<?= $defaults['email']?>'><br/>
				<?php if(isset($errors['email'])){
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$errors['email'];
                }?>
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
