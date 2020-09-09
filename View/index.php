<?php

//session_start();
//print_r($_SESSION);
//unset($_SESSION['mybook_userid']);
include("classes/autoload.php");



//isset($_SESSION["mybook_userid"]);

$login=new Login();
$user_data=$login->check_login( $_SESSION["mybook_userid"] ); 



  if ($_SERVER['REQUEST_METHOD']=='POST')//server ki koso kisu post korar jonne request diyeche?

    {
	  	 //var_dump($_FILES);
	  	 $post= new Post();// include korso to vaiya???class take??? :-)
	  	 $id=$_SESSION['mybook_userid'];
	  	 $result = $post->create_post($id,$_POST,$_FILES);//session e useer id chech kortesi
	  	 										// POST method je deta post korte bolse oita parameter hishebe dichhi
	  	 //print_r($_POST);//test
	  	 
	  	 if($result=="")
	  	 {
	  	 	header("Location: profile.php");
	  	 	die;
	  	 }
	  	 else
	  	 {
	  		echo " <div style='text-align:center ; font-size:15px; color:black ; background-color:red ' > " ;
	  		echo "<br> The following error occurred: ";
	  	 	//echo "<br>";
	  	 	//$result = "=>" . "$result" . "<br>";
	  	 	echo $result;
	  	 	//echo "<br>";
			echo "</div>";
	  	 }

    }




?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<style type="text/css">
		#orange_bar
		{
			height: 60px;
			background-color: #64C1CF;
			color: black;
			margin-top: 10px;
			//border:solid 3px black;
			border-radius: 5px;

		}
		#search_box
		{
			width: 400px;
			height:23px;
			padding-left: 20px;
			border-radius: 5px;
			border:none;
			padding: 4px;
			font-size:20px;

			background-image: url(asd.png);
			background-repeat: no-repeat;
			background-position: right;
			background-color: #B6E8EA;

		}
		#body
		{
			font-family: tahoma;
			background-color: #EDFFE6;
		}
		#cover_content
		{
			width: 800px;
			margin: auto;
			margin-top: 10px;
			text-align: center;
			font-weight: 5px;
			padding-bottom: 20px;
			//background-color:#64C1CF;
			min-height: 400px;
			//border:solid 3px  black;
		}
		#cover_pic
		{
			width:800px;
			padding-bottom:30px;

			
		}
		#pro_pic
		{
			width:200px;
			margin-top: 20px;
			//height: 150px;
			
			border:solid 5px black;
			//border-color: #88C57A
			
			

		}
		#menu_button
		{
			width: 100px;
			//background:yellow;
			display: inline-block;
			margin: 2px;
		}
		#friends_image
		{
			width: 75px;
			float: left;
			margin: 8px;
		}
		#friends_bar
		{
			background-color: white;
			min-height: 400px;
			margin-top:20px;
			color: #aaa;
			padding:8px;
			font-size: 15px;

		}
		#friends
		{
			clear: both;

		}
		textarea                                
	{
			width:100%; //<!-- if u give # it looks for id and if u give no hash it looks for elements--> and also in style section comment
			               // does nott work like html...   :-);
			border:none;
			font:tahoma;
			color: black;
			//min-height: 60px;
			
		}
		#post_bar
		{
			margin-top: 20px;
			padding: 10px;

		}
		#post
		{
			padding: 4px;
			display: flex;
			font-size: 13px;
			
		}

	</style>
	<body id="body">
		<?php  
			include('header.php');
		?>



		<!--cover area and pro pic-->
		<div id="cover_content" style="//background-color: yellow">
				
				<!--below the cover are-->
				<div style="// background-color: lightblue; display: flex;">
					<!-- friends area-->
<!-- pro pic area-->
					<div style="//background-color:#B2F02D;min-height: 400px;flex:1;font-size: 25px;font-family:tahoma">
						<div id="pro_pic"> <!--other friends...........-->
							<?php  
							$image="user_image/male.jpg";
							if ($user_data['gender'] == 'female') 
							{
								$image="user_image/female.png";
							}
							if (file_exists($user_data['profile_image'])) 
							{
								$image=$image_class->get_thumb_profile( $user_data['profile_image'] );
							}


						?>
							
						<a href="profile.php" style="text-decoration: none;"><img src="<?php echo $image ?>" id="pro_pic" style ="border-radius:50%;width:180px;

						border:0px;"></a> <br>
					     <a href="profile.php" style="color: black;text-decoration: none;">
					     	<?php
					     	echo $user_data['first_name'].'<br> '.$user_data['last_name'];
					     	?>
					     		
					     	</a> 	
							
						</div>
						
					</div>
				<!--post area-->
					<div style="//background-color: orange;min-height:400px;flex: 2.5;padding: 20px;padding-right: 0px;">
						<div style="border:solid thin #aaa ;//do not remove this;background-color: white;padding: 10px;height:47px">
							
<!--the writting box-->		<form method="post" enctype="multipart/form-data">
								
							
<!--name for the vaiable-->
<!--that contains the strings-->	<textarea name="post" placeholder="Whats in ur mind" style="background-color:#8ED2B8 "></textarea>
								    
								    <input type="file" name="file"  style="float:left" style="background-color:black;//color: white;" >
								    <input type="submit"  value="post" style="float: right">
								    <br>
						    </form>

						</div>
						<!--post bar-->


<!--whole chat starts-->	<div id="post_bar"style="background-color: white">
								
								
								<?php 
								//var_dump($posts);//checks data type
								$DB= new Database();
								$query="select * from posts order by id  desc ";
								$result=$DB->read($query);
								$posts=$result;


								if($posts)
								{
									foreach ($posts as  $ROW) 
									{   //here we dont need key.key is number. we are getting row
										$user=new User();
										$ROW_USER = $user->get_user($ROW['userid']);
										include("post.php");
										//echo "<span>________________________________________</span>";

									}
								}
								
									

								?>
								
								
								
									

								


						</div>


					</div>

					
					
				</div>

			
		</div>

	</body>
</html>