<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
if(isset($_GET['id'])==TRUE){
    $catesql = "delete from category where id=".$_GET['id'];
    $cateres = $db->query($catesql); 
}
header("Location:".$config_basedir."admin/listCate.php");