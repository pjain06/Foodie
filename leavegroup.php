<?php
session_start();
include_once("DBconnect.php");


$gid=$_GET["gid"];
$uid = $_GET["uid"];


		$sql="delete from rsvp where gid=$gid and uid='$uid'";		
		$result = mysqli_query($conn, $sql);
		$sqlmmemid="delete from group_members where gid=$gid and uid='$uid'";		
		$resultmemid = mysqli_query($conn, $sqlmmemid);
	
		
			
		

		header('Location: displaygroups.php');

?>