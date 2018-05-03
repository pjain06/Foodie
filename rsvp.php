<!DOCTYPE HTML>  
<style>
body{
    background:url('images/background.jpg');
    padding:2px;
}

</style>

<?php
session_start();

$_SESSION['previous'] = basename($_SERVER['PHP_SELF']);
if (isset($_SESSION['previous'])) {
   if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
	   echo " You are not authorised to view this page";
        session_destroy();
        exit();
   }
}
include("checkLogin.php");
$firstName=$_SESSION['username'];
$uid=$_SESSION['uid'];

include_once("DBconnect.php");
// to inset into recipe table

function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_GET["eid"]))
{
$eid = $_GET["eid"];
$eid=cleanData($eid);
}
if(isset($_GET["gid"]))
{
$gid = $_GET["gid"];
$gid=cleanData($gid);
}

$sql ="insert into rsvp values($eid,'$uid',now(),'no',$gid);";
if($result = $conn->query($sql))
	{
	echo("RSVP Completed");
	header("Location: upcomingEvents.php");
	}
	else 
	{
		echo("Cannot RSVP once again");
		header("Location: upcomingEvents.php");
	}

