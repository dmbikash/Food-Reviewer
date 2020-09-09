


<div id="post" style="//background-color: green;//width:400px">
								<!--poster man icon-->
	 <div style="background-color: #EDFFE6;//background-color: grey"> 

	 	<?php
	 		$image = "";
	 		if($ROW_USER['gender']=='Male')
	 		{
	 			$image='user_image/male.jpg';
	 		}
	 		else
	 		{
	 			$image='user_image/female.png';
	 		}
	 		if($ROW_USER['profile_image'])
	 		{
	 			$image='user_image/male.jpg';
	 		}
	 		if (file_exists($ROW_USER['profile_image']))
	 		 {
	 			$image =$image_class->get_thumb_profile( $ROW_USER['profile_image']);
	 		}
	 		


	 	?>

<!--row is post//row user sre users-->

		<img src="<?php echo $image ?>" style="width: 70px;margin-right: 4px">
	 </div>
	<!--postest message-->
	<div style="background-color: #EDFFE6;//background-color: blue;width:600px;//margin-top: 40px;">

			<div style="//background-color: grey; color:black;font-weight: bold; width:300px;text-align: left;">

				<?php  
					echo htmlspecialchars($ROW_USER['first_name'] )." ". htmlspecialchars($ROW_USER['last_name'] ) ;//   post owalar first name last name

					if ($ROW['is_profile_image']) //row is post//row user sre users
					{
						$pronoun='his';
						if ($ROW_USER['gender'] == 'Female') 
						{
							$pronoun='her';
						}
						
						echo "<span style='color:grey;font-weight: normal;'> updated $pronoun profile image</span>" ;
					}
					if ($ROW['is_cover_image']) //row is post//row user sre users
					{
						$pronoun='his';
						if ($ROW_USER['gender'] == 'Female') 
						{
							$pronoun='her';
						}
						
						echo "<span style='color:grey;font-weight: normal;'> updated $pronoun cover image</span>" ;
					}
					
				?>


				
			</div>
				

			<p align="left"><?php  echo htmlspecialchars( $ROW['post']) ?></p>

			<br><br>
			<?php
				if (file_exists($ROW['image'])) 
				{
				 	$post_image = $image_class->get_thumb_post($ROW['image']) ;
				 	echo "<img src='$post_image' style='width:80%;'>";
				 } 


			 ?>


			<br>
			<span style="float: left;">
			<!-- <a href="" style='text-decoration: none;'> like </a> . <a href="" style='text-decoration: none;'> comment </a> -->  
			</span> 
			<span>
				<?php
					echo $ROW['date'];
				?>
			</span>
			<!--
			<span style="float: right;text-decoration:none;">
				Edit . Delete
				

				
			</span>

		-->


	
	</div>

<!--user 1 ends-->			
</div>