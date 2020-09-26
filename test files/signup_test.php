<?php 

class Signup 
{
	private $error="";
	public function evaluate($data)
	{
		foreach ($data as $key => $value) 
			{
			# here checking if user missed an signup option
				if (empty($value)) 
					{
						$this->error = $this->error . $key . " is empty! <br/>"; 	// code...
					} 
				if ($key=='email')
					{
						if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value ))//the value is email in array...(for each loop)
							{
								$this->error = $this->error . " Invalid Email Address!<br/>" ;

							}

					}
				if ($key=='first_name')
					{
						if (is_numeric($value) )//the value is email in array...(for each loop)
							{
								$this->error = $this->error . "First Name is Invalid   ! <br/>";

							}

					}
				if ($key=='last_name')
           			{
					   if (is_numeric($value) )//the value is email in array...(for each loop)
						   {
							    $this->error = $this->error . "Last Name is Invalid   ! <br/>";

						   }

				    }

			}
		echo $this->error;	
		#user have submitted.
		if ($this->error == "") 
		{
			# error nai????
			$this->create_user($data);#user banay dao taile??

		}
		else
		{          # hae error ase...pathay dao
			return $this->error;// sending the error
		}

	}
	public function create_user($data)

	{
		$first_name=ucfirst($data['first_name']);
		$last_name=ucfirst($data['last_name']);
		$gender=$data['gender'];
		$email=$data['email'];
		$password=$data["password"];
		
		$url_address=strtolower($first_name).".".strtolower($last_name);
		$userid=$this->create_userid();
		
		





		$query = " insert into users (userid,first_name,last_name,gender,email,password,url_address) values 
		('$userid','$first_name','$last_name','$gender','$email',
		'$password','$url_address') ";
		#return $query;
		//echo $query;     //(to see if everything is okay)
		//echo"hiii";
		$DB= new Database();
		//echo"hiii";
		$DB->save($query);
	}
	/*private function create_url()
	{

	}
	*/
	private function create_userid()
	{
		$length=rand(4,10);
		#return $rand;
		$number="";
		for ($i=0; $i < $length  ; $i++) { 
			# code...
			$new_rand = rand (0,9);
			$number = $number. $new_rand;
		}
		return $number;
	
	}
		
}


 ?>