<!doctype html>
</html>
<head>
<meta charset="utf-8">
<style>
body{
    background-color: #f8f8f8;
    padding:2px;
	height: 500px;
}

</style>
<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
		
      <a class="navbar-brand" href="home.php">Foodie</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
	<a class="navbar-brand navbar-right" href="logout.php"><span class="glyphicon glyphicon-user">Signout</span></a>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
     <form class="navbar-form navbar-right"  method="post" action="search.php" role="search">
        <div class="form-group">
          <input type="text" class="form-control" name="key" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
	  
</div>
</nav>
<body>
<div class="col-12" style=" background-color: #f8f8f8; height:500px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:500px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 80%;  margin-left: -20px; margin-top: -50px; height: 20px; background-color:f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displayAll.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Home</h3></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Groups</h3></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="upcomingEvents.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Events</h3></a>

	</div>
		<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="createRecipe.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Create Recipe</h3></a>

	</div>
</div>
	

<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>	

<?php
session_start();
$uid=$_SESSION['uid'];
include("checkLogin.php");
include_once("fetchProfileData.php");
?>
	<div class="row" id="test" style="padding-bottom:10px; height:500px; margin-left: 200px; width: 80%; background-color: #f8f8f8;margin-top: -500px">
<form class="form-horizontal" id="updateProfileForm" method="post" action="userInfo.php" enctype="multipart/form-data">  
 <div class="col-sm-offset-1 col-sm-4">
   <div class="form-group">
   <div>
  
</div>
<?php echo '<img id="rimage" class="img-circle" alt="Upload Photos" width="150" height="150" src="data:image/jpeg;base64,'.base64_encode( $uphoto ).'"/>';?>
	
	<label for="uphoto" class="btn btn-info active">Upload New Profile Photo</label>
	<input  style="visibility:hidden" id="uphoto" name="uphoto" type="file"   onchange="document.getElementById('rimage').src = window.URL.createObjectURL(this.files[0])">  
</div>   
  
<b>Date of Birth</b>
  <input class="form-control input-sm" required="true" type="date" placeholder="DOB" name="dateOfBirth" value=<?php echo $dateOfBirth;?> />
  <br>	
  <b>User Profile</b>
   <textarea class="form-control input-lg" required="true" name="description" placeholder="User Description" rows="4" cols="60"  ><?php echo $description;?></textarea>
  <br>
  

  </div>
  <br>
  <br>
   <div class="col-sm-offset-1 col-sm-4">
   <b>Mobile Number</b>
   <input class="form-control input-sm"  required="true" type="text" placeholder="mobile Number" name="mobileNumber"value="<?php echo $mobileNumber1;?>" />
   <br>
   <b>User Address</b>
 
  <input class="form-control input-sm" required="true"  type="text" placeholder="Address Line 1" name="uaddress" value="<?php echo $uaddress1;?>" />
  <br>
  <b>User City</b>
  
  <input class="form-control input-sm"  required="true" type="text" placeholder="City" name="ucity" value="<?php echo $ucity1;?>" /><br>
  <b>User State</b>
  <input class="form-control input-sm"required="true" type="text" placeholder="State" name="ustate" value="<?php echo $ustate1;?>" />
  <br>
  <b>User Zip</b>
  <input class="form-control input-sm"  required="true" type="number" placeholder="Zip" name="zip" value="<?php echo $zip1 ;?>" />
  <br>
  </form>
  <input class="btn-primary" type="submit" value="Update Profile" form="updateProfileForm" />
  </div>
  
  </div>
  
</div>
</body>
</html>
  

	

	
	
