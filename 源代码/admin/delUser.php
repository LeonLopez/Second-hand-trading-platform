<?php 
require_once '../config.php';
require_once '../connect_db.php';
if(isset($_GET['id'])==TRUE){
    $usersql = "delete from user where id=".$_GET['id'];
    $userres = $db->query($usersql);
}
header("Location:".$config_basedir."admin/listUser.php");
?>