<?php
require_once '../config/config.php';
require_once '../config/connect_db.php';
require_once 'checkAdmin.php';
checkAdmin();
if(isset($_GET['id'])==TRUE){
    $noticesql = "delete from notice where id=".$_GET['id'];
    $noticeres = $db->query($noticesql);
}
header("Location:".$config_basedir."admin/listNotice.php");