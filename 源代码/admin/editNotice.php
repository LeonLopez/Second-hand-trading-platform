<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
checkAdmin();
if ($_POST['submit']) {
    $poster = $_SESSION['ADMINNAME'];
    $noticesql = "update notice set title='".$_POST['title']."',content='".$_POST['content']."',posttime=now(),poster='".$poster."' where id =".$_POST['id'];
    $noticeres = $db->query($noticesql);
    echo $db->error;
    if ($noticeres) {
        echo "修改成功！&nbsp;&nbsp;<a href='listNotice.php'>查看公告列表</a>";
    }else {
        echo "修改失败！&nbsp;&nbsp;<a href='listNotice.php'>重新修改</a>";
    }
}else{
     if(isset($_GET['id'])){
         $sql = "select * from notice where id=".$_GET['id'];
         $res = $db->query($sql);
         $row = $res->fetch_assoc();
     }else{
         header("Location:".$config_basedir."admin/listNotice.php");
     }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台后台管理系统</title>
<link href="./styles/global.css" rel="stylesheet" type="text/css"
	media="all" />
<script type="text/javascript" charset="utf-8"
	src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8"
	src="../plugins/kindeditor/lang/zh_CN.js"></script>

<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        
</script>
</head>
<body>
	<h3>修改公告</h3>
	<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<table width="70%" border="1" cellpadding="5" cellspacing="0"
			bgcolor="#cccccc">
			<tr>
				<td align="right">公告标题</td>
				<td><input type="text" name="title" value="<?php echo $row['title']; ?>" /></td>
			</tr>


			<tr>
				<td align="right">公告内容</td>
				<td><textarea name="content" id="editor_id"
						style="width: 100%; height: 200px;"><?php echo $row['content']?></textarea></td>
			</tr>

			<tr>
				<td><input type="hidden" name="id" value="<?= $row['id'] ?>" ></td>
				<td><input type="submit" name="submit" value="修改公告" /></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php 
}
?>