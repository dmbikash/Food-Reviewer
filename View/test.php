<?php
include("classes/autoload.php");
	
	
		$DB= new Database();
		$query="select * from posts";
		$result=$DB->read($query);
		echo'<pre>';
		print_r($result);
	  	echo'</pre>';

	  	foreach ($result as $key ) 
	  	{
	  		if($key['post'])
	  		{
	  		echo($key['post']);
	  		echo'<br>';	
	  		}
	  		if($key['image'])
	  		{
	  		echo($key['image']);
	  		echo'<br>';	
	  		}
	  	}



?>