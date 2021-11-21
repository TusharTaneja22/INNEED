<?php
include_once("SMS_OK_sms.php");
$mobile=$_GET["mob"];
$msg=$_GET["msg"];

$msg=SendSMS($mobile,$msg);
echo $msg;
?>