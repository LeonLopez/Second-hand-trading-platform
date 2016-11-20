<?php
require_once '../config.php';
require_once '../connect_db.php';

$catesql = "select * from category order by id";
$result = $db->query($catesql);
if (! $result) {
    echo "<script>
            alert('暂无分类，请先输入分类名称');
            window.location='addCate.php';
            </script>";
} else {
    
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
			    <h3>分类列表</h3><br>
				<div class="details_operation clearfix" >
					<div class="bui_select">
						<input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addCate()">
					</div>

				</div>
				
				<!--表格-->
				<table class="table" cellspacing="0" cellpadding="0" align="center">
					<thead>
						<tr>
							<th width="15%">编号</th>
							<th width="30%">分类名称</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
                         <?php
                         while ($row = mysqli_fetch_assoc($result)) {
                         ?>
                            <tr align="center">
							<!--这里的id和for里面的c1 需要循环出来-->

							<td><?php echo $row['id']?></td>
							<td><?php echo $row['name']?></td>
							<td><input type="button" value="修改" class="btn"
								onclick="editCate(<?php echo $row['id'];?>)"><input
								type="button" value="删除" class="btn"
								onclick="delCate(<?php echo $row['id'];?>)"></td>
						</tr>
                               <?php }?>
                        </tbody>
				</table>
			</div>

		</div>


	</div>
	<script type="text/javascript">
     function editCate(id){
         window.location= "editCate.php?id="+id;
    }
     function delCate(id){
  		if(window.confirm("您确定要删除吗？")){
  			window.location="delCate.php?id="+id;
  		}
  	}
  	function addCate(){
  		window.location="addCate.php";
  	}
    </script>
</body>
</html>
<?php }?>