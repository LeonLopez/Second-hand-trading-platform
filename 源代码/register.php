<?php
require 'config.php';
require 'connect_db.php';
$defaults = array('username'=>'','sname'=>'','password'=>'','sure_password'=>'','phone'=>'','email'=>'');
if($_SERVER['REQUEST_METHOD']=='GET'){
    $errors = array();
    include 'show-form.php';
}else{
    $errors = validate_form($db);
    if(count($errors)){
        foreach ($_POST as $key=>$value){
            $defaults[$key] = $_POST[$key];
        }
         include 'show-form.php';
    }else{
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
function validate_form($db){
    $error = array();
    
    if(!(isset($_POST['username'])&&(strlen($_POST['username'])>6))){
        $error['username'] = "用户名长度必须大于6位";
    }else{
        $checksql = "select * from user where username= '".$_POST['username']."';";
        $checkresult = $db->query($checksql);
        $checknumrows = $checkresult->num_rows;
        if($checknumrows==1){
            $error['username'] = "用户名已存在";
        }
    }
    if($_POST['sname']==""||(strlen($_POST['sname'])==0)){
        $error['sname'] = "昵称不能为空";
    }
    
    if($_POST['password']==""||(strlen($_POST['password'])==0)){
        $error['password'] = "密码不能为空";
        
    }else{
        if(preg_match("/[^0-9a-zA-Z]/", $_POST['password'])||(strlen($_POST['password'])<6)){
            $error['password'] = "只能包含字母和数字且长度不能小于6位";
        }else{
            if($_POST['password']!=$_POST['sure_password']){
                $error['sure_password']= "输入的密码不匹配";
            }
        }
    }
    if($_POST['phone']==""||(strlen($_POST['phone'])==0)){
        $error['phone'] = "联系方式不能为空";
    }
    
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    if($email === false){
        $error['email']="无效邮箱地址";
    }
    return $error;
}