
  

<?php
session_start();
include_once("DBconnect.php");
$top_recipe="";
include("checkLogin.php");
$rid = $_GET["rid"];
//echo $rid;

$currentuser=$_SESSION['uid'];
$firstName=$_SESSION['username'];
 $viewtime= date("Y-m-d h:i:s");
 $sql_log = "insert into recently_viewed values('$currentuser','$rid','$viewtime')";
 $execute_sql_log=mysqli_query($conn,$sql_log);
 if(!$execute_sql_log)
  {
	 echo "problem";
 }
 

?>

<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

	<link rel="stylesheet" type="text/css" href="css/styling.css">
	



</head>


<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>


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
	<a href="home.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Home</h4></a>
	</div>
	<br>
	<div class="links" style="width:80%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displayAll.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> All Recipes</h4></a>
	</div>
	<br>
	<div class="links" style="width:80%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Groups</h4></a>
	</div>
	<br>
	<div class="links" style="width:80%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="upcomingEvents.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Events</h4></a>
	</div>
	<br>
	
		<div class="links" style="width:80%; height: 70px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="createRecipe.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Create Recipe</h4></a>

	</div>
</div>



	<div class="row" id="test" style="padding-bottom:10px; margin-left: 230px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">

<div class="col-sm-offset-1 col-sm-6" STYLE="margin-bottom: -20px">
<table class="form-group">
<tr>
   <td>
                                       
   
  <?php
	$sql = "SELECT recipe.description as text, recipe.title as title,recipe_photo.photo as photo FROM recipe ,recipe_photo
			WHERE recipe.rid=$rid and recipe_photo.rid=$rid limit 1";
			
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
		echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
		$title= $row["title"];
  ?>
  </td>
 <td align="center" style="padding-left: 1%"> <h1><?php echo $title ?></h1>
 </td>
 </tr>
 </table>
</div>

<script>

var images = [ "https://www.royalcanin.com/~/media/Royal-Canin/Product-Categories/cat-adult-landing-hero.ashx",
  "https://www.petfinder.com/wp-content/uploads/2013/09/cat-black-superstitious-fcs-cat-myths-162286659.jpg"

];
var imageHead = document.getElementById("image-head");
var i = 0;

setInterval(function() {
      imageHead.style.backgroundImage = "url(" + images[i] + ")";
      i = i + 1;
      if (i == images.length) {
      	i =  0;
      }
}, 3000);
</script>
			
					<!--<a href="index.html"><img src="images/turkey.jpg" style="  height:200px; width: 600px" alt="Image"></a>-->
				
<br></br>



<?php
// define variables and set to empty values

?>

<br>
<div class="col-sm-offset-1 col-sm-6" style="margin-top: -10px; margin-bottom: -20px">
<div class="text">
 <h4 align="center"><u> INGREDIENTS:  </u></h4>
 
 <?php
 $sql = "SELECT iName, quantity, unit
		from contains_ingredient
			WHERE rid=$rid ";
			$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result)) {
					
					?> 
					
					<?php
					echo  "<h4>"."			".$row["iName"]."			".$row["quantity"]."			".$row["unit"]."</h4>";
					?><?php
				}
 ?>
 <br>
 
  </div>
</div>
<div class="col-sm-offset-1 col-sm-6"> 
 <div class="text">
 <h4 align="center"><u> PROCEDURE: </u></h4>
 <?php
  $sql = "SELECT description
		from recipe
			WHERE rid=$rid ";
			$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result)) {
						$description= $row["description"];
						$array = explode(".", $description);
						foreach ($array as $item) {
						echo "<h4>"."$item<br>"."</h4>";
}

				}
 ?>
 </div>
</div>




