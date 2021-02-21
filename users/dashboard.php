<?php
	
	if($_SESSION['user_key'] != $_GET['user_key'])
	{
		header('Location:?pg=logout');
	}
	else
	{
		if(generateDataFromUserKey($_GET['user_key']) != 0)
		{
			foreach(generateDataFromUserKey($_GET['user_key']) as $user_details)
			{ }
		}
		else
		{
			header('Location:?pg=logout');
		}
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
			
		</style>
		<title>Super Polling &raquo; Dashboard</title>
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
						<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-create-room">
							<i class="fa fa-chalkboard fa-lg fa-fw"></i> CREATE A SESSION
						</button>
					</li>
					<li class="nav-item">
						<a class="btn btn-warning btn-block" href="?pg=view_history&user_key=<?php echo $_GET['user_key']; ?>"><i class="fa fa-history fa-lg fa-fw"></i> SESSION HISTORY</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger btn-block" href="?pg=logout"><i class="fa fa-sign-out-alt fa-lg fa-fw"></i> LOGOUT</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br />
					<p class="no-td-space text-dark-grey">Welcome <?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></p>
					<h3>Dashboard</h3>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h5><div class="blob red" style="position: absolute; top: 4px;"></div> &nbsp;&nbsp;&nbsp;&nbsp; Ongoing Live Sessions</h5>
					<hr />
					<div class="row" id="ongoing-live-session">
					<?php
						$ongoing_session_rows = "";
						
						if(generateOngoingLiveSessions($user_details['user_id']))
						{
							foreach(generateOngoingLiveSessions($user_details['user_id']) as $ongoing_session)
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
																				<a class="btn btn-success btn-block" href="?pg=live_session&user_key='.$_GET['user_key'].'&session_room='.$ongoing_session['session_id'].'" target="_blank">JOIN SESSION</a>
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
							echo $ongoing_session_rows;
						}
						else
							echo '<div class="col-md-12"><h6 class="text-muted">Your Live Session will appear here.</h6></div>';
					?>
					</div>
				</div>
			</div>
			<br />
			
			<div class="row">
				<div class="col-md-12">
					<br />
					<h5>Upcoming Sessions</h5>
					<hr />
					<div class="row" id="upcoming-session">
					<?php
						$upcoming_session_rows = "";
						
						if(generateUpcomingSessions($user_details['user_id']))
						{
							foreach(generateUpcomingSessions($user_details['user_id']) as $upcoming_session)
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
																				<a class="btn btn-primary btn-block start-session" data-start-session-id="'.$upcoming_session['session_id'].'" href="?pg=live_session&user_key='.$_GET['user_key'].'&session_room='.$upcoming_session['session_id'].'" target="_blank">START SESSION</a>
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
					?>
					</div>
				</div>
			</div>
			
			<br />
			<div class="row">
				<div class="col-md-12">
					<br />
					<h5>Recent Sessions</h5>
					<hr />
					<div class="row" id="recent-session">
					<?php
						$end_session_rows = "";
						if(generateRecentSessions($user_details['user_id']))
						{
							foreach(generateRecentSessions($user_details['user_id']) as $end_session)
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
							echo $end_session_rows;
						}
						else
							echo '<div class="col-md-12"><h6 class="text-muted">You have no Recent Sessions.</h6></div>';
					?>
					</div>
				</div>
			</div>
			<br />
			<br />
		</div>
		
		<br />
		<br />
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		
		<!-- Modal Create Session -->
		<div class="modal fade" id="modal-create-room" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Create a New Session</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<h6>Session Topic:</h6>
							<input type="text" class="form-control" id="session_topic" maxlength="99" placeholder="Enter Session Topic">
							<p class="p-detail text-center" id="error_session_topic">&nbsp;</p>
						</div>
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-success btn-block" id="create-session" data-dismiss="modal" aria-label="Close">CONFIRM</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">CANCEL</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal View Session -->
		<div class="modal fade" id="modal-view-session" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Session Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="view-details-modal">
							<h5 class="no-td-space">Session Topic</h5>
							<h6 class="text-success">Session ID : ksjfgksjhjlshf</h6>
							<p class="p-detail text-dark-grey"><strong><i class="far fa-clock fa-fw"></i> Duration : <span class="text-muted">00:00:00</span></strong></p>
							<p class="p-detail text-dark-grey"><strong><i class="fa fa-users fa-fw"></i> Audience : <span class="text-success">5</span></strong></p>
							<div class="row">
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Created On:</strong></p>
									<p class="text-muted p-detail no-td-space"></p>
									<p class="text-muted p-detail no-td-space"></p>
								</div>
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Started On:</strong></p>
									<p class="text-muted p-detail no-td-space"></p>
									<p class="text-muted p-detail no-td-space"></p>
								</div>
								<div class="col-md-4">
									<p class="p-detail text-dark-grey no-td-space"><strong>Stopped On:</strong></p>
									<p class="text-muted p-detail no-td-space"></p>
									<p class="text-muted p-detail no-td-space"></p>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive-sm">
										<table class="table table-sm table-striped">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Question</th>
													<th scope="col">Likes</th>
													<th scope="col">Dislikes</th>
													<th scope="col">Skipped</th>
													<th scope="col">No Votes</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1</th>
													<td>What is Good Structure of missile?</td>
													<td class="text-success">50%</td>
													<td class="text-danger">50%</td>
													<td class="text-muted">0%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
		
		<script>
			var user_key = "<?php echo $_GET['user_key']; ?>";
			
			$(document).ready(function(){
				
				$(document).on('click', '#create-session', function(){
					var session_topic = $('#session_topic').val().trim();
					
					if(session_topic == "")
					{
						$('#error_session_topic').html('<span class="text-danger">Empty Session Topic!</span>');
					}
					else
					{
						$('#error_session_topic').html('&nbsp;');
						
							$.ajax
							({
								url:'users/control/control.php',
								method:'POST',
								data:{create_session:1, session_topic:session_topic, user_key:user_key},
								success:function(data)
								{
									$('#error_session_topic').html('<span class="text-success">Session Created Successfully.</span>');
									$('#session_topic').val('');
									$('#upcoming-session').html(data);
									$('#error_session_topic').html('&nbsp;');
								}
							});
					}
				});
				
				$(document).on('click', '.start-session', function(){
					var start_session_id = $(this).attr('data-start-session-id');
					
					$.ajax
					({
						url:'users/control/control.php',
						method: 'POST',
						data:{ start_session:1, start_session_id:start_session_id, user_key:user_key },
						success: function(data)
						{
							var data = JSON.parse(data);
							$('#upcoming-session').html(data.upcomingSession);
							$('#ongoing-live-session').html(data.liveSession);
						}
					});
				});
				
				$(document).on('click', '.delete-session', function(){
					var delete_session_id = $(this).attr('data-delete-session-id');
					
					$.ajax
					({
						url:'users/control/control.php',
						method:'POST',
						data:{delete_session:1, delete_session_id: delete_session_id, user_key: user_key},
						success:function(data)
						{
							$('#upcoming-session').html(data);
						}
					});
				});
				
				$(document).on('click', '.end-session', function(){
					var end_session_id = $(this).attr('data-end-session-id');
					
					$.ajax
					({
						url:'users/control/control.php',
						method: 'POST',
						data:{end_session:1, end_session_id:end_session_id, user_key:user_key},
						success: function(data)
						{
							var data = JSON.parse(data);
							$('#ongoing-live-session').html(data.ongoingSession);
							$('#recent-session').html(data.endSession);
						}
					});
				});
				
				// View Details Modal
				$(document).on('click', '.view-session-details', function(){
					
					var view_session_id = $(this).attr('data-view-session-id');
					
					$.ajax
					({
						url:'users/control/control.php',
						method: 'POST',
						data:{ view_session_details:1, view_session_id:view_session_id, user_key:user_key },
						success: function(data)
						{
							$('#view-details-modal').html(data);
						}
					});
				});
				
				// Checking and Updating Ongoing Session and Recent Session
				setInterval(updateAllSessions, 3000);
				
				function updateAllSessions()
				{
					$.ajax
					({
						url:'users/control/refresh.php',
						method:'POST',
						data:{ update_all_dashboard_sessions:1, user_key:user_key },
						success: function(data)
						{
							var data = JSON.parse(data);
							$('#ongoing-live-session').html(data.ongoingSession);
							$('#recent-session').html(data.recentSession);
						}
					});
				}
				
				$(document).on('click', '.view-session-details', function(){
					var view_session_id = $(this).attr('data-view-session-id');
					
					$.ajax
					({
						url: 'users/control/control.php',
						method:'POST',
						data:{ view_details:1, view_session_id:view_session_id, user_key:user_key },
						success:function(data)
						{
							$('#view_details_modal').html(data);
						}
					});
				});
				
				// Copy the link or the room id
				$(document).on('click', '.copy-upcoming-id-btn', function(){
					
					var copy_upcoming_id_btn = $(this).attr('data-upcoming-id');
					var blank_input = document.createElement("input");
					
					document.body.appendChild(blank_input);
					blank_input.setAttribute("id", "copy-upcoming-id");
					$("#copy-upcoming-id").val(copy_upcoming_id_btn);
					blank_input.select();
					
					document.execCommand("copy");
					document.body.removeChild(blank_input);

				});
				
				$(document).on('click', '.copy-ongoing-id-btn', function(){
					
					var copy_ongoing_id_btn = $(this).attr('data-ongoing-id');
					var blank_input = document.createElement("input");
					
					document.body.appendChild(blank_input);
					blank_input.setAttribute("id", "copy-ongoing-id");
					$("#copy-ongoing-id").val(copy_ongoing_id_btn);
					blank_input.select();
					
					document.execCommand("copy");
					document.body.removeChild(blank_input);

				});
				
			});
		</script>
	</body>
</html>