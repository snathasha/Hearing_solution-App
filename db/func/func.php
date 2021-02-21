<?php

	function signup($fname, $lname, $email, $pwd)
	{
		global $mysql_connect;
		$pwd = md5($pwd);
		$user_id = userIDGenerator();
		mysqli_query($mysql_connect, "INSERT INTO users SET user_id='$user_id', first_name='$fname', last_name='$lname', email='$email', pwd='$pwd', date_time=NOW()");
	}
	
	function login($lemail, $lpwd)
	{
		global $mysql_connect;
		
		$lpwd = md5($lpwd);
		
		$query = mysqli_query($mysql_connect, "SELECT * FROM users WHERE email='$lemail' AND pwd='$lpwd'");
		
		if($query->num_rows != 0)
			return 1;
		else
			return 0;
	}
	
	function getAudienceIPAddress()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			//ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			//ip pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
?>