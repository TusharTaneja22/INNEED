<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$query="update users set status=1 where uid='$uid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "User Unblocked";   
else
    echo $msg;
?>