<div class="col-sm-offset-1 col-sm-6" style="margin-top: -10px; margin-bottom: -20px">
<div class="text">
<h4 align="center"> REVIEWS:  </h4>
<fieldset>
<table id="example" class="display" cellspacing="0" width="100%">
         <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
				<th>Suggestion</th>
            </tr>
        </thead>
		  <tbody>
 <?php
 $sql = "SELECT title, suggestion, stars, uid, text, Review_id
		from review where rid=$rid order by reviewDate DESC";
 
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$uid=$row["uid"];
			$title=$row["title"];
			$suggestion=$row["suggestion"];
			$stars=$row["stars"];
			$text=$row["text"];
			$Review_id=$row["Review_id"];
			
			
			$queryname = "SELECT firstName, LastName from user where user.uid='$uid'";
			$resultusername = mysqli_query($conn, $queryname);
			$usernamearray = mysqli_fetch_assoc($resultusername);
			$fname = $usernamearray["firstName"];
			$lname = $usernamearray["LastName"];
			
			$sql_photo = "SELECT photo from review_photo where Review_id=$Review_id";
			$resultphoto = mysqli_query($conn, $sql_photo);
			$photoarray = mysqli_fetch_assoc($resultphoto);
			$photo=$photoarray["photo"];
			
 ?>
            
			<tr>
                <td align="center">
				<?php
				if($photo)
					
					{
						echo  '<img src="data:image/jpeg;base64,' . base64_encode($photo) . '" width="70" height="70">';
					}
					else{
						echo "no photo available";
					}
				?>
				</td>
			
                <td align="center">
				<h4 class="recipetext" style="color: black">
				<?php
				echo $uid."   says"."    ".$title."<br>"."</h4>";
				echo $text."<br>";
				?>
				</td>
				<td>
				<?php
				if($suggestion!=null)
					echo $suggestion;
				?>
				
				</td>
           </tr>
		   
			
			
		<?php
		}
		}
		?>
        </tbody>
    </table>
	</fieldset>
	</div>	
	</div>
	


	

<div class="col-sm-offset-1 col-sm-6" id="feedback">
<h3 class="page-header"> Give your feedback</h3>
<form class="form-horizontal" id="myform" method="post" action="upload_suggestion.php?uid=<?php echo $currentuser ?>&rid=<?php echo $rid ?>" enctype="multipart/form-data">  
  <div class="form-group">
 Review Title:
  <input class="form-control input-sm" required="true" type="text" placeholder="Title" name="title" value=<?php echo $title;?>></input>
</div>
  <div class="form-group">
 Review Text:
  <input class="form-control input-sm" required="true" type="text" placeholder="text" name="text" ></input>
</div>
 <div class="form-group">
 Stars:
  <input class="form-control input-sm" required="true" type="number" min="1" max="5" placeholder="stars" name="stars" ></input>
</div>

    <div class="form-group">
 Suggestion:
  <input class="form-control input-sm" required="true" type="text" placeholder="Suggestion" name="suggestion" ></input>
</div>

    Images
<br/>
 <div class="form-group">
	<img  id="rimage"  alt="Upload Photos" width="150" height="150" src="images/nophoto.png"/>
	<input class="form-control"  id="filesToUpload" name="filesToUpload[]" type="file" multiple="multiple"  onchange="document.getElementById('rimage').src = window.URL.createObjectURL(this.files[0])"><br />  
	</div>     
</form>

 



<input class="btn-primary" type="submit" form="myform" />

</div>
</div>

<?php
		$uid='Palash';
		$rid = $_GET["rid"];
		$result_check_reviewed=0;
		$check_if_reviewerd="select * from review where rid=$rid and uid='$uid'";
		$execute_check_reviewed = mysqli_query($conn,$check_if_reviewerd);
		$result_check_reviewed =  $rowcount=mysqli_num_rows($execute_check_reviewed);
		//echo $result_check_reviewed;
		if($result_check_reviewed!=0)
		{			
			?>
			<script type="text/javascript">
				 document.getElementById('feedback').style.display='none';
			</script>
			<?php
        } 
			
			
	?>


<script>
function myFunction() {
    document.getElementById("myP").style.visibility = "hidden";
}
</script>
	
	</body>
	<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true
    } );
} );
	</script>
	


<script> 
    function show() { 
        if(document.getElementById('myform').style.display=='none') { 
            document.getElementById('myform').style.display='block'; 
        } 
        return false;
    } 
    function hide() { 
        if(document.getElementById('feedback').style.display=='block') { 
            document.getElementById('feedback').style.display='none'; 
        } 
        return false;
    }



</script>

</center>
</body>
</html>
