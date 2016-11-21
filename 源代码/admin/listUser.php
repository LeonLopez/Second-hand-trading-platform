<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';

$usersql = "select * from user order by id";
$userres = $db->query($usersql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>大学生二手交易平台后台</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

	<div class="content clearfix">
		<div class="main">
			<!--右侧内容-->


			<div class="details">
				<h3>用户列表</h3>
				<br>

				<!--表格-->
				<table class="table" cellspacing="0" cellpadding="0" align="center">
					<thead>
						<tr>
							<th width="15%">编号</th>
							<th width="15%">用户名</th>
							<th width="15%">邮箱地址</th>
							<th width="15%">是否激活</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
                         <?php
                        while ($row = mysqli_fetch_assoc($userres)) {
                            ?>
                            <tr align="center">
							<!--这里的id和for里面的c1 需要循环出来-->

							<td><?php echo $row['id']?></td>
							<td><?php echo $row['username']?></td>
							<td><?php echo $row['email']?></td>
							<td><?php echo $row['active']==1?激活:未激活; ?></td>
							<td><input type="button" value="修改" class="btn"
								onclick="editUser(<?php echo $row['id'];?>)"><input
								type="button" value="删除" class="btn"
								onclick="delUser(<?php echo $row['id'];?>)"></td>
						</tr>
                               <?php }?>
                        </tbody>
				</table>
			</div>

		</div>


	</div>
	<script type="text/javascript">
     function editUser(id){
         window.location= "editUser.php?id="+id;
    }
     function delUser(id){
  		if(window.confirm("您确定要删除吗？")){
  			window.location="delUser.php?id="+id;
  		}
  	}
  	
    </script>
</body>
</html>
