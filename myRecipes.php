<?php
session_start();
include_once("DBconnect.php");
include("checkLogin.php");
$firstName=$_SESSION['username'];
$uid=$_SESSION['uid'];
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

	<link rel="stylesheet" type="text/css" href="css/styling.css">
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
	  
      
  </div>
</nav>

</head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<style>
table tr {
	border-left: 1px solid #000;
 
}
</style>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
  <script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable();
    });
</script>
  </script>
</body>

<body>

<br>
<br>

<div class="links" style="width:150px; height: 50px; background-color:#f8f8f8; margin-top:-12px; margin-left:10px; border-radius:5px">
	

<div class="links" style="width:150px; height: 50px; background-color:white; margin-top:-12px; border-radius:5px">
	<a href="myRecipes.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>


<div class="links" style="width:150px; height: 50px; background-color:#A52A2A; float:left; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Home</h4></a>
	</div>

	<br>
	<br>
	<br>
	
<div class="links" style="width:150px; height: 50px; background-color:#A52A2A; float:left; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Group</h4></a>
	</div>
<br>
<br>
<br>

<div class="links" style="width:150px; height: 50px; background-color:#A52A2A; float:left; border-radius:5px">
	<a href="upcomingevents.php" style="text-decoration: none; color:white"><h4 align="center" style="padding:10px"> Events</h4></a>
	</div>

	
</div>
	<div class="row" id="test" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -50px">
	<div class="typename"  style="padding-left:500px ; padding-top: -50px; margin-bottom: -20px">
			<p><b><h3 class="titles"> ALL RECIPES: </h3></b></p>
			</div>	
			<br>
			<br>
			<br>
	
<div class="datatablediv" style="width: 800px; margin-left:250px;">
<fieldset>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Rating</th>
            </tr>
        </thead>
		  <tbody>
 <?php
 $sql = "SELECT recipe.rid, recipe.title as title, photo as photo
		from recipe natural join recipe_photo where recipe.uid='$uid' and photoid=1 group by rid";
 //, recipe_photo.photo as photo from review natural join recipe_photo where photoid=1
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$rid=$row["rid"];
			$query = "SELECT AVG(stars) as stars from review where rid=$rid";
			$resultstars = mysqli_query($conn, $query);
			$starsarray = mysqli_fetch_assoc($resultstars);
			$stars = round($starsarray['stars']);
			
 ?>
      
		  
            <tr>
                <td align="center">
				<?php
				if($row["photo"]==0)
					
					{
						echo  '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" width="100" height="100">';
					}
					else{
						echo "no photo available";
					}
				?>
				</td>
			
                <td align="center">
				<h3 class="recipetext" style="color: black"><a  style="color: black" href="displayRecipe.php?rid=<?php echo $rid?>">
				<?php
				echo $row["title"]?>
				</a>
				</h3>
				</td>
				
				<td align="center">
				<?php
				if($stars!=0)
				{
					$sqlstar="select starimage from stars where id=$stars";
					$resultsiadplaystar = mysqli_query($conn,$sqlstar);
					$rowstar = mysqli_fetch_assoc($resultsiadplaystar);
					echo  '<img src="data:image/jpeg;base64,' . base64_encode($rowstar['starimage']) . '" width="150" height="30">';
								
				}
				else 
					echo "no rating available";
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
	
	</body>
	<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true
    } );
} );
	</script>
	
</html>