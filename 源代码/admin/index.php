
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台后台管理系统</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div id="header">
        <div class="logo_bgm">
			<img src="images/LOGO.png" alt="网站logo" />
		</div>
            
            <h2 class="head_text fr">二手交易平台后台管理系统</h2>
    </div>
    
    <div class="operation_user clearfix">
        <div class="link fr">
            <b>欢迎您
            <?php 
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>
            
            </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php" class="icon icon_i">首页</a><span></span><a href="#" class="icon icon_j">前进</a><span></span><a href="#" class="icon icon_t">后退</a><span></span><a href="#" class="icon icon_n">刷新</a><span></span><a href="../logout.php" class="icon icon_e">退出</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--右侧内容-->
            <div class="cont">
                <div class="title">后台管理</div>
      	 		<!-- 嵌套网页开始 -->         
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="522"></iframe>
                <!-- 嵌套网页结束 -->   
            </div>
        </div>
        <!--左侧列表-->
        <div class="menu">
            <div class="cont">
                <div class="title">管理员</div>
                <ul class="mList">
                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>商品管理</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addPro.php" target="mainFrame">添加商品</a></dd>
                            <dd><a href="listPro.php" target="mainFrame">商品列表</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>分类管理</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">添加分类</a></dd>
                            <dd><a href="listCate.php" target="mainFrame">分类列表</a></dd>
                        </dl>
                    </li>
                    
                    <li>
                        <h3><span onclick="show('menu3','change3')" id="change3">+</span>用户管理</h3>
                        <dl id="menu3" style="display:none;">
<!--                         	<dd><a href="addUser.php" target="mainFrame">添加用户</a></dd> -->
                            <dd><a href="listUser.php" target="mainFrame">用户列表</a></dd>
                        </dl>
                    </li>
                    
                    <li>
                        <h3><span onclick="show('menu4','change4')" id="change4">+</span>公告管理</h3>
                        <dl id="menu4" style="display:none;">
                        	<dd><a href="#" target="mainFrame">添加公告</a></dd>
                            <dd><a href="#" target="mainFrame">公告列表</a></dd>
                        </dl>
                    </li>
                    
                        
                </ul>
            </div>
        </div>

    </div>
    <div id="footer">
		<div class="line"></div>
		
		 <footer><p>Copyright @ 2016 14级计科3班 软件工程</p></footer>
	</div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }
    </script>
</body>
</html>