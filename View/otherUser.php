


<div id="friends"style="//background-color: red" >
	<?php
	 		$image = "";
	 		if($FRIEND_ROW['gender']=='Male')
	 		{
	 			$image='user_image/male.jpg';
	 		}
	 		else
	 		{
	 			$image='user_image/female.png';
	 		}
	 		if($FRIEND_ROW['profile_image'])
	 		{
	 			$image='user_image/male.jpg';
	 		}
	 		if (file_exists($FRIEND_ROW['profile_image']))
	 		 {
	 			$image =$image_class->get_thumb_profile( $FRIEND_ROW['profile_image']);
	 		}
	 		


	 	?>

	


			

			


			<br>
			
			<?php
				
				echo "<a href='friends_profile.php?id=$FRIEND_ROW[userid]' style='text-decoration:none;color:black;'>";


				echo "<img src='$image' style='width:80px;border-radius:5px;''>";
				echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'];
				
				echo '<br>';
				echo '<br>';
				

				echo "</a>";
			?>
		

</div>
			<!-- 1st user end -->