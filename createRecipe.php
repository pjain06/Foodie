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

?>


<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<Script>

$(function () {
    var addInputRow = function () {
        $('#input').append($('#template').html());
    };
	 

    addInputRow();
	
    $('#ActionAddRow').on('click', addInputRow);
    
});
</script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<link rel="stylesheet" href="style.css">
</head>
<body>  

<?php
// define variables and set to empty values
include_once("Fetchdata.php");
$title = $description = $prepTime = $cookTime = $servings = "";


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

<div class="col-12">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:white">
	</div>
	
	
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</h4></a>
	</div>
	
	
	<div class="links" style="width:80%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Cancel</h4></a>
	</div>
	
	
</div>
	<div class="row" id="test" style="padding-bottom:10px; margin-left: 230px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">

<div class="col-sm-offset-1 col-sm-6">
<h3 class="page-header"> Add a Recipe</h3>
<form class="form-horizontal" id="myform" method="post" action="upload.php" enctype="multipart/form-data">  
  <div class="form-group">
 
  <input class="form-control input-sm" required="true" type="text" placeholder="Recipe Title" name="title" value="<?php echo $title;?>">
</div>
<div class="form-group">
   <textarea class="form-control input-lg" required="true" name="description" placeholder="Description" rows="4" cols="60"><?php echo $description;?></textarea>
  </div>
  <div class="form-group">
   <input class="form-control input-sm" required="true" type="number" name="servings" placeholder="Servings" value="<?php echo $servings;?>">
  </div>
  <table class="form-group">
   <td><input class="form-control input-sm" type="number" placeholder="PrepTime " name="prepTime" value="<?php echo $cookTime;?>"></td>
   <td><select class="form-control" name="prepTimeUnit" >
                                        <option value="1">Minutes</option>
                                        <option value="60">Hours</option>
                                       
   </select></td>
   </table>
  <div class="form-group">
  <table>
   <td><input class="form-control input-sm" type="number" placeholder="cookTime " name="cookTime" value="<?php echo $cookTime;?>"></td>
   <td><select class="form-control" name="cookTimeUnit" >
                                        <option value="1">Minutes</option>
                                        <option value="60">Hours</option>
                                       
   </select></td>
   </table>
   
   </div>
     <table class="form-group" 	id="tabledata">
    <tbody id="input"></tbody>	
	<tbody id="template">
        <tr  class="form-group">
            <td><input class="form-control input-sm" type='text' name='ingredient[]' placeholder='ingedient' /></td>
            <td><input class="form-control input-sm"  type='number' step='any' name='quantity[]' placeholder='quantity'/></td>
            <td><?php echo $select ?></td>
			
        </tr>
        </tbody>
</table>
	<div>
<button class="btn pull-right" type="button" id="ActionAddRow">Add Ingredients</button>
  <br>
  <br>
 
 <h4>Recipe Category</h4>
<?php echo $checkbox ?>
    Upload recipe Images
<br/>
 <div class="form-group">
	<img  id="rimage"  alt="Upload Photos" width="150" height="150" src="images/nophoto.png"/>
	<input class="form-control"  id="filesToUpload" name="filesToUpload[]" type="file" multiple="multiple"  onchange="document.getElementById('rimage').src = window.URL.createObjectURL(this.files[0])"><br />  
	</div>   
</form>



<input class="btn-primary" type="submit" form="myform" />

</div>
</div>
</center>
</body>
</html>
