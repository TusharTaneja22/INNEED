<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$category=$_GET["category"];
$prob=$_GET["prob"];
$location=$_GET["pos"];
$city=$_GET["city"];
$query="insert into requirements (cust_uid,category,problem,location,city,dop) values ('$uid','$category','$prob','$location','$city',curdate())";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Work posted successfully";   
else
    echo $msg;

?>