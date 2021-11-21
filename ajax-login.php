<?php
session_start();//creates sessionn array
include_once("db_connect.php");
$uid=$_GET["luid"];
$pwd=$_GET["lpwd"];
$query="select * from users where uid='$uid' and pwd='$pwd' and status=1";
$table=mysqli_query($dbcon,$query);
if(mysqli_num_rows($table)==0)
    echo "Invalid userid or password";
else{
    $row=mysqli_fetch_array($table);
    $_SESSION["activeuser"]=$uid;//stored uid in session
    echo $row['category'];
}
?>