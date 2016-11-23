<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
require_once '../lib/page.func.php';
checkAdmin();
$sql = "select * from notice order by id";
$res = $db->query($sql);
$totalRows = $res->num_rows;
$pageSize = 6;
$totalPage = ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;

$noticesql = "select * from notice order by id limit {$offset},{$pageSize}";
$result = $db->query($noticesql);
if (!$result) {
    echo "<script>
            alert('暂无公告，请先添加公告');
            window.location='addNotice.php';
            </script>";
}
else {

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台后台管理系统</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                     <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addNotice()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                
                                <th width="10%">编号</th>
                                <th width="20%">公告标题</th>
                                <th width="15%">发布时间</th>
                                <th width="10%">发布者</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td align="center"><?php echo $row['id']?></td>
                                <td align="center"><?php echo $row['title']; ?></td>
                                
                                 <td><?php echo date("Y-m-d H:i:s",strtotime($row['posttime']));?></td>
                                  <td align="center"><?php echo $row['poster'];?></td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['title'];?>')"><input type="button" value="修改" class="btn" onclick="editNotice(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"onclick="delNotice(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">公告标题</td>
					                        			<td><?php echo $row['title'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">发布者</td>
					                        			<td><?php echo $row['poster'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">发布时间</td>
					                        			<td><?php echo date("Y-m-d H:i:s",strtotime($row['posttime']));?></td>
					                        		</tr>
					                        		
					                        		
					                        	</table>
					                        	<span style="display:block;width:80%; ">
					                        	公告内容<br/>
					                        	<?php echo $row['content'];?>
					                        	</span>
					                        </div>
                                
                                </td>
                            </tr>
                           <?php  endforeach;?>
                           <?php if($totalRows>$pageSize):?>
                            <tr >
                            	<td colspan="5"><?php echo showPage($page, $totalPage);?></td>
                            </tr>
                          <?php endif;?>  
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"公告标题："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addNotice(){
		window.location='addNotice.php';
	}
	function editNotice(id){
		window.location='editNotice.php?id='+id;
	}
	function delNotice(id){
		if(window.confirm("您确认要删除吗？")){
			window.location="delNotice.php?id="+id;
		}
	}
	
</script>
</body>
</html>
<?php 
}
?>