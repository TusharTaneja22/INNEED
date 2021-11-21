<?php
include_once("db_connect.php");
$cuid=$_GET["cuid"];
$wuid=$_GET["wuid"];
$query="insert into ratings (citizenuid,workeruid) values ('$cuid','$wuid')";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Data Stored";   
else
    echo $msg;
?>