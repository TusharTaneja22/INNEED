<?php
include_once("db_connect.php");
$uid=$_GET["luid"];
$pwd=$_GET["lpwd"];
$query="select * from citizens where uid='$uid'";
$table=mysqli_query($dbcon,$query);
if(mysqli_num_rows($table)==0)
    echo "0";
else{
    echo "1";
}
?>