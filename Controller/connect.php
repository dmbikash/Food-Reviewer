<?php



class Database
{
	private $host="localhost";
	private $username= "root";
	private $password="";
	private $db="mybook_db";

	function connect()
	{
		$connection=mysqli_connect($this->host,$this->username,$this->password,$this->db);
		return $connection;

	}
	function read($query)
	{
		$conn=$this->connect();
		$result=mysqli_query($conn,$query);
		if($result==false)
		{
			return false;
		}
		else
		{
			$data=false;
			while($row=mysqli_fetch_assoc($result))
			{


				$data[]=$row;
				
			}
			return $data;

		}

	}
	function save($query)
	{
		$conn=$this->connect();
		//echo 'kireeee';
		$result=mysqli_query($conn,$query);

		if(!$result)
		{
			return false;
		}
		else
		{
			echo 'data base connected';
			return true;
			
		}

	}

}

	




//$first_name="DM ";
//$last_name="Bikash";

//$query = "insert into users (first_name,last_name) values ('$first_name','$last_name')";
//echo $query;
//mysqli_query($connection,$query);
//echo mysqli_error($connection);

//$result=mysqli_query($connection,$query);



//$db->save();











  ?>