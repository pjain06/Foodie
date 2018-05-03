<?php
//exit();
if ( !isset($_SESSION['uid']) ||$_SESSION['uid'] == '' )
{
echo "<script type='text/javascript'>alert('You need to login to view this page !')</script>";
echo '<meta http-equiv="Refresh" content="0;URL=index.php" />';
flush();
exit();
}
?>