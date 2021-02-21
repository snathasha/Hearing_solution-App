<?php
	
	define('Login', TRUE);
	define('Signup', TRUE);
	define('About', TRUE);
	define('HowItWorks', TRUE);
	
	require_once('db/init.php');
	session_start();
	
	$pg=@$_GET['pg'];
	
	function base()
	{
		return str_replace("index.php","",$_SERVER['PHP_SELF']);
	}
	
	if(!isset($_SESSION['user_key']) && !isset($_SESSION['audience_key']))
	{
	
		if($pg == "home" || $pg == "")
		{
			include('home.php');
		}
		else if($pg == "signup")
		{
			include('signup.php');
		}
		else if($pg == "login")
		{
			include('login.php');
		}
		else if($pg == "enter_session")
		{
			include('enter_session.php');
		}
		else if($pg == "about")
		{
			include('about.php');
		}
		else if($pg == "howitworks")
		{
			include('howitworks.php');
		}
		else
		{
			include('home.php');
		}
	}
	else if(isset($_SESSION['user_key']))
	{
		if($pg == "" || $pg == "dashboard" || $pg == "home")
		{
			include('users/dashboard.php');
		}
		else if($pg == "live_session")
		{
			include('users/live_session.php');
		}
		else if($pg == "session_result")
		{
			include('users/session_result.php');
		}
		else if($pg == "view_history")
		{
			include('users/view_history.php');
		}
		else if($pg == "logout")
		{
			include('users/logout.php');
		}
	}
	else if(isset($_SESSION['audience_key']))
	{
		if($pg == "" || $pg == "session_room")
		{
			include('audience/session_room.php');
		}
		else if($pg == "live_session_room")
		{
			include('audience/live_session_room.php');
		}
		else if($pg == "logout")
		{
			include('audience/logout.php');
		}
	}
?>