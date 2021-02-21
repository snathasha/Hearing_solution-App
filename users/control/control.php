<?php

	require_once('../../db/init.php');
	
	// Create New Session and Update the Upcoming Session Area in Dashhboard
	if(isset($_POST['create_session']) && isset($_POST['session_topic']) && isset($_POST['user_key']))
	{	
		$session_topic = $_POST['session_topic'];
		$user_key = $_POST['user_key'];
		$upcoming_session_rows = "";
		
		$sessionID = sessionIdGenerator();
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		global $mysql_connect;
		
		mysqli_query($mysql_connect, "INSERT INTO session_room SET session_id='$sessionID', user_id='$user_id', session_topic='$session_topic', session_live_status='0', session_creation_time=NOW()");
		
		if(generateUpcomingSessions($user_id))
		{
			foreach(generateUpcomingSessions($user_id) as $upcoming_session)
			{
				$upcoming_session_rows .= '<div class="col-md-4">
												<div class="card border-primary">
													<div class="card-body">
														<h6 class="no-td-space">'.$upcoming_session['session_topic'].'</h6>
														<p class="text-success p-detail">Session ID: '.$upcoming_session['session_id'].'<br /><button class="btn btn-outline-primary btn-sm copy-upcoming-id-btn" data-upcoming-id="'.$upcoming_session['session_id'].'">Copy Session ID</button></p>
														<p class="text-dark-grey p-detail no-td-space"><strong>Created On:</strong></p>
														<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($upcoming_session['session_creation_time'])).'</p>
														<p class="text-muted p-detail">'.date('g:i a', strtotime($upcoming_session['session_creation_time'])).'</p>
														<div class="row">
															<div class="col-md-6">
																<a class="btn btn-primary btn-block start-session" data-start-session-id="'.$upcoming_session['session_id'].'" href="?pg=live_session&user_key='.$user_key.'&session_room='.$upcoming_session['session_id'].'" target="_blank">START SESSION</a>
															</div>
															<div class="col-md-6">
																<a class="btn btn-danger btn-block delete-session" data-delete-session-id="'.$upcoming_session['session_id'].'">DELETE SESSION</a>
															</div>
														</div>
													</div>
												</div>
												<br />
											</div>';
			}
			echo $upcoming_session_rows;
		}
		else
			echo '<div class="col-md-12"><h6 class="text-muted">Your Upcoming Sessions will appear here.</h6></div>';
	}
	
	// Delete the Created Session and Update the Upcoming Session Area in Dashhboard
	if(isset($_POST['delete_session']) && isset($_POST['delete_session_id']) && isset($_POST['user_key']))
	{
		$session_id = $_POST['delete_session_id'];
		$user_key = $_POST['user_key'];
		$upcoming_session_rows = "";
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		global $mysql_connect;
		
		mysqli_query($mysql_connect, "DELETE FROM session_room WHERE user_id='$user_id' AND session_id='$session_id'");
		
		if(generateUpcomingSessions($user_id) != 0)
		{
			foreach(generateUpcomingSessions($user_id) as $upcoming_session)
			{
				$upcoming_session_rows .= '<div class="col-md-4">
												<div class="card border-primary">
													<div class="card-body">
														<h6 class="no-td-space">'.$upcoming_session['session_topic'].'</h6>
														<p class="text-success p-detail">Session ID: '.$upcoming_session['session_id'].'<br /><button class="btn btn-outline-primary btn-sm copy-upcoming-id-btn" data-upcoming-id="'.$upcoming_session['session_id'].'">Copy Session ID</button></p>
														<p class="text-dark-grey p-detail no-td-space"><strong>Created On:</strong></p>
														<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($upcoming_session['session_creation_time'])).'</p>
														<p class="text-muted p-detail">'.date('g:i a', strtotime($upcoming_session['session_creation_time'])).'</p>
														<div class="row">
															<div class="col-md-6">
																<a class="btn btn-primary btn-block start-session" data-start-session-id="'.$upcoming_session['session_id'].'" href="?pg=live_session&user_key='.$user_key.'&session_room='.$upcoming_session['session_id'].'" target="_blank">START SESSION</a>
															</div>
															<div class="col-md-6">
																<a class="btn btn-danger btn-block delete-session" data-delete-session-id="'.$upcoming_session['session_id'].'">DELETE SESSION</a>
															</div>
														</div>
													</div>
												</div>
												<br />
											</div>';
			}
			echo $upcoming_session_rows;
		}
		else
			echo '<div class="col-md-12"><h6 class="text-muted">Your Upcoming Sessions will appear here.</h6></div>';
	}
	
	// Start Session and Update the Upcoming Session Area and Ongoing Live Session Area in Dashhboard ---------------------------------------------------------
	if(isset($_POST['start_session']) && isset($_POST['start_session_id']) && isset($_POST['user_key']))
	{
		$start_session_id = $_POST['start_session_id'];
		$user_key = $_POST['user_key'];
		$upcoming_session_rows = $ongoing_session_rows = "";
		
		$start_session_update = array('upcomingSession' => '', 'liveSession' => '');
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		global $mysql_connect;
		
		//$query = mysqli_query($mysql_connect, "UPDATE session_room SET session_live_status='1', session_start_time=NOW() WHERE session_id='$start_session_id' AND user_id='$user_id'");
		
		if(mysqli_query($mysql_connect, "UPDATE session_room SET session_live_status='1', session_start_time=NOW() WHERE session_id='$start_session_id' AND user_id='$user_id'"))
		{
			if(generateUpcomingSessions($user_id))
			{
				foreach(generateUpcomingSessions($user_id) as $upcoming_session)
				{
					$upcoming_session_rows .= '<div class="col-md-4">
													<div class="card border-primary">
														<div class="card-body">
															<h6 class="no-td-space">'.$upcoming_session['session_topic'].'<br /><button class="btn btn-outline-primary btn-sm copy-upcoming-id-btn" data-upcoming-id="'.$upcoming_session['session_id'].'">Copy Session ID</button></h6>
															<p class="text-success p-detail">Session ID: '.$upcoming_session['session_id'].'</p>
															<p class="text-dark-grey p-detail no-td-space"><strong>Created On:</strong></p>
															<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($upcoming_session['session_creation_time'])).'</p>
															<p class="text-muted p-detail">'.date('g:i a', strtotime($upcoming_session['session_creation_time'])).'</p>
															<div class="row">
																<div class="col-md-6">
																	<a class="btn btn-primary btn-block start-session" data-start-session-id="'.$upcoming_session['session_id'].'" href="?pg=live_session&user_key='.$user_key.'&session_room='.$upcoming_session['session_id'].'" target="_blank">START SESSION</a>
																</div>
																<div class="col-md-6">
																	<a class="btn btn-danger btn-block delete-session" data-delete-session-id="'.$upcoming_session['session_id'].'">DELETE SESSION</a>
																</div>
															</div>
														</div>
													</div>
													<br />
												</div>';
				}
			}
			else
				$upcoming_session_rows = '<div class="col-md-12"><h6 class="text-muted">Your Upcoming Sessions will appear here.</h6></div>';
			
			if(generateOngoingLiveSessions($user_id) != 0)
			{
				foreach(generateOngoingLiveSessions($user_id) as $ongoing_session)
				{
					$ongoing_session_rows .= '<div class="col-md-4">
													<div class="card border-success">
														<div class="card-body">
															<h6 class="no-td-space">'.$ongoing_session['session_topic'].'</h6>
															<p class="text-success p-detail">Session ID: '.$ongoing_session['session_id'].'<br /><button class="btn btn-outline-primary btn-sm copy-ongoing-id-btn" data-ongoing-id="'.$ongoing_session['session_id'].'">Copy Session ID</button></p>
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Created On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($ongoing_session['session_creation_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($ongoing_session['session_creation_time'])).'</p>
																</div>
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Started On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($ongoing_session['session_start_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($ongoing_session['session_start_time'])).'</p>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<a class="btn btn-success btn-block" href="?pg=live_session&user_key='.$user_key.'&session_room='.$ongoing_session['session_id'].'" target="_blank">JOIN SESSION</a>
																</div>
																<div class="col-md-6">
																	<a class="btn btn-danger btn-block end-session" data-end-session-id="'.$ongoing_session['session_id'].'">END SESSION</a>
																</div>
															</div>
														</div>
													</div>
													<br />
												</div>';
				}
			}
			else
				$ongoing_session_rows = '<div class="col-md-12"><h6 class="text-muted">Your Live Session will appear here.</h6></div>';
		}
		
		$start_session_update['upcomingSession'] = $upcoming_session_rows;
		$start_session_update['liveSession'] = $ongoing_session_rows;
		
		echo json_encode($start_session_update);
	}
	
	// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	// End Session and Update the Recent Session Area in Dashhboard ---------------------------------------------------------
	if(isset($_POST['end_session']) && isset($_POST['end_session_id']) && isset($_POST['user_key']))
	{
		$end_session_id = $_POST['end_session_id'];
		$user_key = $_POST['user_key'];
		$end_session_rows = $ongoing_session_rows = "";
		
		$end_session_update = array('ongoingSession' => '', 'endSession' => '');
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		global $mysql_connect;
		
		if(mysqli_query($mysql_connect, "UPDATE session_room SET session_live_status='2', session_end_time=NOW() WHERE user_id='$user_id' AND session_id='$end_session_id'"))
		{
			if(generateOngoingLiveSessions($user_id) != 0)
			{
				foreach(generateOngoingLiveSessions($user_id) as $ongoing_session)
				{
					$ongoing_session_rows .= '<div class="col-md-4">
													<div class="card border-success">
														<div class="card-body">
															<h6 class="no-td-space">'.$ongoing_session['session_topic'].'</h6>
															<p class="text-success p-detail">Session ID: '.$ongoing_session['session_id'].'<br /><button class="btn btn-outline-primary btn-sm copy-ongoing-id-btn" data-ongoing-id="'.$ongoing_session['session_id'].'">Copy Session ID</button></p>
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Created On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($ongoing_session['session_creation_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($ongoing_session['session_creation_time'])).'</p>
																</div>
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Started On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($ongoing_session['session_start_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($ongoing_session['session_start_time'])).'</p>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<a class="btn btn-success btn-block" href="?pg=live_session&user_key='.$user_key.'&session_room='.$ongoing_session['session_id'].'" target="_blank">JOIN SESSION</a>
																</div>
																<div class="col-md-6">
																	<a class="btn btn-danger btn-block end-session" data-end-session-id="'.$ongoing_session['session_id'].'">END SESSION</a>
																</div>
															</div>
														</div>
													</div>
													<br />
												</div>';
				}
			}
			else
				$ongoing_session_rows = '<div class="col-md-12"><h6 class="text-muted">Your Live Session will appear here.</h6></div>';
			
			if(generateRecentSessions($user_id))
			{
				foreach(generateRecentSessions($user_id) as $end_session)
				{
					$end_session_rows .= '<div class="col-md-4">
													<div class="card border-info">
														<div class="card-body">
															<h6 class="no-td-space">'.$end_session['session_topic'].'</h6>
															<p class="text-success p-detail">Session ID: '.$end_session['session_id'].'</p>
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Started On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($end_session['session_start_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($end_session['session_start_time'])).'</p>
																</div>
																<div class="col-md-6">
																	<p class="text-dark-grey p-detail no-td-space"><strong>Stopped On:</strong></p>
																	<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($end_session['session_end_time'])).'</p>
																	<p class="text-muted p-detail">'.date('g:i a', strtotime($end_session['session_end_time'])).'</p>
																</div>
															</div>
															<button class="btn btn-warning btn-block view-session-details" data-view-session-id="'.$end_session['session_id'].'" data-toggle="modal" data-target="#modal-view-session"><i class="fa fa-info-circle fa-fw fa-lg"></i> VIEW DETAILS</button>
														</div>
													</div>
													<br />
												</div>';
				}
			}
			else
				$end_session_rows = '<div class="col-md-12"><h6 class="text-muted">You have no Recent Sessions.</h6></div>';
		}
		
		$end_session_update['ongoingSession'] = $ongoing_session_rows;
		$end_session_update['endSession'] = $end_session_rows;
		
		echo json_encode($end_session_update);
	}
	
	if(isset($_POST['view_session_details']) && isset($_POST['view_session_id']) && isset($_POST['user_key']))
	{
		$view_session_id = $_POST['view_session_id'];
		$user_key = $_POST['user_key'];
		
		$poll_details = "";
		$poll_questions_result = "";
		
		$total_view_modal = "";
		$slno = 1;
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		foreach(generateSessionInfo($user_details['user_id'], $view_session_id) as $session_info)
		{ }
		
		$session_topic = $session_info['session_topic'];
		$live_session_id = $session_info['session_id'];
		$session_duration = gmdate("H:i:s", (strtotime($session_info['session_end_time'])) - (strtotime($session_info['session_start_time'])));
		
		$session_audience = liveAudienceCount($view_session_id); //Audience Count
		$total_no_of_questions = totalNoOfQuestions($view_session_id); // Total No. of Questions
		
		// Session Creation Time
		$session_creation_date = date('jS F Y', strtotime($session_info['session_creation_time']));
		$session_creation_time = date('g:i a', strtotime($session_info['session_creation_time']));
		
		// Session Start Time
		$session_start_date = date('jS F Y', strtotime($session_info['session_start_time']));
		$session_start_time = date('g:i a', strtotime($session_info['session_start_time']));
		
		// Session End Time
		$session_end_date = date('jS F Y', strtotime($session_info['session_end_time']));
		$session_end_time = date('g:i a', strtotime($session_info['session_end_time']));
		
		$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
		
			if(audienceVotePresent($view_session_id))
			{
				$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
				
				foreach(generateQuestionsBySessionId($view_session_id) as $questions_in_session)
				{
					$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
					
					if(getVoteCountsofEachQuestionById($view_session_id, $questions_in_session['live_question_id']))
					{
						foreach(getVoteCountsofEachQuestionById($view_session_id, $questions_in_session['live_question_id']) as $each_question_vote_count)
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
			
			$poll_details = '<h4 class="no-td-space">'.$session_topic.'</h4>
							<p class="text-success">'.$live_session_id.'</p>
							<p class="p-detail text-dark-grey no-td-space"><strong><i class="fa fa-users fa-fw"></i> Audience : <span class="text-success">'.$session_audience.'</span></strong></p>
							<p class="p-detail text-dark-grey"><strong><i class="far fa-clock fa-fw"></i> Duration : <span class="text-muted">'.$session_duration.'</span></strong></p>
							<div class="row">
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Created On:</strong></p>
									<p class="text-muted p-detail no-td-space">'.$session_creation_date.'</p>
									<p class="text-muted p-detail no-td-space">'.$session_creation_time.'</p>
									<br />
								</div>
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Started On:</strong></p>
									<p class="text-muted p-detail no-td-space">'.$session_start_date.'</p>
									<p class="text-muted p-detail no-td-space">'.$session_start_time.'</p>
									<br />
								</div>
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Stopped On:</strong></p>
									<p class="text-muted p-detail no-td-space">'.$session_end_date.'</p>
									<p class="text-muted p-detail no-td-space">'.$session_end_time.'</p>
									<br />
								</div>
							</div>
							<hr />
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive-sm">
										<table class="table table-sm table-striped">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Question</th>
													<th scope="col" class="text-center">Likes</th>
													<th scope="col" class="text-center">Dislikes</th>
													<th scope="col" class="text-center">Skipped</th>
													<th scope="col" class="text-center">No Votes</th>
												</tr>
											</thead>
											<tbody>
												'.$poll_questions_result.'
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<hr />';
			echo $poll_details;
	}
	// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------

?>