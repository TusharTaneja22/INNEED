<?php
include_once("db_connect.php");
include_once("SMS_OK_sms.php");
$uid=$_GET["uid"];
$query="select mobile,pwd from users where uid='$uid'";
$table=mysqli_query($dbcon,$query);
if(mysqli_num_rows($table)==0)
{
    echo "Invalid Username";
}
else{
    $row=mysqli_fetch_array($table);
    $mob=$row["mobile"];
    $pwd=$row["pwd"];
    $msg="Credentials for inneed.com login are UID: '$uid' and Password: '$pwd'.";
    $msg=SendSMS($mob,$msg);
    echo "Your Password has been sent to your registered mobile number.";
}
?>