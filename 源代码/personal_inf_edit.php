<?php 
require_once 'checkUser.php';
checkUser();

require 'config/connect_db.php';
if($_POST['submit']){
    $updatesql = "update user set sname='".$_POST['sname']."',birthday='".$_POST['birthday']."',sex='".$_POST['sex']."',phone='".$_POST['phone']."',address='".$_POST['address']."',zodiac='".$_POST['zodiac']."' where id=".$_SESSION['USERID'];
    $updateres = $db->query($updatesql);
    
    if($updateres){
        
        echo "<script>
            window.location='personal_inf_edit.php';
           </script>";
    }
    
}
else{
$userid = $_SESSION['USERID'];
$usersql = "select * from user where id ={$userid}";
$userres = $db->query($usersql);
$userrow = $userres->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人中心</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- 以下两个插件用于在IE8以及以下版本浏览器支持HTML5元素和媒体查询，如果不需要用可以移除 -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        #editBtn{
            margin-bottom: 30px;
            background-color:  #307ac1;
            color: white;
        }
        #submitBtn{
            background-color: #ff730e;
            color:white ;
        }
    </style>
</head>
<body>
<div class = "container">
    <div class = "row">
        <div class = "col-md-12">
            <form role="form" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
                <input type="button" class = "btn btn-default" id = "editBtn" value="编辑"/>
                <fieldset id = "fieldset" disabled="disabled">
                    <div class="form-group" id="nickName">
                        <label class="control-label" for="inputSuccess1">昵称</label>
                        <input type="text" class="form-control" id="inputSuccess1" name="sname" value="<?php echo $userrow['sname'];?>"
                               data-toggle="toggle" title= "昵称3-16位，可以为汉字、数字、字母（大小写）、下划线" >
                    </div>
                    <div class="form-group" id="telephone">
                        <label for="contact-inf">联系方式</label>
                        <input type = "text" id = "contact-inf" class="form-control" name="phone" value="<?php echo $userrow['phone'];?>"
                               data-toggle="toggle" title= "抱歉，只能输入您11位的手机号码">
                    </div>
                    <div class="form-group" id = "myEmail">
                        <label for="email">邮箱</label>
                        <input type = "email" id = "email" name="email" class="form-control" value="<?php echo $userrow['email'];?>"
                               data-toggle="toggle" title= "请输入合法的邮箱地址">
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="sexRadio1" value="男" <?php if($userrow['sex']=="" or $userrow['sex']=='男') echo 'checked'; ?> >
                            男
                        </label>
                        <label>
                            <input type="radio" name="sex" id="sexRadio2" value="女" <?php if($userrow['sex']=='女') echo 'checked'; ?> >
                            女
                        </label>
                    </div>
                    <div class= "form-group">
                        <label class="control-label">出生日期</label>
                        <div class="controls input-append date form_datetime"
                             data-date="2016-09-16" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
                            <input type="text" name="birthday" class="form-control" value="<?php echo $userrow['birthday'];?>" readonly>
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class = "control-label" for="constellation">星座</label>
                        <select class="form-control" id = "constellation" name="zodiac">
                            <?php 
                            $arr=array('白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天枰座','天蝎座','射手座','魔蝎座','水瓶座','双鱼座');
                            foreach ($arr as $value){
                                if($userrow['zodiac']==$value){
                                    echo "<option value='{$value}' selected>{$value}</option>";
                                }else{
                                    echo "<option value='{$value}'>{$value}</option>";
                                }
                                
                            }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group" id="myLocation">
                        <label class = "control-label" for="location">所在地</label>
                        <textarea id = "location" class="form-control" rows="4"
                                  data-toggle="toggle" title= "请输入你的所在地地址" name="address"><?php echo $userrow['address'];?></textarea>
                    </div>
                    <input type="submit" class="btn btn-default" id="submitBtn" name="submit" value="确认修改">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script>
    $(function(){
        $("#editBtn").click(function(){
            $("#fieldset").removeAttr("disabled");
        });

        //检查昵称合法性
        $("#nickName input").blur(function() {
            var nickName = $("#nickName input").val();
            var re = RegExp("^[0-9a-zA-Z\u4e00-\u9fa5_]{3,16}");
            if(nickName == ""){
                $("#nickName").removeClass();
                $("#nickName span").remove();
                $("#nickName").addClass("form-group has-warning has-feedback");
                $("#nickName").append("<span class='help-block'>昵称不能为空</span>");
                $("#nickName").append("<span class='glyphicon glyphicon-warning-sign form-control-feedback'></span>");
            } else if(!re.test(nickName)) {
                $("#nickName").removeClass();
                $("#nickName span").remove();
                $("#nickName").addClass("form-group has-error has-feedback");
                $("#nickName").append("<span class='help-block'>昵称3-16位，可以为汉字、数字、字母（大小写）、下划线</span>");
                $("#nickName").append("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
            }else{
                $("#nickName").removeClass();
                $("#nickName span").remove();
                $("#nickName").addClass("form-group has-success has-feedback");
                $("#nickName").append("<span class='help-block'>正确</span>");
                $("#nickName").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
            }
        });

        //检查联系方式合法性
        $("#telephone input").blur(function() {
            var telephone = $("#telephone input").val();
            var re =  re = /^1\d{10}$/;
            if(telephone == ""){
                $("#telephone").removeClass();
                $("#telephone span").remove();
                $("#telephone").addClass("form-group has-warning has-feedback");
                $("#telephone").append("<span class='help-block'>联系方式不能空</span>");
                $("#telephone").append("<span class='glyphicon glyphicon-warning-sign form-control-feedback'></span>");
            } else if(!re.test(telephone)) {
                $("#telephone").removeClass();
                $("#telephone span").remove();
                $("#telephone").addClass("form-group has-error has-feedback");
                $("#telephone").append("<span class='help-block'>联系方式输入错误</span>");
                $("#telephone").append("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
            }else{
                $("#telephone").removeClass();
                $("#telephone span").remove();
                $("#telephone").addClass("form-group has-success has-feedback");
                $("#telephone").append("<span class='help-block'>正确</span>");
                $("#telephone").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
            }
        });

        //检查邮箱合法性
        $("#myEmail input").blur(function() {
            var myEmail = $("#myEmail input").val();
            var re =  re = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            if(myEmail == ""){
                $("#myEmail").removeClass();
                $("#myEmail span").remove();
                $("#myEmail").addClass("form-group has-warning has-feedback");
                $("#myEmail").append("<span class='help-block'>邮箱不能为空</span>");
                $("#myEmail").append("<span class='glyphicon glyphicon-warning-sign form-control-feedback'></span>");
            } else if(!re.test(myEmail)) {
                $("#myEmail").removeClass();
                $("#myEmail span").remove();
                $("#myEmail").addClass("form-group has-error has-feedback");
                $("#myEmail").append("<span class='help-block'>邮箱输入有误</span>");
                $("#myEmail").append("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
            }else{
                $("#myEmail").removeClass();
                $("#myEmail span").remove();
                $("#myEmail").addClass("form-group has-success has-feedback");
                $("#myEmail").append("<span class='help-block'>正确</span>");
                $("#myEmail").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
            }
        });

        //检验所在地合法性
        $("#myLocation textarea").blur(function() {
            var myLocation = $("#myLocation textarea").val();
            var re = RegExp("^[0-9a-zA-Z\u4e00-\u9fa5_]{10,200}");
            if(myLocation == ""){
                $("#myLocation").removeClass();
                $("#myLocation span").remove();
                $("#myLocation").addClass("form-group has-warning has-feedback");
                $("#myLocation").append("<span class='help-block'>所在地不能为空</span>");
                $("#myLocation").append("<span class='glyphicon glyphicon-warning-sign form-control-feedback'></span>");
            } else if(!re.test(myLocation)) {
                $("#myLocation").removeClass();
                $("#myLocation span").remove();
                $("#myLocation").addClass("form-group has-error has-feedback");
                $("#myLocation").append("<span class='help-block'>所在地输入有误</span>");
                $("#myLocation").append("<span class='glyphicon glyphicon-remove form-control-feedback'></span>");
            }else{
                $("#myLocation").removeClass();
                $("#myLocation span").remove();
                $("#myLocation").addClass("form-group has-success has-feedback");
                $("#myLocation").append("<span class='help-block'>正确</span>");
                $("#myLocation").append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>");
            }
        });

        //设置日期插件格式
        $('.form_datetime').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            startView: 4,
            minView:2,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            keyboardNavigation: 1,
            forceParse: 0,
        });

        //设置提示语句样式
        $("[data-toggle='toggle']").tooltip();
    });
</script>
</body>
</html>
<?php 
}
?>