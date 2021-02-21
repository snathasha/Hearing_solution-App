<?php

	function createAudience($session_id, $audience_id, $audience_key, $audience_ip)
	{
		global $mysql_connect;
		mysqli_query($mysql_connect, "INSERT INTO audience SET audience_id='$audience_id', audience_key='$audience_key', audience_session_room_id='$session_id', audience_ip='$audience_ip', audience_visit_status='0', audience_datetime=NOW()");
	}
	
	function checkAudienceExistence($audience_ip, $session_id)
	{
		global $mysql_connect;
		
		$query = mysqli_query($mysql_connect, "SELECT * FROM audience WHERE audience_ip='$audience_ip' AND audience_session_room_id='$session_id'");
		
		if($query->num_rows != 0)
			return 1;
		else
			return 0;
	}
	
	function checkRoomExistence($session_id)
	{
		$sessions = array();
			
		global $mysql_connect;
		
		$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE session_id='$session_id'");
			
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$sessions[] = $rows;
			}
				
			return $sessions; 
		}
		else
			return 0;
	}
	
	function generateSessionInfotoAudience($session_id)
	{
		$sessions = array();
			
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE session_id='$session_id'");
			
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$sessions[] = $rows;
			}
				
			return $sessions; 
		}
		else
			return 0;
	}
	
	function generateSessionPresenter($user_id)
	{
		$sessions = array();
			
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM users WHERE user_id='$user_id'");
			
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$sessions[] = $rows;
			}
				
			return $sessions; 
		}
		else
			return 0;
	}
	
	function getAudienceDetailsByKey($audience_key)
	{
		$audience_details = array();
		
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM audience WHERE audience_key='$audience_key'");
		
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$audience_details[] = $rows;
			}
			return $audience_details;
		}
		else
			return 0;
	}
	
	function getAudienceDetailsByIP($audience_ip)
	{
		$audience_details = array();
		
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM audience WHERE audience_ip='$audience_ip'");
		
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$audience_details[] = $rows;
			}
			return $audience_details;
		}
		else
			return 0;
	}
	
	function getAudienceDetailsBySessionandKey($live_session_id, $audience_key)
	{
		$audience_details = array();
		
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM audience WHERE audience_key='$audience_key' AND audience_session_room_id='$live_session_id'");
		
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$audience_details[] = $rows;
			}
			return $audience_details;
		}
		else
			return 0;
	}
	
	function updateAudienceFirstVisit($live_session_id, $audience_key)
	{	
		global $mysql_connect;
		mysqli_query($mysql_connect, "UPDATE audience SET audience_visit_status='1' WHERE audience_key='$audience_key' AND audience_session_room_id='$live_session_id'");
	}
	
	function generateLiveQuestionsBySessionID($session_id)
	{
		$sessions = array();
			
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM live_questions WHERE session_id='$session_id'");
			
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$sessions[] = $rows;
			}
				
			return $sessions; 
		}
		else
			return 0;
	}
	
	function generateLiveQuestionAnswered($live_session_id, $live_question_id, $audience_key)
	{
		$sessions = array();
			
		global $mysql_connect;
		$query = mysqli_query($mysql_connect, "SELECT * FROM audience_response WHERE live_session_id='$live_session_id' AND live_question_id='$live_question_id' AND audience_key='$audience_key'");
			
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$sessions[] = $rows;
			}
				
			return $sessions; 
		}
		else
			return 0;
	}