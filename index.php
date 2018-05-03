<?php
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']!='')
{
header('Location: logout.php');
}else{
  include('login.php');
  include('register.php');
}
?>

<!doctype html>

<html>
<head>
<style>
body{
    background:url('images/background.jpg');
    padding:2px;
}

</style>
<meta charset="utf-8">
<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Foodie</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	 
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


<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<div class="col-sm-offset-2 col-sm-4">
<body>
<div >
<form class="form-group" method="post" action="index.php">
<label>Already a user? Sign in</label><br>
<input class="form-group" required='true' type="text" name="username" placeholder="User Name" /><br>
<input class="form-group" required='true' type="password" name="password" placeholder="Password" />  <br>
<input class="btn-primary" type="submit" name="dologin" value="Sign In" /> 
</form>
<div class="form-group"><br/></div>
<div class="form-group"><br/></div>
<div class="form-group"><br/></div>
</div>
</div>

<body>
<div >
<form class="form-group" method="post" action="index.php">
<label>New User Register here</label><br>
<input class="form-group" required='true' type="text" name="firstname" placeholder="First Name" />
<input  type="text" required='true' name="lastname" placeholder="Last Name" /><br>
<input class="form-group" required='true' type="email" name="email" placeholder="Email" />  <br>
<input class="form-group" required='true' type="text" name="username" placeholder="Username" />  <br>
<input type="password" required='true' name="pass" placeholder="Password" />
<input type="password" required='true' name="pass2" placeholder="Confirm Password" /><br/>

<br>
<input class="btn-primary" type="submit" name="Signup" value="Sign up" /> <br>

</form>

</div>
</div>
<div class="alert alert-warning" ><?php echo $error;?></div>

</body>
</html>
