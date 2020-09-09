<!-- top bar-->
<?php
$corner_image = 'user_image/male.jpg';
if (isset($user_data)) 
{
	$image_class = new Image();
	
	$corner_image =$image_class->get_thumb_profile( $user_data['profile_image'] );
	
	
	if ($user_data['profile_image'] == "") 
	{
		$corner_image = 'user_image/male.jpg';
	}
}
?>


		<div id="orange_bar" style="//background-color: green">

			<div style="margin: auto;width: 800px;font-size: 30px;padding-top: 5px;//background-color: red">
				 <a href="index.php"  style="color: black;text-decoration: none;">
				 	Food Reviewer
				 </a>
				 &nbsp   <!.................................................none breakable space>
				<input type="text" placeholder="Search for people" id="search_box">
<!--corner pic-->
				<a href="profile.php"><img src="<?php echo"$corner_image"  ?>" style="width:50px;border-radius: 5px;height:50px;  float: right;"></a>
				

				<a href="logout.php"> 
					<span style="font-size: 11px;float: right;margin: 10px;color: black">
						logout       

					</span>
				</a>	
				
				   <!-- this is how to link a button by html-->

					
					<!--........ div creates new line...span doesnot...span works in the same line-- >
				

			</div>
			
		</div>