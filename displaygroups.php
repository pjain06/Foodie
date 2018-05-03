<?php
session_start();
include_once("DBconnect.php");
$uid=$_SESSION['uid'];
$firstName=$_SESSION['username'];

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="css/styling.css">

<style>

.button{
	background-color: #DEB887; 
	border-radius:15px
}
.button:hover{
	background-color: white;
	border: #DEB887 solid 1px;
	
}

 h4.titles{
		color: #777;
		font-size: 17px;
        font-family: 'PT Sans';
		margin-top: -10px;
		}
		
		
   h3.recipetext{
		color: #000;
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
.col-0 {width: 1%;}
.col-1 {width: 8.33%;}
.col-2 {width: 13.66%;}
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

.handonhover { cursor: pointer; cursor: hand; }

</style>	
</head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<style>
table tr {
	border-left: 1px solid #000;
 
}
</style>



<body>

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
<br>
<br>

<div class="col-12" STYLE="MARGIN-top: -50px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:#f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:grey"><h4 align="center" style="padding:10px"> QUICK LINKS</4></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="home.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> HOME</h3></a>
	</div>
	
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="displayAll.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> All Recipes</h3></a>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="upcomingevents.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Events</h3></a>
	</div>
	<div class="links" style="width:100%; height: 70px; background-color:#A52A2A; margin-top:-5px; border-radius:5px">
	<a href="CreateNewGroup.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> Create Group</h3></a>
	</div>
	
	
</div>
	
	

<div class="row" id="test" align="center" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">
<div class="col-6" style="margin-left: 300px" id="test" style=" background-color: #f8f8f8">
<div class="title"><h2> My Groups  / Joined Groups</h2></div>
<div class="datatablediv" align="center" style="width: 600px; margin-left:0px;">


<fieldset> 
<table  align="center"id="example" class="display" cellspacing="0" width="100%">
        <thead>
				<th>Group</th>
				<th align="center">Description</th>	
				<th>Creator</th>				
				<th>Events</th>
				<th>View Members</th>
				<th>Leave</th>
				
				<!--
				<th>Location</th>
				<th>RSVP</th>-->
            </tr>
        </thead>
		  <tbody>
		
 <?php
 
		$sqlyourgroups = "SELECT gid,creator, gname,gdescription from cooking_group natural join group_members where uid='$uid'";
		//echo $sqlyourgroups;
 //natural join group_members where $uid='$uid'
		//$resultyourgroups = mysqli_query($conn, $sqlyourgroups);
		if($resultyourgroups = $conn->query($sqlyourgroups)){
		if ($resultyourgroups->num_rows > 0)  {
		while($rowyourgroups = mysqli_fetch_assoc($resultyourgroups)) {
			$gid=$rowyourgroups["gid"];
			$gname=$rowyourgroups["gname"];
			
 ?>  			<tr>
		        <td align="center">
				<?php
				echo $rowyourgroups["gname"];
				?>
				</td>
				
				<td align="center">
				  
				<?php
				echo $rowyourgroups["gdescription"];
				?>
                </td>
				<td>
				<?php
				echo $rowyourgroups["creator"];
				?>
				</td>
				
                <td align="center">
				<a href="eventgroup.php?gid=<?php echo $gid?>"><div class="button"><h4 style="color:#A52A2A; padding:5px">
				Events
				</h4>
				</div></a>
				</td>
				<td align="center">
				<a href="displaymembers.php?gid=<?php echo $gid?>"><div class="button"><h4 style="color:#A52A2A; padding:5px">
				Members
				</h4>
				</div></a>
				</td>
				
				<td align="center">
				<a href="leavegroup.php?gid=<?php echo $gid?>&uid=<?php echo $uid ?>"><div class="button"><h4 style="color:#A52A2A; padding:5px">
				Leave
				</h4>
				</div></a>
				</td>
				
            </tr>
			
		<?php
			}
		}
		}
		else
		{
			echo "0 results";
		}
		?>
	
        </tbody>
    </table>
	</fieldset>
	</div>
</div>
</div>
<hr>

	<div class="col-2" id="test" style="height: 100%;  margin-left: 550px; width: 30%;  background-color: #f8f8f8; position: absolute">
<div class="title" align="center"><h2 align="center" > Join New Groups</h2></div>
<br>
	<div class="datatablediv" style="">

<fieldset>
<table id="members" class="display" cellspacing="0" width="100%">
        <thead>
				<th>Group</th>
				<th align="center">Description</th>				
				<th>RSVP</th>
				<!--
				<th>Location</th>
				<th>RSVP</th>-->
            </tr>
        </thead>
		  <tbody>
		
 <?php


 $sql = "SELECT gid,gname,gdescription from cooking_group where 1";
 //not in (select gid from group_members where uid=$uid)
 //, recipe_photo.photo as photo from review natural join recipe_photo where photoid=1
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$flag=1;
			$gid=$row["gid"];
			$gname=$row["gname"];
			$description=$row["gdescription"];
			
			$sql_check_not_registered="select gid,uid from group_members where gid=$gid and uid='$uid'";
			$result_check_not_regestered = mysqli_query($conn, $sql_check_not_registered);
			if (mysqli_num_rows($result_check_not_regestered) > 0)
			{
				$flag=0;
			}
			if($flag==1)
			{
 ?>  			<tr>
		        <td align="center">
				<?php
				echo $gname;
				?>
				</td>
				
				<td align="center">
				  
				<?php
				echo $description;
				?>
                </td>
				
                <td align="center">
				<a href="joingroup.php?gid=<?php echo $gid?>&uid=<?php echo $uid?>"><div class="button"><h4 style="color:#A52A2A; padding:5px">
				JOIN
				</h4>
				</div></a>
				</td>
				
            </tr>
			
		<?php
			}
		}
	}
		?>
	
        </tbody>
    </table>
	</fieldset>
	
	
</div>
	
	
	</div>
	

<?php


 
?>
	
	
	
	
	
	
	</div>
	</body>
	<script>
		$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true
    } );
	$('#members').DataTable( {
        responsive: true
    } );
} );
	</script>
	
</html>