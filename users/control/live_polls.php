<?php

	require_once('../../db/init.php');
	
	// Adding a Poll Question
	if(isset($_POST['create_poll']) && isset($_POST['live_session_id']) && isset($_POST['poll_question']) &&isset($_POST['user_key']))
	{
		$live_session_id = $_POST['live_session_id'];
		$user_key = $_POST['user_key'];
		$live_session_question = $_POST['poll_question'];
		$slno = 1;
		$poll_questions_result = '';
		
		$live_question_id = liveQuestionIdGenerator();
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_key = $_POST['user_key'];
		$poll_questions_result = "";
		
		$total_view_modal = "";
		$slno = 1;
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		foreach(generateSessionInfo($user_details['user_id'], $live_session_id) as $session_info)
		{ }
		
		$session_topic = $session_info['session_topic'];
		$live_session_id = $session_info['session_id'];
		
		$session_audience = liveAudienceCount($live_session_id); //Audience Count
		$total_no_of_questions = totalNoOfQuestions($live_session_id); // Total No. of Questions
		
		$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
		
		
		global $mysql_connect;
		
		if(mysqli_query($mysql_connect, "INSERT INTO live_questions SET user_id='$user_id', session_id='$live_session_id', live_question_id='$live_question_id', live_session_question='$live_session_question', live_session_datetime=NOW()"))
		{
					
			if($total_no_of_questions > 0)
			{
				$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
				
				foreach(generateQuestionsBySessionId($live_session_id) as $questions_in_session)
				{
					$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
					
					if(getVoteCountsofEachQuestionById($live_session_id, $questions_in_session['live_question_id']))
					{
						foreach(getVoteCountsofEachQuestionById($live_session_id, $questions_in_session['live_question_id']) as $each_question_vote_count)
						{
							if($each_question_vote_count['audience_like_status'] == "1")
								$audience_liked++;
							else if($each_question_vote_count['audience_like_status'] == "2")
								$audience_disliked++;
							else if($each_question_vote_count['audience_like_status'] == "3")
								$audience_skipped++;
						}
					}
					
					//Now, Total Likes, Disliked, Skipped and No Votes Count for each questions
					$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
					
					$total_vote_status_of_question['questionLiked'] = ($audience_liked/$session_audience) * 100;
					$total_vote_status_of_question['questionDisliked'] = ($audience_disliked/$session_audience) * 100;
					$total_vote_status_of_question['questionSkipped'] = ($audience_skipped/$session_audience) * 100;
					$total_vote_status_of_question['questionNoVotes'] = 100 - ($total_vote_status_of_question['questionLiked'] + $total_vote_status_of_question['questionDisliked'] + $total_vote_status_of_question['questionSkipped']);
					
					$poll_questions_result .= '<tr>
													<th scope="row">'.$slno++.'</th>
													<td>'.$questions_in_session['live_session_question'].'</td>
													<td class="text-center text-success">'.$total_vote_status_of_question['questionLiked'].'%</td>
													<td class="text-center text-danger">'.$total_vote_status_of_question['questionDisliked'].'%</td>
													<td class="text-center text-muted">'.$total_vote_status_of_question['questionSkipped'].'%</td>
													<td class="text-center text-muted">'.$total_vote_status_of_question['questionNoVotes'].'%</td>
												</tr>';
				}
			}
			else
			{
				$poll_questions_result .= '<tr><td colspan="6"><h6 class="text-center text-muted">No Polls created by Presenter.</h6></td></tr>';
			}
		
		echo $poll_questions_result;
		}
	}
	
	if(isset($_POST['session_audience_count']) && isset($_POST['live_session_id']))
	{
		$live_session_id = $_POST['live_session_id'];
		
		$audience_count = liveAudienceCount($live_session_id);
		
		echo $audience_count;
	}
	// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	if(isset($_POST['update_polls']) && isset($_POST['live_session_id']) && isset($_POST['user_key']))
	{
		$live_session_id = $_POST['live_session_id'];
		$user_key = $_POST['user_key'];
		$slno = 1;
		$poll_questions = "";
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_key = $_POST['user_key'];
		$poll_questions_result = "";
		
		$total_view_modal = "";
		$slno = 1;
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		foreach(generateSessionInfo($user_details['user_id'], $live_session_id) as $session_info)
		{ }
		
		$session_topic = $session_info['session_topic'];
		$live_session_id = $session_info['session_id'];
		
		$session_audience = liveAudienceCount($live_session_id); //Audience Count
		$total_no_of_questions = totalNoOfQuestions($live_session_id); // Total No. of Questions
		
		$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
		
			if($total_no_of_questions > 0)
			{
				$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
				
				foreach(generateQuestionsBySessionId($live_session_id) as $questions_in_session)
				{
					$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
					
					if(getVoteCountsofEachQuestionById($live_session_id, $questions_in_session['live_question_id']))
					{
						foreach(getVoteCountsofEachQuestionById($live_session_id, $questions_in_session['live_question_id']) as $each_question_vote_count)
						{
							if($each_question_vote_count['audience_like_status'] == "1")
								$audience_liked++;
							else if($each_question_vote_count['audience_like_status'] == "2")
								$audience_disliked++;
							else if($each_question_vote_count['audience_like_status'] == "3")
								$audience_skipped++;
						}
					}
					
					//Now, Total Likes, Disliked, Skipped and No Votes Count for each questions
					$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
					
					$total_vote_status_of_question['questionLiked'] = ($audience_liked/$session_audience) * 100;
					$total_vote_status_of_question['questionDisliked'] = ($audience_disliked/$session_audience) * 100;
					$total_vote_status_of_question['questionSkipped'] = ($audience_skipped/$session_audience) * 100;
					$total_vote_status_of_question['questionNoVotes'] = 100 - ($total_vote_status_of_question['questionLiked'] + $total_vote_status_of_question['questionDisliked'] + $total_vote_status_of_question['questionSkipped']);
					
					$poll_questions_result .= '<tr>
													<th scope="row">'.$slno++.'</th>
													<td>'.$questions_in_session['live_session_question'].'</td>
													<td class="text-center text-success">'.$total_vote_status_of_question['questionLiked'].'%</td>
													<td class="text-center text-danger">'.$total_vote_status_of_question['questionDisliked'].'%</td>
													<td class="text-center text-muted">'.$total_vote_status_of_question['questionSkipped'].'%</td>
													<td class="text-center text-muted">'.$total_vote_status_of_question['questionNoVotes'].'%</td>
												</tr>';
				}
			}
			else
			{
				$poll_questions_result .= '<tr><td colspan="6"><h6 class="text-center text-muted">No Polls created by Presenter.</h6></td></tr>';
			}
		
		echo $poll_questions_result;
	}
?>