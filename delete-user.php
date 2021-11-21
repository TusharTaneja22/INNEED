<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$query="delete from users where uid='$uid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "User Deleted";   
else
    echo $msg;
?>