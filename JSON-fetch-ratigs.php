<?php
include_once("db_connect.php");
$uid=$_GET["uid"];
$query="select * from ratings where citizenuid='$uid'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>