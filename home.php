<?php
session_start();
include_once("DBconnect.php");
include_once("checkLogin.php");

$top_recipe="";
$uid=$_SESSION['uid'];
$firstName=$_SESSION['username'];
include_once("frontPanel.php");
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
			<div class="typename"  style="padding-left:40px ; padding-top: 10px; margin-bottom: -20px">
			<p><b><h4 class="titles"> RECENTLY VIEWED RECIPES: </h4></b></p>
			</div>
		<br>
		
		
		<?php
		//echo $uid;
		
		
		
		$sql_recently_viewed_recipes = "SELECT DISTINCT A.rid from (select rid, view_time from recently_viewed ORDER BY view_time DESC) as A LIMIT 5";
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
			echo "0 results";
		}
	
		?>
		
	</div>
	<br>
	<br>
	
	<div class="row" style="padding:10px; margin-left: 230px; background-color: #f8f8f8; width: 100%">
	<div class="typename"  style="padding-left:40px ; padding-top: 10px; margin-bottom: -20px">
			<p><b><h4 class="titles"> TOP RATED RECIPES: </h4></b></p>
		</div>
		
		<br>
		
		
		
		<?php
	
		$sql = "SELECT rid, AVG(stars) as c from review group by rid order by c DESC LIMIT 5";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
	
			$count = 0;
			$stars1 = 0;
			$stars2 = 0;
			$stars3 = 0;
			$stars4 = 0;
			$stars5 = 0;
	while($row = mysqli_fetch_assoc($result)) {
		
			if($count==0)
			{
				$stars1=$row["c"];
				$rid1=$row["rid"];
			}
			if($count==1)
			{
				$stars2=$row["c"];
				$rid2=$row["rid"];
			}
			if($count==2)
			{
				$stars3=$row["c"];
				$rid3=$row["rid"];
			}
			if($count==3)
			{
				$stars4=$row["c"];
				$rid4=$row["rid"];
			}
			if($count==4)
			{
				$stars5=$row["c"];
				$rid5=$row["rid"];
			}
			
			$stars1 = round($stars1);
			$stars2 = round($stars2);
			$stars3 = round($stars3);
			$stars4 = round($stars4);
			$stars5 = round($stars5);
			
			$count++;
		
		}
		}
	else {
			echo "0 results";
		}
	
		?>

		<div class="col-md-2">
		<a href="displayrecipe.php?rid=<?php echo $rid1?>">
			<div style="height: 300px; width: 200px; background-color: #ffffff">
			<?php
			
			$sql = "SELECT recipe.title as title, recipe_photo.rid, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid1 and recipe_photo.rid=$rid1 and photoid=1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			
			 if($row["photo"]==0) 
			 {
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
			 }
			else 
			{
				echo  '<img src="images/nophoto.png" width="200" height="200">';
			}
			?>
			<h3 align="center" style="color: #E9967A"><?php
			echo $row["title"]."<br>";
		
			$sql="select starimage from stars where id=$stars1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['starimage']) . '" width="150" height="30">';
			?>
			</h3>
			</div>
		</div></a>

	<?php	
?>

		<div class="col-0">
		</div>


		<div class="col-md-2">
			<a href="displayrecipe.php?rid=<?php echo $rid2?>"><div style="  height: 300px; width: 200px; background-color: #ffffff">
			<?php
			$sql = "SELECT recipe.title as title, recipe_photo.rid, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid2 and recipe_photo.rid=$rid2 and photoid=1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			if($row["photo"]==0) 
			 {
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
			 }
			else 
			{
				echo  '<img src="images/nophoto.png" width="200" height="200">';
			}
			
			?>
			<h3 align="center" style="color: #E9967A">
			<?php
			echo $row["title"]."<br>";
			$sql="select starimage from stars where id=$stars2";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['starimage']) . '" width="150" height="30">';
			?>
			
			</h3>
			</div></a>
		</div>
		
		<div class="col-0">
			</div>
			
		<div class="col-md-2">
			<a href="displayrecipe.php?rid=<?php echo $rid3?>">
			<div style="height: 300px; width: 200px; background-color: #ffffff">
				<?php
			$sql = "SELECT recipe.title as title, recipe_photo.rid, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid3 and recipe_photo.rid=$rid3 and photoid=1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			if($row["photo"]==0) 
			 {
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
			 }
			else 
			{
				echo  '<img src="images/nophoto.png" width="200" height="200">';
			}
			?>
			
			<h3 align="center" style="color: #E9967A"><?php
			echo $row["title"]."<br>";
			$sql="select starimage from stars where id=$stars3";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['starimage']) . '" width="150" height="30">';
			?>
			
			</h4>
			</div>
			</a>
		</div>

		<div class="col-0">
		</div>
		
		<div class="col-md-2">
			<a href="displayrecipe.php?rid=<?php echo $rid4?>">
			<div style="height: 300px; width: 200px; background-color: #ffffff">
				<?php
			$sql = "SELECT recipe.title as title, recipe_photo.rid, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid4 and recipe_photo.rid=$rid4 and photoid=1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			if($row["photo"]==0) 
			 {
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
			 }
			else 
			{
				echo  '<img src="images/nophoto.png" width="200" height="200">';
			}
			?>
			<h3 align="center" style="color: #E9967A"><?php
			echo $row["title"]."<br>";
			$sql="select starimage from stars where id=$stars4";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['starimage']) . '" width="150" height="30">';
			?>
			</h3>
			</div>
			</a>
		</div>
		
		<div class="col-0">
		</div>
		
		<div class="col-md-2">
			<a href="displayrecipe.php?rid=<?php echo $rid5?>">
			<div style="height: 300px; width: 200px; background-color: #ffffff">
				<?php
			$sql = "SELECT recipe.title as title, recipe_photo.rid, recipe_photo.photo as photo 
			FROM recipe_photo, recipe 
			WHERE recipe.rid=$rid5 and recipe_photo.rid=$rid5 and photoid=1";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			if($row["photo"]==0) 
			 {
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="200" height="200">';
			 }
			else 
			{
				echo  '<img src="images/nophoto.png" width="200" height="200">';
			}
			?>
			<h3 align="center" style="color: #E9967A"><?php
			echo $row["title"]."<br>";
			$sql="select starimage from stars where id=$stars5";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['starimage']) . '" width="150" height="30">';
			?></h4>
			</div>
		</div>
		</a>
	</div>


</div>


</body>