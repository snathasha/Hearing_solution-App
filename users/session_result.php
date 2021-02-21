<?php
	
	if($_SESSION['user_key'] != $_GET['user_key'])
	{
		header('Location:?pg=logout');
	}
	else
	{
		// To set the status of Live Session to End Session in a database
		endSession($_GET['session_room']);
		
		$msg = "";
		if(generateDataFromUserKey($_GET['user_key']) != 0)
		{
			foreach(generateDataFromUserKey($_GET['user_key']) as $user_details)
			{ }
		}
		
		if(generateSessionInfo($user_details['user_id'], $_GET['session_room']) != 0)
		{
			foreach(generateSessionInfo($user_details['user_id'], $_GET['session_room']) as $session_info)
			{ }
		}
		
		// Now, Total Likes, Dislikes and Skipped and No Votes
		$overall_poll_result = array('likedVotes' => 0, 'dislikedVotes' => 0, 'skippedVotes' => 0, 'noVotes' => 0);
		$audience_count = liveAudienceCount($_GET['session_room']); // Getting Audience Count
		
		// Total Number of questions in this current Session
		$total_no_of_questions = totalNoOfQuestions($_GET['session_room']);
		$msg = "";
		
		if($total_no_of_questions > 0)
		{
			// Counting Total Votes
			$likedVotes = $dislikedVotes = $skippedVotes = 0;
			if(audienceVotePresent($_GET['session_room']))
			{
				foreach(audienceVotePresent($_GET['session_room']) as $audience_votes)
				{
					if($audience_votes['audience_like_status'] == "1")
					{
						$likedVotes++;
					}
					else if($audience_votes['audience_like_status'] == "2")
					{
						$dislikedVotes++;
					}
					else if($audience_votes['audience_like_status'] == "3")
					{
						$skippedVotes++;
					}
				}
				
				// Total Available Votes
				$total_no_of_votes = $audience_count * $total_no_of_questions;
				
				$overall_poll_result['likedVotes'] = ($likedVotes/$total_no_of_votes) * 100; 
				$overall_poll_result['dislikedVotes'] = ($dislikedVotes/$total_no_of_votes) * 100; 
				$overall_poll_result['skippedVotes'] = ($skippedVotes/$total_no_of_votes) * 100;
				$overall_poll_result['noVotes'] = 100 - ($overall_poll_result['likedVotes'] + $overall_poll_result['dislikedVotes'] + $overall_poll_result['skippedVotes']);
			}
			else
				$overall_poll_result['noVotes'] = 100 - ($overall_poll_result['likedVotes'] + $overall_poll_result['dislikedVotes'] + $overall_poll_result['skippedVotes']);
		}
		else
			$msg = "You haven't created any polls";
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
		<style>
			.navbar-nav li
			{
				padding-right: 2px;
				padding-left: 2px;
			}
			
			.blob
			{
				background: black;
				border-radius: 50%;
				box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
				height: 16px;
				width: 16px;
				transform: scale(1);
				animation: pulse-black 1s infinite;
			}
			
			.blob.red
			{
				background: rgba(255, 82, 82, 1);
				box-shadow: 0 0 0 0 rgba(255, 82, 82, 1);
				animation: pulse-red 1s infinite;
			}

			@keyframes pulse-red 
			{
				0% {
					transform: scale(0.95);
					box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
				}
				
				70% {
					transform: scale(1);
					box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
				}
				
				100% {
					transform: scale(0.95);
					box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
				}
			}
			
			.bg-secondary{
				background-color: #999999 !important;
			}
			
			.bg-empty{
				background-color: #ced6e0 !important;
			}
			.color-box{
				position: absolute;
				width: 25px;
				height: 25px;
			}
		</style>
		<title>Super Polling &raquo; Session Result</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
			<a class="navbar-brand fredoka" href="?pg=dashboard&user_key=<?php echo $_SESSION['user_key']; ?>">
				<div class="logo">
					<h5><strong>Super Polling</strong></h5>
				</div>
			</a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="btn btn-primary btn-block" href="?pg=dashboard&user_key=<?php echo $_GET['user_key']; ?>"><i class="fa fa-tachometer-alt fa-fw fa-lg"></i> DASHBOARD</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-warning btn-block" href="?pg=view_history&user_key=<?php echo $_GET['user_key']; ?>"><i class="fa fa-history fa-lg fa-fw"></i> SESSION HISTORY</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger btn-block" href="?pg=logout"><i class="fa fa-sign-out-alt fa-fw fa-lg"></i> LOGOUT</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br />
					<p class="no-td-space text-dark-grey">Welcome <?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></p>
					<h3>Live Session End</h3>
					<div class="row">
						<div class="col-md-6">
							<p class="no-td-space">Topic : <span class="text-primary"><?php echo $session_info['session_topic']; ?></span></p>
							<p class="no-td-space">Session ID : <span class="text-primary"><?php echo $_GET['session_room']; ?></span></p>
							<p class="no-td-space"><i class="fa fa-users fa-fw"></i> Audiences : <span class="text-success"><?php echo $audience_count; ?></span></p>
							<br />
						</div>
					</div>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="card border-info">
								<div class="card-body">
									<h4>Session Result</h4>
									<br />
									<?php
										if(!empty($msg))
										{
											echo '<h6 class="text-center text-muted">'.$msg.'</h6>';
										}
										else
										{
									?>
										<div class="card">
											<div class="card-body">
												<h6 class="text-dark-grey">Poll Result 
													<span class="float-right">
														<span class="text-success ml-3"><i class="fa fa-thumbs-up fa-fw"></i> <?php echo $overall_poll_result['likedVotes']; ?>%</span> 
														<span class="text-danger ml-3"><i class="fa fa-thumbs-down fa-fw"></i> <?php echo $overall_poll_result['dislikedVotes']; ?>%</span> 
														<span class="ml-3 text-muted"><i class="fa fa-forward fa-fw"></i> <?php echo $overall_poll_result['skippedVotes']; ?>%</span>
														<span class="ml-3" style="color: #bdc3c7;"><i class="far fa-meh-blank fa-fw"></i> <?php echo $overall_poll_result['noVotes']; ?>%</span>
													</span>
												</h6>
												<div class="row">
													<div class="col-md-12">
														<div class="progress">
															<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $overall_poll_result['likedVotes']; ?>%;" aria-valuenow="<?php echo $overall_poll_result['likedVotes']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
															<div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $overall_poll_result['dislikedVotes']; ?>%;" aria-valuenow="<?php echo $overall_poll_result['dislikedVotes']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
															<div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $overall_poll_result['skippedVotes']; ?>%;" aria-valuenow="<?php echo $overall_poll_result['skippedVotes']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
															<div class="progress-bar bg-empty" role="progressbar" style="width: <?php echo $overall_poll_result['noVotes']; ?>%;" aria-valuenow="<?php echo $overall_poll_result['noVotes']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
										}
										?>
									<br />
									<div class="row">
										<div class="col-md-8">
										<br />
										<h5>Poll Questions Result</h5>
											<div class="card">
												<div class="card-body">
												<?php
													$question_results_group = "";
													$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
													
													//Now, Total Likes, Disliked, Skipped and No Votes Count for each questions
													$total_vote_status_of_question = array('questionLiked' => 0, 'questionDisliked' => 0, 'questionSkipped' => 0, 'questionNoVotes' => 0);
															
													if(empty($msg))
													{
														$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
				
														foreach(generateQuestionsBySessionId($_GET['session_room']) as $questions_in_session)
														{
															$audience_noVote = $audience_liked = $audience_disliked = $audience_skipped = 0;
															
															if(getVoteCountsofEachQuestionById($_GET['session_room'], $questions_in_session['live_question_id']))
															{
																foreach(getVoteCountsofEachQuestionById($_GET['session_room'], $questions_in_session['live_question_id']) as $each_question_vote_count)
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
															
															$total_vote_status_of_question['questionLiked'] = ($audience_liked/$audience_count) * 100;
															$total_vote_status_of_question['questionDisliked'] = ($audience_disliked/$audience_count) * 100;
															$total_vote_status_of_question['questionSkipped'] = ($audience_skipped/$audience_count) * 100;
															$total_vote_status_of_question['questionNoVotes'] = 100 - ($total_vote_status_of_question['questionLiked'] + $total_vote_status_of_question['questionDisliked'] + $total_vote_status_of_question['questionSkipped']);
															
															$question_results_group .= '<div class="questions-results">
																							<div class="question-result-group">
																								<div class="row">
																									<div class="col-md-6">
																										<p class="p-normal text-dark-grey">
																											<strong>
																												'.$questions_in_session['live_session_question'].'
																											</strong>
																										</p>
																									</div>
																									<div class="col-md-6">
																									<p class="p-detail">
																										<span class="float-right p-detail">
																											<span class="text-success ml-2"><i class="fa fa-thumbs-up fa-fw"></i> '.$total_vote_status_of_question['questionLiked'].'%</span>
																											<span class="text-danger ml-2"><i class="fa fa-thumbs-down fa-fw"></i> '.$total_vote_status_of_question['questionDisliked'].'%</span>
																											<span class="text-muted ml-2"><i class="fa fa-forward fa-fw"></i> '.$total_vote_status_of_question['questionSkipped'].'%</span>
																											<span class="ml-2" style="color: #ced6e0;"><i class="far fa-meh-blank fa-fw"></i> '.$total_vote_status_of_question['questionNoVotes'].'%</span>
																										</span>
																									</p>
																									</div>
																								</div>
																								<div class="progress" style="height: 10px;">
																									<div class="progress-bar bg-success" role="progressbar" style="width: '.$total_vote_status_of_question['questionLiked'].'%;" aria-valuenow="'.$total_vote_status_of_question['questionLiked'].'" aria-valuemin="0" aria-valuemax="100"></div>
																									<div class="progress-bar bg-danger" role="progressbar" style="width: '.$total_vote_status_of_question['questionDisliked'].'%;" aria-valuenow="'.$total_vote_status_of_question['questionDisliked'].'" aria-valuemin="0" aria-valuemax="100"></div>
																									<div class="progress-bar bg-secondary" role="progressbar" style="width: '.$total_vote_status_of_question['questionSkipped'].'%;" aria-valuenow="'.$total_vote_status_of_question['questionSkipped'].'" aria-valuemin="0" aria-valuemax="100"></div>
																									<div class="progress-bar bg-empty" role="progressbar" style="width: '.$total_vote_status_of_question['questionNoVotes'].'%;" aria-valuenow="'.$total_vote_status_of_question['questionNoVotes'].'" aria-valuemin="0" aria-valuemax="100"></div>
																								</div>
																								<br />
																								<br />
																							</div>
																						</div>';
														}
														echo $question_results_group;
													}
												?>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<br />
											<div class="card">
												<div class="card-body">
													<h6>Poll Results Marker and Colours</h6>
													<div class="row">
														<div class="col-md-6">
															<p class="p-detail">
																<p>
																	<i class="fa fa-thumbs-up fa-fw" style="color: #28b62c;"></i> 
																	&nbsp;&nbsp;
																	Liked
																</p>
																<p>
																	<i class="fa fa-thumbs-down fa-fw" style="color: #ff4136;"></i> 
																	&nbsp;&nbsp;
																	Disliked
																</p>
																<p>
																	<i class="fa fa-forward fa-fw" style="color: #999999;"></i> 
																	&nbsp;&nbsp;
																	Skipped
																</p>														
																<p>
																	<div class="far fa-meh-blank fa-fw fa-lg" style="color: #ced6e0;"></div> 
																	&nbsp;&nbsp;
																	None
																</p>
															</p>
														</div>
														<div class="col-md-6">
															<p class="p-detail">
																<p>
																	<div class="color-box" style="background-color: #28b62c;"></div> 
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	Liked
																</p>
																<p>
																	<div class="color-box" style="background-color: #ff4136;"></div> 
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	Disliked
																</p>
																<p>
																	<div class="color-box" style="background-color: #999999;"></div> 
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	Skipped
																</p>														
																<p>
																	<div class="color-box" style="background-color: #ced6e0;"></div> 
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	None
																</p>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<br />
			<br />
			<br />
		</div>
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	</body>
</html>