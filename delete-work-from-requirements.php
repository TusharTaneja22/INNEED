<?php
include_once("db_connect.php");
$rid=$_GET["rid"];
$query="delete from requirements where rid='$rid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Work posted successfully";   
else
    echo $msg;
?>