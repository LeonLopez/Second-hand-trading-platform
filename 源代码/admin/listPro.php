<?php 
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
checkAdmin();
$order=$_GET['order']?$_GET['order']:null;
$orderBy=$order?"order by ".$order:null;
$keywords=$_GET['keywords']?$_GET['keywords']:null;
$where=$keywords?"where product.name like '%{$keywords}%'":null;
$prosql = "select product.*,category.name as cname from product join category on product.categoryid=category.id {$where} {$orderBy};";
$prores = $db->query($prosql);

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
                            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>商品价格：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-请选择-</option>
                                        <option value="price asc" >由低到高</option>
                                        <option value="price desc">由高到底</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>上架时间：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="date desc" >最新发布</option>
                                        <option value="date asc">历史发布</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>搜索</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="20%">商品名称</th>
                                <th width="10%">商品分类</th>
                                <th width="10%">商品数量</th>
                                <th width="15%">发布时间</th>
                                <th width="10%">商品价格</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($prores as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['cname'];?></td>
                                <td>
                                	<?php echo $row['quantity'];?>
                                </td>
                                 <td><?php echo date("Y-m-d H:i:s",strtotime($row['date']));?></td>
                                  <td><?php echo $row['price'];?>元</td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['name'];?>')"><input type="button" value="修改" class="btn" onclick="editPro(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">商品名称</td>
					                        			<td><?php echo $row['name'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品类别</td>
					                        			<td><?php echo $row['cname'];?></td>
					                        		</tr>
					                        		
					                        		<tr>
					                        			<td width="20%"  align="right">商品数量</td>
					                        			<td><?php echo $row['quantity'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">商品价格</td>
					                        			<td><?php echo $row['price'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">发布时间</td>
					                        			<td><?php echo $row['date'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品图片</td>
					                        			<td>
					                        			<?php 
					                        			$imgsql = "select * from album where pid=".$row['id'];
					                        			$images = $db->query($imgsql);
					                        			foreach($images as $img):
					                        			?>
					                        			<img width="100" height="100" src="../uploads/<?php echo $img['image'];?>" alt=""/> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					                        			
					                        			</td>
					                        		</tr>
					                        		
					                        	</table>
					                        	<span style="display:block;width:80%; ">
					                        	商品描述<br/>
					                        	<?php echo $row['description'];?>
					                        	</span>
					                        </div>
                                
                                </td>
                            </tr>
                           <?php  endforeach;?>
                           
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
	      title:"商品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("您确认要删除吗？")){
			window.location="delPro.php?id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>