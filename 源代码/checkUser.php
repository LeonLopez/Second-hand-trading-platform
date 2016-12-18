<?php
require_once 'config/config.php';

function checkUser()
{
    if (isset($_SESSION['USERNAME']) == FALSE) {
        echo "<script>
            alert('请先登陆！');
            window.location='login.php';
         </script>";
    }
}