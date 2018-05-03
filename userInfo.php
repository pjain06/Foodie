<?php
session_start();
error_reporting(E_ERROR);
include_once("DBconnect.php");
// to inset into recipe table
$error= "";
function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




if(isset($_POST["uaddress"]))
$uaddress = $_POST["uaddress"];
if(isset($_POST["ucity"]))
$ucity = $_POST["ucity"];
if(isset($_POST["ustate"]))
$ustate = $_POST["ustate"];
if(isset($_POST["zip"]))
$zip = $_POST["zip"];
$uphoto = addslashes(file_get_contents($_FILES['uphoto']['tmp_name']));
if(isset($_POST["description"]))
$description = $_POST["description"];
if(isset($_POST["dateOfBirth"]))
$dateOfBirth = $_POST["dateOfBirth"];

$dateOfBirth = date('Y-m-d', strtotime($dateOfBirth));
if(isset($_POST["mobileNumber"]))
$mobileNumber = $_POST["mobileNumber"];

$uaddress=cleanData($uaddress);
$ucity=cleanData($ucity);
$zip=cleanData($zip);
$description=cleanData($description);
$mobileNumber=cleanData($mobileNumber);
$uid=$_SESSION['uid'];
	 
$conn->begin_transaction();
try{
	
					
		$sql ="call update_profile('$uid', '$uaddress', '$ucity', '$ustate', $zip, '$uphoto', '$description', '$dateOfBirth', '$mobileNumber');";
		if($result = $conn->query($sql))
		{
			
			
		$conn->commit();
		header("Location: updateprofile.php");
		}
		else
		{
			
			header("Location: updateprofile.php");
		}
	
		
	}
catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
	$error = $e;
	
    $conn->rollback();
	//sleep(2);
	header("Location: updateprofile.php");
}
?>