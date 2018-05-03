<?php
session_start();
include_once("DBconnect.php");
if(isset($_POST["formgroup"]))
{
$uid=$_SESSION['uid'];
$name=$_POST["title"];
$description = $_POST["description"];

echo "name is ".$name;
echo "description is ".$description;

$sqlgid="select max(gid) as mgid from cooking_group where 1";
		$resultgid = mysqli_query($conn, $sqlgid);
		$reviewgid = mysqli_fetch_assoc($resultgid);
		$mgid=$reviewgid["mgid"];
		echo $mgid.'<br>';
		$mgid++;
		echo $mgid;
		
		$sql="insert into cooking_group(gid,gname,gdescription) 
		values($mgid,'$name','$description')";
		//echo $sql;
		//exit();
		$result= mysqli_query($conn, $sql);
		
		
		$sqlmmemid="select max(membersshipid) as mid from group_members where gid=$mgid";
		$resultmemid = mysqli_query($conn, $sqlmmemid);
		$reviewmemid = mysqli_fetch_assoc($resultmemid);
		$mem_id=$reviewmemid["mid"];
		echo $mem_id.'<br>';
		$mem_id++;
		echo $mem_id;
		
		
			
		$sql2="insert into group_members(gid,uid,membersshipid) 
		values($mgid,'$uid',$mem_id)";
		$result2= mysqli_query($conn, $sql2);
echo "successful";
		header('Location: displaygroups.php');
}

	else
			{
				$error= "Error in form data";
			//sleep(2);
			echo $error;
			}

?>