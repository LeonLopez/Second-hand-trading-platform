<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
if(isset($_GET['id'])==TRUE){
    $prosql = "delete from product where id=".$_GET['id'];
    $prores = $db->query($prosql);
}
header("Location:".$config_basedir."admin/listPro.php");