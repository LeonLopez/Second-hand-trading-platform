<?php
require_once 'checkUser.php';
checkUser();
if(isset($_GET['id'])){
    if(is_numeric($_GET['id'])==FALSE){

        header("Location:".$config_basedir);
    }
    else{
        $validproduct=$_GET['id'];
    }
}
else{
    header("Location:".$config_basedir);
}
$userid = $_SESSION['USERID'];
require_once 'config/connect_db.php';
$sql = "insert into orders(productid,userid,quantity,date) values({$validproduct},{$userid},1,now());";
$res = $db->query($sql);
if($res){
    header("Location:".$config_basedir."personal_center.php");
}