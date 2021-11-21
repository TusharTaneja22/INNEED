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
    $mail=$_POST["mail"];
    $fname=$_POST["fname"];
    $city=$_POST["city"];
    $address=$_POST["address"];
    $state=$_POST["state"];
    $category=$_POST["category"];
    $spc=$_POST["spc"];
    $exp=$_POST["exp"];
    $pwork=$_POST["pwork"];
    
    $orgNamep=$_FILES["profile"]["name"];
    $tmpNamep=$_FILES["profile"]["tmp_name"];
    
    $orgNamea=$_FILES["apic"]["name"];
    $tmpNamea=$_FILES["apic"]["tmp_name"];
    
    
    $query="insert into workers values('$uid','$mail','$name','$mob','$fname','$city','$address','$state','$category','$spc','$exp','$pwork','$orgNamep','$orgNamea',0,0)";
    mysqli_query($dbcon,$query);
    $msg=mysqli_error($dbcon);
    if($msg=="")
    {
	   move_uploaded_file($tmpNamep,"uploads/".$orgNamep);
	   move_uploaded_file($tmpNamea,"uploads/".$orgNamea);
        header("location:dash-worker.php");
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
    $mail=$_POST["mail"];
    $fname=$_POST["fname"];
    $city=$_POST["city"];
    $address=$_POST["address"];
    $state=$_POST["state"];
    $category=$_POST["category"];
    $spc=$_POST["spc"];
    $exp=$_POST["exp"];
    $pwork=$_POST["pwork"];
    
    $orgNamep=$_FILES["profile"]["name"];
    $tmpNamep=$_FILES["profile"]["tmp_name"];
    
    $orgNamea=$_FILES["apic"]["name"];
    $tmpNamea=$_FILES["apic"]["tmp_name"];
    
    $hdnp=$_POST["hdnp"];
    $hdna=$_POST["hdna"];
		
	if($orgNamep=="")
	{
		$fileNamep=$hdnp;
	}
	else
	{
		$fileNamep=$orgNamep;
		move_uploaded_file($tmpNamep,"uploads/".$orgNamep);
	}
	if($orgNamea=="")
	{
		$fileNamea=$hdna;
	}
	else
	{
		$fileNamea=$orgNamea;
		move_uploaded_file($tmpNamea,"uploads/".$orgNamea);
	}
	
$query="update workers set email='$mail',wname='$name',cnumber='$mob',firmshop='$fname',city='$city',address='$address',state='$state',category='$category',spl='$spc',exp='$exp',otherinfo='$pwork',ppic='$fileNamep',apic='$fileNamea' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
    header("location:dash-worker.php");
	echo "<h2>Record Updated successfully...</h2>";
}
else
	echo $msg;
}


?>
