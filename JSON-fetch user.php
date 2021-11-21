<?php
include_once("db_connect.php");
$cat=$_GET["cat"];
$query="select * from users where category='$cat'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>