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
$key=$_POST['key'];

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


<div class="col-12">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:white">
	</div>
	
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Back</h3></a>
	</div>
	
	
	

	</div>
</div>
	
	

	<div class="row" id="test" style="padding-bottom:10px; margin-left: 230px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">



<div class="col-sm-offset-2 col-sm-8">
<h3 class="page-header"> Search results</h3>
<?php include_once("DBconnect.php");
$sql="select distinct r.rid, r.title,r.description from recipe r natural join recipe_has_tag t natural join tags where title like  '%{$key}%'  or (r.rid = t.rid and tagname like  '%{$key}%' )";
if ($result = $conn->query($sql))
{
	echo "<table  class='table table-hover '>\n";
	if ($result->num_rows > 0) {
    // output data of each row with headers
		echo "\t<th>Recipe Title</th><th>Recipe Description</th>\n";
		while($row = $result->fetch_assoc()) {
			echo "\t<tr>\n";
			echo "\t\t<td><a href=displayrecipe.php?rid=$row[rid]>$row[title]</a></td><td><a href=displayrecipe.php?rid=$row[rid]>$row[description]</a></td>\n";
			
	}
		echo "</table>\n";
	}
	else {
		echo "0 results";
	}
	
	}	
?>
</div>
<div>
</div>
</center>
</body>
</html>
