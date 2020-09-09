<?php  
session_start();
unset($_SESSION["mybook_userid"]);

header("Location: login.php");
die;
// to remove redundency u can also do the following code
//
//session_start();

//if (isset($_SESSION['mybook_userid'])) 
//{
//	$_SESSION['mybook_userid']= NULL;
//	unset($_SESSION["mybook_userid"]);
//	# code...
//}


//header("Location: login.php");
//die;
//
//
//
?>