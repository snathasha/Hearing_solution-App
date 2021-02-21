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
		
		if(generateSessionInfo($user_details['user_id'], $_GET['session_room']) != 0)
		{
			foreach(generateSessionInfo($user_details['user_id'], $_GET['session_room']) as $session_info)
			{ }
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
		<title>Super Polling &raquo; LIVE Session</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
			<a class="navbar-brand fredoka" href="?pg=dashboard&user_key=<?php echo $_GET['user_key']; ?>">
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
						<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal-quit-session">
							<i class="far fa-stop-circle fa-lg fa-fw"></i> END SESSION
						</button>
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
					<h3><div class="blob red" style="position: absolute; top: 56px;"></div> &nbsp;&nbsp;&nbsp; Live Session</h3>
					<div class="row">
						<div class="col-md-8">
							<p class="no-td-space">Topic : <span class="text-primary"><?php echo $session_info['session_topic']; ?></span></p>
							<p class="no-td-space">Session ID : <span class="text-primary"><?php echo $_GET['session_room']; ?></span></p>
							<p class="no-td-space p-detail">Share the Session ID to let audiences join in.</p>
							<br />
						</div>
						<div class="col-md-4">
							<p class="text-center"><i class="fa fa-users fa-fw"></i> Audiences : <span class="text-success" id="audience_count"> -- </span></p>
							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-poll">
										Create a Poll
									</button>
								</div>
							</div>
						</div>
					</div>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th scope="col">No.</th>
											<th scope="col">Questions</th>
											<th scope="col" class="text-center">Likes</th>
											<th scope="col" class="text-center">Dislikes</th>
											<th scope="col" class="text-center">Skipped</th>
											<th scope="col" class="text-center">Not Voted</th>
										</tr>
									</thead>
									<tbody id="poll-questions">
										<tr>
											<td colspan="6"><h5 class="text-muted text-center">Loading Polls . . .</h5></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
							
				<br />
				<br />
		</div>

		<!-- Modal Poll -->
		<div class="modal fade" id="modal-poll" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Create a Poll</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<h6>Your Poll</h6>
							<input type="text" class="form-control" id="poll" maxlength="199" placeholder="Enter your Question">
							<p class="text-center p-detail" id="poll-error">&nbsp;</p>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-success btn-block" id="add-poll" data-dismiss="modal" aria-label="Close">Add Poll</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		<!-- Modal Quit Session -->
		<div class="modal fade" id="modal-quit-session" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<h5 class="text-center">End Current Session ?</h5>
						<br />
						<div class="row">
							<div class="col-md-6">
								<a class="btn btn-success btn-block" href="?pg=session_result&user_key=<?php echo $_GET['user_key']; ?>&session_room=<?php echo $_GET['session_room']; ?>">YES</a>
							</div>
							<div class="col-md-6">
								<button class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">CANCEL</button>
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
			var live_session_id = '<?php echo $_GET['session_room']; ?>';
			var user_key = "<?php echo $_GET['user_key']; ?>";
			
			$(document).ready(function(){
				
				$(document).on('click', '#add-poll', function(){
					var poll_question = $('#poll').val().trim();
					
					if(poll == "")
					{
						$('#poll-error').html('<span class="text-danger">Enter a Question to create a Poll!</span>');
					}
					else
					{
						$('#poll-error').html('&nbsp;');
						$('#poll').val('');
						
						$.ajax
						({
							url:'users/control/live_polls.php',
							method:'POST',
							data:{create_poll:1, live_session_id:live_session_id, poll_question:poll_question, user_key:user_key},
							success:function(data)
							{
								$('#poll-questions').html(data);
							}
						});
					}
				});
				
				setInterval(updateAudiences, 3000);
				
				function updateAudiences()
				{
					$.ajax
					({
						url:'users/control/live_polls.php',
						method:'POST',
						data:{ session_audience_count:1, live_session_id:live_session_id },
						success:function(data)
						{
							$('#audience_count').html(data);
						}
					});
				}
				
				setInterval(updatePolls, 3000);
				
				function updatePolls()
				{
					$.ajax
					({
						url:'users/control/live_polls.php',
						method:'POST',
						data:{ update_polls:1, live_session_id:live_session_id, user_key:user_key },
						success:function(data)
						{
							$('#poll-questions').html(data);
						}
					});
				}
				
				function clearConsole()
				{
					console.log(window.console);
					
					if(window.console || window.console.firebug)
					{
						console.clear();
					}
				}
				
			});
		</script>
	</body>
</html>