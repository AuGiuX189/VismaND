<?php

session_start();

$mysqli = new mysqli('localhost','root','','vismand')or die(mysqli_error($mysqli));
    $id=0;
	$upate=false;
    $name= '';
	$registration_code= '';
	$email= '';
	$phone= '';
	$comment= '';

if(isset($_post['save']))
{
	
	$name= $_post['name'];
	$registration_code= $_post['RegiCode'];
	$email= $_post['email'];
	$phone= $_post['number'];
	$comment= $_post['comment'];
	
	$mysqli->query("INSERT INTO fields (name, RegiCode, email, number, comment)VALUES('$name','$registration_code','$email','$number','$comment')")
	or die($mysqli_error);
	
	$_SESSION['message']="record has been saved";
	$_SESSION['msg_type']="success";
	
	header("location:augio.html");
}
if(isset($_GET['delete']))
{
	$id =$_GET['delete'];
	$mysqli->("DELETE * FROM fields WHERE id=$id")or die($mysqli->error());
	
	$_SESSION['message']="record has been deleted";
	$_SESSION['msg_type']="success";
	
	header("location:augio.html");
}
if(isset($_GET['edit']))
{
	$id =$_GET['edit'];
	$upate = true;
	$mysqli->("SELECT * FROM fields WHERE id=$id")or die($mysqli->error());
	if(count($result)==1)
	{
		$row=$result->fetch_array();
		$name= $row['name'];
		$registration_code= $row['RegiCode'];
		$email= $row['email'];
		$phone= $row['number'];
		$comment= $row['comment'];
	}
}
if(isset($_post['update']))
{
	$id=$_post['id'];
	$name= $_post['name'];
	$registration_code= $_post['RegiCode'];
	$email= $_post['email'];
	$phone= $_post['number'];
	$comment= $_post['comment'];
	
	$mysqli ->query("UPATE fields SET name='$name', RegiCode='$registration_code', email='$email', number='$phone', comment='$comment'WHERE id=$id")or die($mysqli->error);
	$_SESSION['message']="record has been updated";
	$_SESSION['msg_type']="success";
	header('location:augio.html');
}
