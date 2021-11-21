<?php
include_once("db_connect.php");
$btn=$_POST["btn"];
if($btn=="Submit")
	dosubmit($dbcon);
else
	doupdate($dbcon);

function dosubmit($dbcon)
{
    $uid=$_POST["uid"];
    $name=$_POST["cname"];
    $mob=$_POST["mob"];
    $address=$_POST["address"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $orgName=$_FILES["profile"]["name"];
    $tmpName=$_FILES["profile"]["tmp_name"];
    $mail=$_POST["mail"];
    
    $query="insert into citizens values('$uid','$name','$mob','$address','$city','$state','$orgName','$mail')";
    mysqli_query($dbcon,$query);
    $msg=mysqli_error($dbcon);
    if($msg=="")
    {
	   move_uploaded_file($tmpName,"uploads/".$orgName);
        header("location:dash-citizen.php");
	   echo "<h2>You are signed up successfully...</h2>";
    }
    else
	   echo $msg;
}

function doUpdate($dbCon)
{
    $uid=$_POST["uid"];
    $name=$_POST["cname"];
    $mob=$_POST["mob"];
    $address=$_POST["address"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $orgName=$_FILES["profile"]["name"];
    $tmpName=$_FILES["profile"]["tmp_name"];
    $mail=$_POST["mail"];
    $hdn=$_POST["hdn"];//just file name
		
	if($orgName=="")//means user do not want to change the pic
	{
		$fileName=$hdn;//hdn contains the name of old pic
	}
	else //user want to change the pic
	{
		$fileName=$orgName;//new name assigned
		move_uploaded_file($tmpName,"uploads/".$orgName);
	}
	//record updated
$query="update citizens set name='$name',contact='$mob',address='$address',city='$city',state='$state',pic='$fileName',email='$mail' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
    header("location:dash-citizen.php");
	echo "<h2>Record Updated successfully...</h2>";
}
else
	echo $msg;
}


?>
