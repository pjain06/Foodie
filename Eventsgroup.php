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
$gid=$_GET['gid'];
?>


<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">

<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="css/styling.css">
		



</head>
<body>  

<?php
// define variables and set to empty values
include_once("fetchgid.php");
?>

<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Foodie</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 
	 <a class="navbar-brand navbar-right" href="Logout.php"><span class="glyphicon glyphicon-user">Logout</span></a>
	 <a class="navbar-brand navbar-right" href="updateProfile.php"><span >Hello <?php echo $firstName?>  </span></a>
     <form class="navbar-form navbar-right"  method="post" action="search.php" role="search">
        <div class="form-group">
          <input type="text" class="form-control" name="key" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
	   <div class="navbar-header">
     
	  </div>
	  
      
  </div><!-- /.container-fluid -->
</nav>
</nav>





<div class="col-sm-offset-3 col-sm-6">
<h3 class="page-header">Upcoming Events in this group</h3>
<?php include_once("DBconnect.php");

$sql = "select eid,gid,eventName, eDescription, locationCity,startTime,endTime, gname from event natural join group_members natural join cooking_group where  startTime>now() and uid='$uid' and gid='$gid';";
if ($result = $conn->query($sql))
{
	echo "<table  class='table table-bordered '>\n";
	if ($result->num_rows > 0) {
    // output data of each row with headers
		echo "\t<th>Event Name</th><th>Event Description</th><th>Event Location </th><th>Event start date</th><th>Event end date</th><th>GroupName</th><th>RSVP</th>\n";
		while($row = $result->fetch_assoc()) {
			echo "\t<tr>\n";
			echo "\t\t<td>$row[eventName]</td><td>$row[eDescription]</td><td>$row[locationCity]</td><td>$row[startTime]</td><td>$row[endTime]</td><td>$row[gname]</td>\n";
			$query="select * from rsvp where eid=$row[eid] and uid='$uid'";
			$newresult = $conn->query($query);
			if ($newresult->num_rows < 1){
			echo "\t<td><a href=rsvp.php?eid=$row[eid]&gid=$row[gid]>RSVP</a></td>";}
			else{
			echo "\t<td>RSVP Done</td></tr>\n";
			}
	}
		echo "</table>\n";
	}
	else {
		echo "0 results";
	}
	
	}	
?>
</div>
</div>
</center>
</body>
</html>
