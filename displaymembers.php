<?php
session_start();
include_once("DBconnect.php");




$gid=$_GET["gid"];
//$gname=$_GET["gname"];
$firstName=$_SESSION['username'];
include_once("frontPanel.php");



?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	
	
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



<br>
<br>

<div class="col-12" STYLE="MARGIN-top: -50px">

<div class="tabs"  style="padding:10px; margin-left: 0px; height:1000px; width: 13%; background-color: #f8f8f8">
	
	<div class="links" style="width: 150%;  margin-left: -10px; margin-top: -10px; height: 20px; background-color:#f8f8f8">
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#f8f8f8; margin-top:-12px; border-radius:5px">
	<h3 align="center" style="padding:10px;color:grey"> QUICK LINKS</h3>
	</div>
	
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="displaygroups.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> BACK</h3></a>
	</div>
	
		
	<div class="links" style="width:100%; height: 50px; background-color:#A52A2A; margin-top: -5px; border-radius:5px">
	<a href="index.php" style="text-decoration: none; color:white"><h3 align="center" style="padding:10px"> HOME</h3></a>
	</div>
	
	
	
	
	
</div>
	
	

<div class="row" id="test" style="padding-bottom:10px; margin-left: 180px; width: 100%; background-color: #f8f8f8; margin-top: -1000px">
<div class="col-6" id="test" style=" background-color: #f8f8f8">
<div class="title"><h2 STYLE="margin-left:100PX"> <?PHP echo $gid." "?> MEMBER LIST</h2></div>
<div class="datatablediv" style="width: 600px; margin-left:0px;">


<fieldset> 
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
				<th>uid</th>
				<th>First Name</th>
				<th>Last Name</th>
			
            </tr>
        </thead>
		  <tbody>
		
 <?php


		$sqlyourgroups = "SELECT uid, firstName,LastName from  group_members natural join user where gid=$gid";
 //natural join group_members where $uid='$uid'
		$resultyourgroups = mysqli_query($conn, $sqlyourgroups);

		if (mysqli_num_rows($resultyourgroups) > 0) {
		while($rowyourgroups = mysqli_fetch_assoc($resultyourgroups)) {
			
			
 ?>  			<tr>
		        <td align="center">
				<?php
				echo $rowyourgroups["uid"];
				?>
				</td>
				
				<td align="center">
				  
				<?php
				echo $rowyourgroups["firstName"];
				?>
                </td>
				<td>
                <?php
				echo $rowyourgroups["LastName"];
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