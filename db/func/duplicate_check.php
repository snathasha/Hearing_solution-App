<?php

	function emailExistenceCheck($email)
	{
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM users WHERE email='$email'");
		
		if($query->num_rows != 0)
			return 1;
		else
			return 0;
	}
?>