<?php
include_once("DBconnect.php");
//$uaddress=$ucity=$ustate=$ustate=$zip=$uphoto=$description=$dateOfBirth=$mobileNumber="";
$sql = "select uaddress,ucity,ustate,zip,uphoto,description,dateOfBirth,mobileNumber from user where uid='$uid';";

if ($result = $conn->query($sql)){

 while($rs = $result->fetch_assoc()){
      $uaddress1=$rs['uaddress'];
	  $ucity1=$rs['ucity'];
	  $ustate1=$rs['ustate'];
	  $zip1=$rs['zip'];
	  $uphoto=$rs['uphoto'];
	  $description=$rs['description'];
	  $dateOfBirth=$rs['dateOfBirth'];
	  $mobileNumber1=$rs['mobileNumber'];
  }
}







?>









