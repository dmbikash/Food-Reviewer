<?php

include ('classes/autoload.php');

class Login_test
{
	private $error="";
	
	public function evaluate_test($data)

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
			echo 'working ';
		}
		else
			{
				 echo 'not working ';
			}
		
		
		
		

	}
	public function check_login_test($id)//this function checks if the user id exist to db
	{
		if(  is_numeric($id))

		{


				$query = "select * from users where userid = '$id' limit 1 ";
			
				$DB= new Database();
			
				$result=$DB->read($query);
				
				if ($result)
				{
					echo"working";
				}
				else
				{
					echo"not working";
				}
			
		}
		else
		{
			echo"somthing wrong";

		}

	}







}



?>
