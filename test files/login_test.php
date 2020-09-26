<?php



class Login
{
	private $error="";
	
	public function evaluate($data)

	{
		
		$email=addsLashes($data['email']);
		//a= 'mama's boy'(example)
		$password=addsLashes($data["password"]);


		
		$query = "select * from users where email = '$email' limit 1";
		#return $query;
		//echo $query;     //(to see if everything is okay)
		//echo"hiii";
		$DB= new Database();
		//echo"hiii";
		$result=$DB->read($query);
		if ($result)
		{
			$row = $result[0];
			if ($password == $row ['password']) 
			{
				//create session# code...
				 $_SESSION ['mybook_userid'] = $row['userid'];

				//its an associative array...canbe searched by word. by this we can send info over pages. to avoid collision better to give prefix befaore var name

			}
			else
			{
				  $this->error=$this->error . "wrong password<br>";#better to give same message for mail and pass for security
			}

		}
		else
			{
				 $this->error=$this->error . "no email was found <br>";
			}
		
		
		return $this->error;
		

	}
	public function check_login($id)//this function checks if the user id exist to db
	{
		if(  is_numeric($id))

		{


				$query = "select * from users where userid = '$id' limit 1 ";
			
				$DB= new Database();
			
				$result=$DB->read($query);
				
				if ($result)
				{
					$user_data=$result[0] ;
					return $user_data;
				}
				else
				{
					header("Location: login.php");
					die;
				}
			
		}
		else
		{
			header("Location: login.php");
			die;

		}

	}







}



?>
