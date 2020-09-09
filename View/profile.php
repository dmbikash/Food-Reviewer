<?php

//print_r($_GET);


//print_r($_SESSION);
//unset($_SESSION['mybook_userid']);
include("classes/autoload.php");


//isset($_SESSION["mybook_userid"]);

$login=new Login();
$user_data=$login->check_login( $_SESSION["mybook_userid"] ); 

//bondhu der profile 

$profile = new Profile();

if (isset($_GET['id']))
 {
 	 $profile_data = $profile->get_profile($_GET['id']);

     if (is_array($profile_data)) 
	  {
		$user_data = $profile_data[0];// because..it contains a array in another array :-)  so index[0]means..taking the first array of the main array :-)
	  }

	
}

	//print_r($user_data);

// all the post code below here

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
    // all the show post code below here
    //collect the posts

    $post= new Post();
    $id=$user_data['userid'];
    $posts = $post->get_posts($id);
//collect friends
    $user= new User();
    $id=$_SESSION['mybook_userid'];
    $friends = $user->get_friends($id);



///////////////////
    $image_class = new Image();


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
			//background-color: #64C1CF;
			background-color: #2CA486;
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
			//margin-top: 10px;
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
			max-height: 600px;
			min-height: 400px;

			
		}
		#pro_pic
		{
			width:250px;
			margin-top: -200px;
			//height: 150px;
			border-radius:50%;
			border:solid 5px black;
			

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
			//background-color: white;
			background-color:#8ED2B8;
			min-height: 400px;
			margin-top:20px;
			color: black;
			width: 100px;

			padding:8px;
			font-size: 15px;
			font-family: tahoma;
			border-radius: 10px;

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
			padding-top: 10px;
			padding-left: 0px;
			padding-right: 0px;
			padding-bottom: 10px;

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
<!--cover pic sec start-->			
				<div id="cover_pic" style="//background-color: red">

					<?php  
							$image="user_image/cover_image.jpg";
							if (file_exists($user_data['cover_image'])) 
							{
								$image=$image_class->get_thumb_cover( $user_data['cover_image'] );
							}


						?>


<!--cover  pic-->
					<img src="<?php echo $image ?>" id="cover_pic">
<!--pro  pic sec start-->					
					<span >
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

<!--pro  pic-->
					<img src="<?php echo $image ?>"id="pro_pic" >  <br>
					<a href="change_profile_image.php??change=profile"  style="text-decoration: none;font-size: 18px;"> Change:  PROFILE PIC  </a>
					<a href="change_profile_image.php?change=cover"     style="text-decoration: none;font-size: 18px;">|   COVER  PIC           </a>

					</span>
					
					<br>

					<?php echo $user_data['first_name'] . " " . $user_data['last_name']."<br>" ;?>
			
					
				    <a href="index.php" style="color: black"><div id="menu_button" >Timeline </div></a>
				<!--	<div id="menu_button" > About  </div>  
					<div id="menu_button" > Friends </div>
					<div id="menu_button" >photos  </div>
					<div id="menu_button" >Settings </div>
				-->	
				</div>
				<!--below the cover are-->
				<div style="// background-color: lightblue; display: flex;">
					<!-- friends area-->
					<div style="//background-color: pink;min-height: 400px;flex:1">
						<div id="friends_bar"> <!--other friends...........-->
							Friends<br>

<!-- 1st user start-->		<?php 
								//var_dump($posts);//checks data type
								if($friends)
								{
									foreach ($friends as  $FRIEND_ROW) 
									{   //here we dont need key.key is number. we are getting row
										 //
										include("otherUser.php");
									}
								}
								
									

							?>

							
                            <!-- 2nd user-->	 
							
							<!-- 3rd user-->

							
							
						</div>
						
					</div>
				<!--post area-->
					<div style="//background-color:black; //background-color: orange;min-height:400px;flex: 2.5;padding: 20px;padding-right: 0px;">
						<div style="border:solid thin #aaa ;//do not remove this;background-color:#8ED2B8;//background-color: white;padding: 10px;height:70px">
							
<!--the writting box-->		<form method="post" enctype="multipart/form-data">
								
							
<!--name for the vaiable-->
<!--that contains the strings-->	<textarea name="post" placeholder="Whats in ur mind" style="background-color:#8ED2B8 "></textarea>
								    
								    <input type="file" name="file"  style="float:left" style="background-color:black;//color: white;" >
								    <input type="submit"  value="post" style="float: right">
								    <br>
						    </form>

						</div>
						<!--post bar-->

						
<!--whole chat starts-->	<div id="post_bar"style="background-color: #EDFFE6;//background-color: white">
								<?php 
								//var_dump($posts);//checks data type
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



				<!--post section-->  
<!--user 1 starts-->			
							</div>
<!--user 2 starts--> 
				
<!--whole chat ends--> 	</div>


					</div>

					
					
				</div>

			
		</div>

	</body>
</html>