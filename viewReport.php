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
$eid=$_GET['eid'];

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
		

<style>
 h4.titles{
		color: #777;
		font-size: 17px;
        font-family: 'PT Sans';
		margin-top: -10px;
		}
		
 recipe{
	height: 200px;
	width: 200px; margin-left: 25px;
	margin-top: 25px;
	}
 body {
        background: #f8f8f8;
        width: 100%;
        margin-top: 10px;
    }
.row::after {
    content: "";
    clear: both;
    display: block;
	
}
[class*="col-"] {
    float: left;
    padding: 15px;
	
}
.col-0 {width: 2%;}
.col-1 {width: 8.33%;}
.col-2 {width: 13.76%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 70%;}
.col-11 {width: 91.66%;
}
.col-12 {width: 85%;}
.tab {width: 15%;}
.row-left{width: 10%;}
.row-right{width: 90%;}
.handonhover { cursor: pointer; cursor: hand; }
.paneltab{
	width: "50px";
	background-color: black;
	}
</style>



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
<div class="col-12">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:#f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<br>
	
	<div class="links" style="width:100%; height: 65px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="createEvent.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Create Event</h3></a>
	</div>
	<div class="links" style="width:100%; height: 10px; background-color:#f8f8f8; margin-top:12px; border-radius:5px">
	
	</div>
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="attendedEvents.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px">Attended Events</h3></a>
	</div>
	<div class="links" style="width:100%; height: 10px; background-color:#f8f8f8; margin-top:12px; border-radius:5px">
	
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="upcomingEvents.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Events</h3></a>

	</div>
</div>
	





<div class="row" id="test" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">


<div class="col-sm-offset-1 col-sm-4">
<h3 class="page-header">View Reports</h3>
<?php include_once("DBconnect.php");

$sql = " select eventName ,uid,report ,photos from event_report natural join event_photo natural join event where  eid='$eid';";

if ($result = $conn->query($sql))
{
	if ($result->num_rows > 0) {
    // output data of each row with headers
	$count=0;
		while($row = $result->fetch_assoc()) {
			$count++;
			if($count==1)
			{
				echo "<h3>Report for the event:  $row[eventName] </h3><br>";
				echo "<h4>Reported by:$row[uid] </h4>";
				echo "<h4>Report: $row[report] </h4>";
				echo "<br><h4>Images of the Event</h4>";
				echo '<div class="img-fluid">';
			} 
			
			echo  '<img src="data:image/jpeg ;base64,' . base64_encode($row['photos']) . '" width="150" height="150">   ';
		}
		echo '</div>';
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
