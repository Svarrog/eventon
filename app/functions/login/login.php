<?php
	session_start();
	
	$error = "";
//if not logged in: go to login page
if ($_SESSION['loggedin'] == false) {
	header("location:../../loginform.php");
}
	include 'dbconnect.php';
	
	if (isset($_GET['function']) == "loggedin") {
	$user_username = mysql_real_escape_string($_POST['user_username']);
	$user_password = mysql_real_escape_string($_POST['user_password']);
	
	$user_username = stripslashes($user_username);
	$user_password = stripslashes($user_password);
 
	$query = "SELECT * FROM tbl_user WHERE user_username='$user_username' AND user_password='$user_password'";
	$result = mysql_query($query) or die ();
	
  if (mysql_num_rows($result)>0) {
    $_SESSION['user_id'] = mysql_result($result,0, "user_id");
    $_SESSION['user_username'] = mysql_result($result,0, "user_username");
	$_SESSION['loggedin'] = true;
	}else{
		header("location:../../loginform.php?function=error");
	} 
	
	mysql_free_result($result);
	
	if ($_SESSION["loggedin"] == true) {
	header("location:../../index.php?");
	}
	}	
?>