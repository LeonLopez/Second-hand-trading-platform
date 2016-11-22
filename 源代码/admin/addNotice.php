<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
checkAdmin();
if ($_POST['submit']) {
    $poster = $_SESSION['ADMINNAME'];
    
    $noticesql = "insert into notice(title,content,posttime,poster) values('" . $_POST['title'] . "','" . $_POST['content'] . "',now(),'" . $poster . "');";
    $noticeres = $db->query($noticesql);
    if ($noticeres) {
        
        echo "添加成功！&nbsp;&nbsp;<a href='addNotice.php'>继续添加</a>&nbsp;&nbsp;<a href='listNotice.php'>查看公告列表</a>";
    } else {
        echo "添加失败！&nbsp;&nbsp;<a href='addNotice.php'>重新添加</a>";
    }
}else{

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
	<h3>添加公告</h3>
	<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<table width="70%" border="1" cellpadding="5" cellspacing="0"
			bgcolor="#cccccc">
			<tr>
				<td align="right">公告标题</td>
				<td><input type="text" name="title" placeholder="请输入公告标题" /></td>
			</tr>


			<tr>
				<td align="right">公告内容</td>
				<td><textarea name="content" id="editor_id"
						style="width: 100%; height: 200px;"></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="添加公告" /></td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php 
}
?>