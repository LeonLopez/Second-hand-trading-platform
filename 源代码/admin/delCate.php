<?php
require_once '../config.php';
require_once '../connect_db.php';
if(isset($_GET['id'])==TRUE){
    $catesql = "delete from category where id=".$_GET['id'];
    $cateres = $db->query($catesql); 
}
header("Location:".$config_basedir."admin/listCate.php");