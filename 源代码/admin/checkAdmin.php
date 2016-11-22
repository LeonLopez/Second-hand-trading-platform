<?php
require_once '../config/config.php';

function checkAdmin()
{
    if (isset($_SESSION['ADMINNAME']) == FALSE) {
        echo "<script>
            alert('请先登陆！');
            window.location='login.php';
         </script>";
    }
}