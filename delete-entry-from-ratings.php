<?php
include_once("db_connect.php");
$rid=$_GET["rid"];
$query="delete from ratings where rid='$rid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Done";   
else
    echo $msg;
?>