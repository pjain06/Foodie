<?php
session_start();
include_once("DBconnect.php");
include_once("checkLogin.php");

$tid=$_GET["tid"];
$uid=$_SESSION['uid'];
//echo $uid;
$rid=$_GET["rid"];
$firstName=$_SESSION['username'];
$tagname=$_GET["tagname"];
include_once("frontPanel.php");


//insert in reciently_viewed_tags

 $viewtime= date("Y-m-d h:i:s");
 $sql_log = "insert into recently_viewed_tags values('$uid','$tid','$viewtime')";
 $execute_sql_log=mysqli_query($conn,$sql_log);
 if(!$execute_sql_log)
  {
	 echo "problem";
 }




?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
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
<body style=" background-color: #ffffff" style="height:1000px;">
	
	
					<!--<a href="index.html"><img src="images/turkey.jpg" style="  height:200px; width: 600px" alt="Image"></a>-->
				
<br></br>

<!--  Main page starts here -->
<div class="col-12">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:white">
	</div>
	
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="displayrecipe.php?rid=<?php echo $rid ?>" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Back</h3></a>
	</div>
	
	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="myRecipes.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> My Recipe</h3></a>
	</div>
	
	<div class="links" style="width:100%; height: 65px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displayAll.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> All Recipes</h3></a>
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
	
	

	<div class="row" id="test" style="padding-bottom:10px; margin-left: 230px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">
			<div class="typename" align="center" style=" padding-top: 10px; margin-bottom: -20px">
			<p align="center"><b><h2 class="titles"> Recipes related to <?php echo $tagname?>: </h2></b></p>
			</div>
		<br>
		
		<hr>
		<?php
		//echo $uid;
		
		
		
		$sql_recently_viewed_recipes = "SELECT DISTINCT rid from recipe_has_tag join tags on recipe_has_tag.tid=tags.tid where tags.tid=$tid and rid!=$rid";
		$execute_recently_viewed_recipes = mysqli_query($conn, $sql_recently_viewed_recipes);
		$no_of_views=mysqli_num_rows($execute_recently_viewed_recipes);
		if (mysqli_num_rows($execute_recently_viewed_recipes) > 0) {
				$count = 0;
	while($row_rv = mysqli_fetch_assoc($execute_recently_viewed_recipes)) {
		$rid=$row_rv["rid"];
//echo $rid;
		$sql_photo_recently_viewed="SELECT recipe.title as title, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid and recipe_photo.rid=$rid and photoid=1";
			$result_photo = mysqli_query($conn,$sql_photo_recently_viewed);
			$photo = mysqli_fetch_assoc($result_photo);
		
		?>
		
		
		<script type="text/javascript">
		var iDiv = document.createElement('div');
		iDiv.id = 'block';
		iDiv.className = 'col-2';
		iDiv.style.backgroundColor = "white";
		iDiv.style.width = "200px";
		iDiv.style.height = "280px";
		iDiv.style.padding = "0";
		iDiv.style.margin = "20";
		document.getElementById("test").appendChild(iDiv);
		iDiv.innerHTML=(
		'<a href="displayrecipe.php?rid=<?php echo $rid?>"><?php  if($photo["photo"]!=null) {echo  '<img src="data:image/jpeg;base64,' . base64_encode($photo['photo']) . '" width="200" height="200">';} else {echo  '<img src="images/nophoto.png" width="200" height="200">';} ?><br><h3 align="center" style="color: #E9967A"><?php echo $photo["title"]?></h3>	</a>'
		
		);
		
		
				
				
				
		
			//document.write('<img width="200" height="200" src="images/cake.jpg" />');
			//document.getElementById("block").appendChild(imageDiv);
		
		</script>

			<div class="col-0" style="margin-left: 20px">
		</div>
		<?php
		
		
		}?>
		
		<?php
	}
	else {
		?>
		<p align="center" style="padding:10px; font-size:20px">
		<?php
			echo "no other recipes with this tag are available";
			?>
			</p>
			<?php
		}
	
		?>
		
	</div>
	<br>
	<br>
	


</div>


</body>