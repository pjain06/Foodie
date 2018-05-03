<!DOCTYPE HTML> 
<html>
<body>
<?php
session_start();
session_unset();
session_destroy();

header("Location: index.php");
$_SESSION = array();
?>
</body>
</html>