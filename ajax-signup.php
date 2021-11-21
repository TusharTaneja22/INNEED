<?php
include_once("db_connect.php");
include_once("SMS_OK_sms.php");
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];
$mob=$_GET["mobile"];
$category=$_GET["category"];
$msg="Thank you for signing up. Your UserID is '$uid' and Password is '$pwd'";

$query="insert into users values ('$uid','$pwd','$mob','$category',curdate(),1)";
mysqli_query($dbcon,$query);
$err=mysqli_error($dbcon);
if($err=="")
{
    $msg=SendSMS($mob,$msg);
    echo "You are signed up and $msg";   
   
}
else
    echo $err;
?>