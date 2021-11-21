<?php
include_once("db_connect.php");
$category=$_GET["category"];
$city=$_GET["city"];
$query="select * from workers where category='$category' and city='$city'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>