<?php
	require_once('../../db/init.php');
	
	if(isset($_POST['update_all_dashboard_sessions']) && isset($_POST['user_key']))
	{
		$user_key = $_POST['user_key'];
		
		foreach(generateDataFromUserKey($user_key) as $user_details)
		{ }
		
		$user_id = $user_details['user_id'];
		
		$ongoing_session_rows = $upcoming_session_rows = $recent_session_rows = "";
		
		$update_rows = array('ongoingSession' => '', 'recentSession' => '');
		
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
			foreach(generateRecentSessions($user_id) as $recent_session)
			{
				$recent_session_rows .= '<div class="col-md-4">
												<div class="card border-info">
													<div class="card-body">
														<h6 class="no-td-space">'.$recent_session['session_topic'].'</h6>
														<p class="text-success p-detail">Session ID: '.$recent_session['session_id'].'</p>
														<div class="row">
															<div class="col-md-6">
																<p class="text-dark-grey p-detail no-td-space"><strong>Started On:</strong></p>
																<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($recent_session['session_start_time'])).'</p>
																<p class="text-muted p-detail">'.date('g:i a', strtotime($recent_session['session_start_time'])).'</p>
															</div>
															<div class="col-md-6">
																<p class="text-dark-grey p-detail no-td-space"><strong>Stopped On:</strong></p>
																<p class="text-muted p-detail no-td-space">'.date('jS F Y', strtotime($recent_session['session_end_time'])).'</p>
																<p class="text-muted p-detail">'.date('g:i a', strtotime($recent_session['session_end_time'])).'</p>
															</div>
														</div>
														<button class="btn btn-warning btn-block view-session-details" data-view-session-id="'.$recent_session['session_id'].'" data-toggle="modal" data-target="#modal-view-session"><i class="fa fa-info-circle fa-fw fa-lg"></i> VIEW DETAILS</button>
													</div>
												</div>
												<br />
											</div>';
			}
		}
		else
			$recent_session_rows = '<div class="col-md-12"><h6 class="text-muted">You have no Recent Sessions.</h6></div>';
		
		$update_rows['ongoingSession'] = $ongoing_session_rows;
		$update_rows['recentSession'] = $recent_session_rows;
		
		echo json_encode($update_rows);
	}
?>