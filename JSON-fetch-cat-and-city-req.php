<?php
include_once("db_connect.php");
$query="select distinct city,category from requirements";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>