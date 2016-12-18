<?php
require 'config/config.php';
require 'config/connect_db.php';
$verifystring = urldecode($_GET['verify']);
$verifyemail = urldecode($_GET['email']);
//echo $verifystring."<br/>";
//echo $verifyemail;
$checksql = "select * from user where verifystring='".$verifystring."' and email ='".$verifyemail."';";
$result = $db->query($checksql);
//print_r($result);
$numrows = $result->num_rows;
if($numrows==1){
    $row = mysqli_fetch_assoc($result);
    $sql = "update user set active=1 where id=".$row['id'];
    $db->query($sql);
    echo "<h3>账号激活成功</h3><br/>";
    echo "<h3><a href='login.php'>登陆</a></h3>";
}
else{
    echo "<h3>此账号不能通过验证</h3>";
}