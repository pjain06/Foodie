<?php
 ob_start();
 // $error ='';
 // if( isset($_SESSION['uid'])!="" ){
  // //header("Location: index.php");
 // }
 include_once 'dbconnect.php';

 if ( isset($_POST['Signup']) ) {

  // clean user inputs to prevent sql injections
  $firstname = trim($_POST['firstname']);
  $lastname = trim($_POST['lastname']);
  $firstname = strip_tags($firstname);
 $firstname = htmlspecialchars($firstname);
  $lastname = htmlspecialchars($lastname);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $username = trim($_POST['username']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  $pass2 = trim($_POST['pass2']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);
  
  
  
  // basic name validation
  if (empty($firstname)|| empty($lastname)) {
   $error = "Please enter your full name.";
  } else if (strlen($firstname) < 3||strlen($lastname) < 3) {
   $error = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$firstname)|| !preg_match("/^[a-zA-Z ]+$/",$lastname)) {
   $error = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = "Please enter valid email address.";
  } else {
   // check user exist or not
   $query = "SELECT uid FROM user WHERE uid='$username'";
   $result = $conn->query($query);
   $count = $result->num_rows;
   if($count!=0){
    $error = "User Name is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = "Password must have atleast 6 characters.";
  }

  else if($pass!=$pass2){
	  $error = "Password do not match";
  }
  else
  {
	  $pass=md5($pass);
  }
  // if there's no error, continue to signup
  if( $error =='' ) {
   	
   $query = "INSERT INTO user(uid,firstname,lastname,uemail,password) VALUES('$username','$firstname','$lastname','$email','$pass')";
   $res = $conn->query($query);
    
   if ($res) {
	   $_SESSION['uid']=$username;
	   $_SESSION['username'] = $firstname;
	   echo "madar chod";
    $error = "success";
    $error = "Successfully registered, you may login now";
    header("location: updateProfile.php"); // Redirecting To Other Page
   } else {

    $error = "Something went wrong, try again later..."; 
   } 
  }
  
  
 }
?>

<?php ob_end_flush(); ?>