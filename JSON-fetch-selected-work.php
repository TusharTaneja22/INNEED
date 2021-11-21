<?php
include_once("db_connect.php");
$category=$_GET["cat"];
$city=$_GET["city"];
$query="select * from requirements where category='$category' and city='$city' and DATE_SUB(curdate(),INTERVAL 10 DAY)<=dop";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>