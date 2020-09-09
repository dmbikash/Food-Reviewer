

<?php 
	session_start();
	include("classes/connect.php");
	include("classes/login.php");
		
	
	$email="";
	$password="";





	if ($_SERVER['REQUEST_METHOD'] =='POST') 
	{
		$login= new Login();
		$result=$login->evaluate($_POST);

		if($result !="")
		{
			echo "<div style='text-align:center; font-size:12px;color:white;background-color:grey'> ";

			echo"The following erroes occur <br>";
			echo $result;
			echo"hi";
			echo"</div>";
		}
		else
		{
			#redirect always have to be done before html..php doesnot allow that,,js do
			header("Location: profile.php");
			die;


		}
		$email=$_POST["email"];
		$password=$_POST["password"];
		
		

		
	}




	

 ?>	




<htmL>

	<head>
		<title>Food Reviewer > Login</title>


	</head>
	<style>
		#body
		{
			font-family: tahoma;
			background-color:#B6E8EA;
		}
		#Bar
		{	
			height:100px;
			background-color: #64C1CF;
			color:white;
			font-size: 40px;
			padding:4px;
		}
		#signup_button
		{
			color: black;
			background-color: #29BE96;
			font-size: 15;
			width: 60;
			text-align: center;
			padding: 4px;
			border-radius: 4px;
			float: right;
		}
		#login_form
		{
			background-color: #EDFFE6;
			width: 800px;
			height:auto;
			margin: auto;
			margin-top:20px;
			padding:10px;
			padding-top:50; 
			padding-bottom: 30px;
			text-align: center;
			font-size: 25px;

		}
		#user_name ,#pass
		{ 
			width: 300px;
			height:35px;
			//border:solid 1px;
			border-radius: 4px;
			color: black;
			
			border-color: #760808;
			padding-left: 10px;
		}
		#submit_button
		{
			background-color:#CDF578;
			width: 100px;
			height:35px;
			border-radius: 4px;
			font-size: 18px;
		
	</style>
	<body id="body">
        <div id="Bar">                             
			
			<div style="font-size: 40px;">Food Reviewer</div>
			
			<div id= "signup_button"><a href="signup.php" style="text-decoration: none;color: black ">Signup</a></div> 
		</div> 

		<div id="login_form">
			<form method="post">
				
			
				Login Here
				<br><br>
				<input name="email" value="<?php echo $email  ?>" type="text" id="user_name" placeholder="Email">
				<br><br>
				<input name ="password" value="<?php echo $password  ?>" type="text" id="pass" placeholder="password">
				<br><br>
				
				<input type="submit" id="submit_button" value="Log In">

			</form>
		</div>
	</body>


</htmL>