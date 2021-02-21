<?php
	
	function setUserKey($lemail, $user_key)
	{
		global $mysql_connect;
		
		mysqli_query($mysql_connect, "UPDATE users SET token_id='$user_key' WHERE email='$lemail'");
	}
	
	function generateDataFromUserKey($user_key)
	{
		$user_details = array();
		
		global $mysql_connect;
		
		$query = mysqli_query($mysql_connect, "SELECT * FROM users WHERE token_id='$user_key'");
		
		if($query->num_rows != 0)
		{
			while($rows = $query->fetch_assoc())
			{
				$user_details[] = $rows;
			}
			return $user_details;
		}
		else
			return 0;
	}
	
	// -------------------------------------------------------------------------------------------------------------------------------------------------
		function generateUpcomingSessions($user_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_live_status='0'");
			
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
		
		function generateOngoingLiveSessions($user_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_live_status='1'");
			
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
		
		function generateRecentSessions($user_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_live_status='2' ORDER BY session_end_time DESC LIMIT 3");
			
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
		
		function generateSessionsHistory($user_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_live_status='2' ORDER BY session_end_time DESC");
			
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
		
		function generateEndSessions($user_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_live_status='2'");
			
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
		
		function generateSessionInfo($user_id, $session_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM session_room WHERE user_id='$user_id' AND session_id='$session_id'");
			
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
		
		function generateLivePolls($user_id, $session_id)
		{
			$sessions = array();
			
			global $mysql_connect;
			$query = mysqli_query($mysql_connect, "SELECT * FROM live_questions WHERE user_id='$user_id' AND session_id='$session_id'");
			
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
		
		function endSession($session_id)
		{
			global $mysql_connect;
			
			mysqli_query($mysql_connect, "UPDATE session_room SET session_live_status='2', session_end_time=NOW() WHERE session_id='$session_id'");
		}
		
		function liveAudienceCount($live_session_id)
		{
			global $mysql_connect;
			
			$query = mysqli_query($mysql_connect, "SELECT * FROM audience WHERE audience_session_room_id='$live_session_id'");
			return $query->num_rows;
		}
		
		function audienceVotePresent($live_session_id)
		{
			$audience_votes = array();
			
			global $mysql_connect;
			
			$query = mysqli_query($mysql_connect, "SELECT * FROM audience_response WHERE live_session_id='$live_session_id'");
			
			if($query->num_rows != 0)
			{
				while($rows = $query->fetch_assoc())
				{
					$audience_votes[] = $rows;
				}
				
				return $audience_votes;
			}
			else
				return 0;
		}
		
		function totalNoOfQuestions($live_session_id)
		{
			global $mysql_connect;
			
			$query = mysqli_query($mysql_connect, "SELECT * FROM live_questions WHERE session_id='$live_session_id'");
			return $query->num_rows;
		}
		
		function generateQuestionsBySessionId($live_session_id)
		{
			$questions = array();
			
			global $mysql_connect;
			
			$query = mysqli_query($mysql_connect, "SELECT * FROM live_questions WHERE session_id='$live_session_id'");
			
			if($query->num_rows != 0)
			{
				while($rows = $query->fetch_assoc())
				{
					$questions[] = $rows;
				}
				
				return $questions;
			}
			else
				return 0;
		}
		
		function getVoteCountsofEachQuestionById($live_session_id, $live_question_id)
		{
			$vote_counts_of_questions = array();
			
			global $mysql_connect;
			
			$query = mysqli_query($mysql_connect, "SELECT * FROM audience_response WHERE live_session_id='$live_session_id' AND live_question_id='$live_question_id'");
			
			if($query->num_rows != 0)
			{
				while($rows = $query->fetch_assoc())
				{
					$vote_counts_of_questions[] = $rows;
				}
				
				return $vote_counts_of_questions;
			}
		}
?>