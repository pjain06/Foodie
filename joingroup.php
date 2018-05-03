<?php
session_start();
include_once("DBconnect.php");


$gid=$_GET["gid"];
$uid = $_SESSION["uid"];
echo $uid;


		$sqlmmemid="select max(membersshipid) as mid from group_members where gid=$gid";
		$resultmemid = mysqli_query($conn, $sqlmmemid);
		$reviewmemid = mysqli_fetch_assoc($resultmemid);
		$mem_id=$reviewmemid["mid"];
		echo $mem_id.'<br>';
		$mem_id++;
		echo $mem_id;
		
		
			
		$sql="insert into group_members(gid,uid,membersshipid) 
		values($gid,'$uid',$mem_id)";
		$result= mysqli_query($conn, $sql);

		header('Location: displaygroups.php');

?>