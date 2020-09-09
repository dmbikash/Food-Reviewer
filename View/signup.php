<?php 
	
	include("classes/connect.php");
	include("classes/signup.php");

	$first_name="";
	$last_name="";
	$email="";
	$gender="";





	if ($_SERVER['REQUEST_METHOD'] =='POST') 
	{
		$signup= new Signup();
		$result=$signup->evaluate($_POST);

		if($result != "")
		{
			echo "<div style='text-align:center; font-size:12px;color:white;background-color:grey'> ";

			echo"The following erroes occur";
			echo $result;
			echo"</div>";
		}
		else
		{
			#redirect always have to be done before html..php doesnot allow that,,js do
			header("Location: login.php");
			die;


		}
		$first_name=$_POST["first_name"];
		$last_name=$_POST["last_name"];
		$email=$_POST["email"];
		$gender=$_POST["gender"];
		

		
	}



	

 ?>	

	<htmL>

		<head>
			<title>Mybook > Signup Page</title>


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
			#signup_form
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
				
				border-color: #760808;
				padding-left: 10px;
			}
			#gender
			{
				float: left;
				padding-left: 250px;

			}
			#gender_box
			{
				width: 300px;
				height:35px;
				border-radius: 4px;
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
				<div style="font-size: 40px;">Mybook</div>
				<div id= "signup_button"><a href="login.php" style="text-decoration:none;color:black; ">Login</a></div>
			</div> 

			<div id="signup_Form">
				Sign up to MYbook
				<br><br>
				<form method="post" action="">
					
				

				<input value="<?php echo $first_name ?>" name="first_name" type="text" id="user_name" placeholder="First Name"> <br><br>
				<input value="<?php echo $last_name ?>" name="last_name" type="text" id="user_name" placeholder="Last Name"> <br>
				<div id="gender">
					Gender:
				</div>
				<br>
				
				<select id="gender_box" name="gender">
					<option> <?php echo $gender  ?> </option>
					<option>Male</option>
					<option>Female</option>
					<option>Other</option>

					
				</select> <br><br>

				<input value="<?php echo $email  ?>" name="email" type="text" id="user_name" placeholder="Email"> <br><br>
				
				<input name="password" type="password" id="pass" placeholder="password"> <br><br>
			
				<input name="password2" type="password" id="pass" placeholder="Retype Password"> <br><br>
				
				
				<input  type="submit" id="submit_button" value="Submit"> <br><br>
			    </form>
				
			</div>
		</body>


	</htmL>