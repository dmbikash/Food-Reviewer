<?php

//print_r($_SESSION);
//unset($_SESSION['mybook_userid']);
//include("classes/connect.php");
//include("classes/login.php");
//include("classes/post.php");
include("classes/autoload.php");

//isset($_SESSION["mybook_userid"]);

$login=new Login();
$user_data=$login->check_login( $_SESSION["mybook_userid"] ); 

//echo"<pre>";
//print_r($_GET);
//echo "</pre>";

if ($_SERVER['REQUEST_METHOD']=="POST")//server ki koso kisu post korar jonne request diyeche?

    {
    	//echo"<pre>";
    	//print_r($_POST);
    	//print_r($_FILES);
    	//echo "</pre>";

    	if(isset($_FILES['file']['name'])  &&  $_FILES['file']['name'] !="")

    	{
    		//echo "<pre>";
            //print_r($_FILES);
            //echo "</pre>";
    		//die; 

    		$size =(1024*1024) * 10; // 10 mb


    		if($_FILES['file']['type'] == "image/jpeg")
    		{
    			if ($_FILES['file']['size'] < $size)
    			 {
    				// everything is good
    			 		$folder = "uploads/". $user_data['userid'] . "/";
    			 		//create folder
    			 		if(!file_exists($folder))
    			 		{
    			 			mkdir($folder,0777,true); //make directory
    			 		}
						
						$image = new Image();


			    		$filename =$folder . $image->generate_filename(15) . '.jpg';

			    		move_uploaded_file($_FILES['file']['tmp_name'], $filename);

			    			// check for mode

			    			$change='profile';
			    			
			    			if (isset($_GET['change'])) 
			    			{
			    			   $change =$_GET['change'];
			    			}




			    		
			    		if ($change == 'cover') 
			    		{
			    			if (file_exists($user_data['cover_image'])) 
			    			{
			    				unlink($user_data['cover_image']);
			    			}
			    			$image->resize_image($filename,$filename,1500,1500);
			    		}
			    		else
			    		{
			    			if (file_exists($user_data['profile_image'])) 
			    			{
			    				unlink($user_data['profile_image']);
			    			}
			    			$image->resize_image($filename,$filename,1500,1500);
			    		}

			    		
			    		



			    		if (file_exists($filename)) 
			    		{
			    			$userid = $user_data['userid'];


			    			if ($change == 'cover') {
			    				$query = "update users set cover_image = '$filename' where userid = '$userid'  limit 1 ";
			    				$_POST['is_cover_image'] = 1;
			    			}
			    			else
			    			{
			    				$query = "update users set profile_image = '$filename' where userid = '$userid'  limit 1 ";
			    				$_POST['is_profile_image'] = 1;
			    			}

			    			}

			    			

			    			$DB= new Database();
			    			$DB->save($query);

			    			// create a post
			    			 $post= new Post();

			    			 
							$post->create_post($userid,$_POST,$filename);


			    			header(("Location: profile.php"));
			    			die;
			    		}
			    		else
	    				{

		  					echo " <div style='text-align:center ; font-size:15px; color:black ; background-color:red ' > " ;
		  					echo "<br> The following error occur";
		  	 				echo "PLease add A valid image";
		  					echo "</div>";
		  	 
	    				}



    			}
    			else/////////////////
    			{
    				echo " <div style='text-align:center ; font-size:15px; color:black ; background-color:orange;' > " ;
			  		echo "<br> The following error occur";
			  	 	echo "IMage beow 10 mb is acccepable";
			  		echo "</div>";
    			}

    		}
    		else
    		{
    			echo " <div style='text-align:center ; font-size:15px; color:black ; background-color:red ' > " ;
		  		echo "<br> The following error occur";
		  	 	echo "only JPEG format is acccepable";
		  		echo "</div>";

    		}



    	}
    	

    	

 


?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Change Profile | Mybook</title>
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
				<div style=" background-color: lightblue; min-height: 500px;margin-top: 100px;min-width: 800px ">
					

	<!-- 				<div style="//background-color:#B2F02D;min-height: 400px;font-size: 70px;width: 400px;margin-top: 100px"> -->
<!-- profile picture select ioption -->

					<form method="post" enctype="multipart/form-data"><!--deault type of taking pic/sending file...........-->
						<div id="pro_pic" style="//background-color: black;"> 
							
								<input type="file" name="file"> 

								<input type="submit" value="CHANGE NOW">
								<br><br>
								<div style="text-align: center;margin-top: 40px;">
									<?php 
									
				    			
					    			if (isset($_GET['change']) &&  $_GET['change']=='cover') 
					    			{
					    			   $change ='cover';
					    			   echo "<img src='$user_data[cover_image]' style='max-width:500px;'>" ;
					    			}
					    			else
					    			{
					    				echo "<img src='$user_data[profile_image]' style='max-width:500px;'>" ;
					    			}

									


									?>	
								</div>
							
						</div>
					</form>		
						
		<!--			</div>-->
				<!--post area-->
					
					
					
				</div>

			
		</div>

	</body>
</html>