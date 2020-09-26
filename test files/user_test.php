<?php

class User
{
	public function get_data( $id )
	{
		$query= "select * from users where userid = '$id'   limit 1";
		$DB = new Database();
		$result= $DB->read($query);// tjis method returns a array and it is stored in $result 
		if($result)
		{
			$row=$result[0];
			return $row;
		}
		else
		{
			return false;
		}
	}
	public function get_user($id)
	{
		$query="select * from users where userid = '$id' limit 1  ";
		$DB=new Database();
		$result = $DB->read($query);//returns a array
		if($result)
		{
			return $result[0];
		}
		else
		{
			return false;
		}
	}
	public function get_friends($id)
	{
		$query= "select * from users where userid != '$id' ";
		$DB = new Database();
		$result= $DB->read($query);// tjis method returns a array and it is stored in $result 
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