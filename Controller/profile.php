<?php
class Profile
{
	public function get_profile($id)
	{
		$idd=addslashes($id);
		$DB= new Database();
		$query = "select * from users where userid ='$idd' limit 1";
		//echo $query;
		return $DB->read($query);


	}
}

?>