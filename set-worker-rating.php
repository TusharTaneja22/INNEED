<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$rate=$_GET["rate"];
$query="update workers set total=total+'$rate',count=count+1 where uid='$uid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Rating Done";   
else
    echo $msg;
?>