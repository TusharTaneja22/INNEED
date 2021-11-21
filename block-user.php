<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$query="update users set status=0 where uid='$uid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "User Blocked";   
else
    echo $msg;
?>