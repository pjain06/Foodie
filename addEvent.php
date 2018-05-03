<?php
session_start();
include_once("DBconnect.php");
// to inset into recipe table

function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$error= "";
if(isset($_POST["group"]))
{
$gid = $_POST["group"];
$gid=cleanData($gid);
}
if(isset($_POST["EventName"]))
{
$EventName = $_POST["EventName"];
$EventName=cleanData($EventName);
}
if(isset($_POST["description"])){
$description = $_POST["description"];
$description=cleanData($description);
}
if(isset($_POST["startTime"])){
$startTime = $_POST["startTime"];
}
if(isset($_POST["endTime"])){
$endTime = $_POST["endTime"];
}
if(isset($_POST["locationCity"])){
$locationCity = $_POST["locationCity"];
$locationCity=cleanData($locationCity);
}
if(isset($_POST["locationStreet"])){
$locationStreet = $_POST["locationStreet"];
$locationStreet=cleanData($locationStreet);
}
if(isset($_POST["locationState"])){
$locationState = $_POST["locationState"];
$locationState=cleanData($locationState);
}

$conn->begin_transaction();
try{
	$sql="insert into event values(null,$gid,'$EventName','$description','$startTime','$endTime','$locationCity','$locationStreet','$locationState')";
	if($result = $conn->query($sql))
	{
	$conn->commit();
	$sqleid="select max(eid) as e from event where 1";
	//echo $sqleid;
	$resulteid = mysqli_query($conn, $sqleid);

		if (mysqli_num_rows($resulteid) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($resulteid)) {
        $eid=$row["e"];
    }
	
	}
			
}
	 header("Location: rsvp.php?eid=$eid&gid=$gid");
}
catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
	$error = $e;
	
    $conn->rollback();
	//sleep(2);
	header("Location: createRecipe.php");
}
?>

