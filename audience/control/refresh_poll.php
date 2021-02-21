<?php
	require_once('../../db/init.php');
	
	if(isset($_POST['update_poll_questions']) && isset($_POST['live_session_id']) && isset($_POST['audience_key']))
	{
		$live_session_id = $_POST['live_session_id'];
		$audience_key = $_POST['audience_key'];
		
		$poll_question = "";
		
		if(generateLiveQuestionsBySessionID($live_session_id))
		{
			$slno = 1;
			foreach(generateLiveQuestionsBySessionID($live_session_id) as $live_questions)
			{
				if(generateLiveQuestionAnswered($live_session_id, $live_questions['live_question_id'], $audience_key))
				{
					foreach(generateLiveQuestionAnswered($live_session_id, $live_questions['live_question_id'], $audience_key) as $live_question_answered)
					{
						if($live_question_answered['audience_like_status'] == "1")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-success text-center no-td-space">Liked</h6></td>
											</tr>';
						}
						else if($live_question_answered['audience_like_status'] == "2")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-danger text-center no-td-space">Disliked</h6></td>
											</tr>';
						}
						else if($live_question_answered['audience_like_status'] == "3")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-secondary text-center no-td-space">Skipped</h6></td>
											</tr>';
						}
					}
				}
				else
				{
					$poll_question .= '<tr>
											<th>'.$slno++.'.</th>
											<td><p class="p-normal"><strong>'.$live_questions['live_session_question'].'</strong></p></td>
											<td>
												<div class="row">
													<div class="col-md-4"><button class="btn btn-success btn-block btn-vote" data-choice="1" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">LIKE</div>
													<div class="col-md-4"><button class="btn btn-danger btn-block btn-vote" data-choice="2" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">DISLIKE</div>
													<div class="col-md-4"><button class="btn btn-secondary btn-block btn-vote" data-choice="3" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">SKIP</div>
												</div>
											</td>
										</tr>';
				}
					
			}
		}
		else
			$poll_question = '<tr><td colspan="3"><p class="text-center text-dark-grey">The Poll created by Presenter will appear here.<br />You will have the right to express your vote for or against it.</p></td></tr>';
		
		echo $poll_question;
	}
	
	if(isset($_POST['answer_poll_question']) && isset($_POST['vote_choice']) && isset($_POST['audience_key']) && isset($_POST['live_session_id']) && isset($_POST['live_question_id']))
	{
		$vote_choice = $_POST['vote_choice'];
		$audience_key = $_POST['audience_key'];
		$live_session_id = $_POST['live_session_id'];
		$live_question_id = $_POST['live_question_id'];
		
		$poll_question = "";
		
		global $mysql_connect;
		
		mysqli_query($mysql_connect, "INSERT INTO audience_response SET live_session_id='$live_session_id', live_question_id='$live_question_id', audience_key='$audience_key', audience_like_status='$vote_choice', audience_datetime=NOW()");
		
		if(generateLiveQuestionsBySessionID($live_session_id))
		{
			$slno = 1;
			foreach(generateLiveQuestionsBySessionID($live_session_id) as $live_questions)
			{
				if(generateLiveQuestionAnswered($live_session_id, $live_questions['live_question_id'], $audience_key))
				{
					foreach(generateLiveQuestionAnswered($live_session_id, $live_questions['live_question_id'], $audience_key) as $live_question_answered)
					{
						if($live_question_answered['audience_like_status'] == "1")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-success text-center no-td-space">Liked</h6></td>
											</tr>';
						}
						else if($live_question_answered['audience_like_status'] == "2")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-danger text-center no-td-space">Disliked</h6></td>
											</tr>';
						}
						else if($live_question_answered['audience_like_status'] == "3")
						{
							$poll_question .= '<tr>
												<th scope="row">'.$slno++.'.</th>
												<td><strong>'.$live_questions['live_session_question'].'</strong></td>
												<td><h6 class="text-secondary text-center no-td-space">Skipped</h6></td>
											</tr>';
						}
					}
				}
				else
				{
					$poll_question .= '<tr>
											<th>'.$slno++.'.</th>
											<td><p class="p-normal"><strong>'.$live_questions['live_session_question'].'</strong></p></td>
											<td>
												<div class="row">
													<div class="col-md-4"><button class="btn btn-success btn-block btn-vote" data-choice="1" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">LIKE</div>
													<div class="col-md-4"><button class="btn btn-danger btn-block btn-vote" data-choice="2" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">DISLIKE</div>
													<div class="col-md-4"><button class="btn btn-secondary btn-block btn-vote" data-choice="3" data-audience-key="'.$audience_key.'" data-live-session-id="'.$live_session_id.'" data-live-question-id="'.$live_questions['live_question_id'].'">SKIP</div>
												</div>
											</td>
										</tr>';
				}
					
			}
		}
		else
			$poll_question = '<tr><td colspan="3"><p class="text-center text-dark-grey">The Poll created by Presenter will appear here.<br />You will have the right to express your vote for or against it.</p></td></tr>';
		
		echo $poll_question;
		
	}
	
	if(isset($_POST['check_session_status']) && isset($_POST['live_session_id']))
	{
		$live_session_id = $_POST['live_session_id'];
		
		foreach(generateSessionInfotoAudience($live_session_id) as $currentSessionInfo)
		{ }
		
		if($currentSessionInfo['session_live_status'] == '2')
			echo 1;
		else
			echo 0;
	}
?>