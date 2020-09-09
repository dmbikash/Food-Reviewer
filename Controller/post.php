<?php

class Post
{
	private $error="";
	public function create_post($userid, $data, $files)
	{
		if ( !empty($data['post']) || !empty( $files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image'])  ) 

		{	
			//echo $data['post'];
			//echo 'lalal';
			$myimage          = "" ; 
			$has_image		  = 0  ;
			$is_cover_image   = 0  ;
			$is_profile_image = 0  ;



			if ( isset($data['is_profile_image']) || isset($data['is_cover_image'])) 
			{
				$myimage          = $files;
				$has_image        = 1;
				
				if(isset($data['is_cover_image']))
				{
				    $is_cover_image   = 1;
				}

				if (isset($data['is_profile_image'])) 
				{
					$is_profile_image = 1;
				
				}
				

			}
			else
			{
					if (!empty($files['file']['name'])) 
					{
				
				        $folder = "uploads/".$userid . "/";
    			 		//create folder
    			 		if(!file_exists($folder))
    			 		{
    			 			mkdir($folder,0777,true); //make directory
    			 		}
						
						$image_class = new Image();


			    		$myimage =$folder . $image_class->generate_filename(15) . '.jpg';

			    		move_uploaded_file($_FILES['file']['tmp_name'], $myimage);
			    		$image_class->resize_image($myimage,$myimage,1500,1500);


				
			            $has_image=1;

					}

			}

			

			$post="";
			if (isset($data['post'])) 
			{
				$post = addsLashes($data['post']);
			}
			
			$postid=$this->create_postid();
			$query=" insert into posts(userid,postid,post,image,has_image,is_profile_image,is_cover_image) values('$userid',
			'$postid','$post','$myimage','$has_image','$is_profile_image','$is_cover_image')";
			$DB=new Database();
			$DB->save($query);
		}
		else
		{
			$this->error .= '<br>' . "please type something here";
			//echo'nana';
		}
	    return $this->error;
	}
	

	private function create_postid()
	{
		$length=rand(4,10);
		#return $rand;
		$number="";
		for ($i=0; $i < $length  ; $i++) 
		{ 
			# code...
			$new_rand = rand (0,9);
			$number = $number. $new_rand;
		}
		return $number;



	}



	public function get_posts($id)
	{
		$query= "select * from posts where userid = '$id' order by id desc  limit 10  "; // accending er jonno 'asc'
		$DB=new Database();
		$result=$DB->read($query);
		if($result)
		{
			return $result;

		}
		else
		{
			return false;
		}
	}
		
}		


 ?>