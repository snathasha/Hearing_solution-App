<?php

	// Checking for Previous Audience if he/she has left the session in middle so he/she can continue.
	foreach(getAudienceDetailsBySessionandKey($_GET['live_session_id'], $_GET['audience_key']) as $audience_details)
	{ }
	
	if($audience_details['audience_visit_status'] == "0")
	{
		// Updating the Audience First Visit
		updateAudienceFirstVisit($_GET['live_session_id'], $_GET['audience_key']);
		header('Location:?pg=live_session_room&live_session_id='.$_GET['live_session_id'].'&audience_key='.$_SESSION['audience_key']);
	}
	else
	{
		if(generateSessionInfotoAudience($_GET['live_session_id']))
		{	
			// Getting Session Information to Audience
			foreach(generateSessionInfotoAudience($_GET['live_session_id']) as $currentSessionInfo)
			{ }
			
			// Getting Presenter Information to Audience
			foreach(generateSessionPresenter($currentSessionInfo['user_id']) as $presenter_details)
			{ }
			
			if($currentSessionInfo['session_live_status'] == '0')
				header('Location: ?pg=logout');
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
				height: 14px;
				width: 14px;
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
		<title>Super Polling &raquo; Session Room</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
			<a class="navbar-brand fredoka" href="<?php echo base() ?>">
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
						<a class="btn btn-danger btn-block" href="?pg=logout"><i class="fa fa-sign-out-alt fa-fw fa-lg"></i> &nbsp;EXIT SESSION</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<br />
					<div class="row">
						<div class="col-md-6">
							<p class="no-td-space text-dark-grey">Hello Voter</p>
							<h3>Welcome Back</h3>
							<p class="p-large">
								You can continue your session where you Last Left.
							</p>
						</div>
						<div class="col-md-6">
							<br />
							<h5><div class="blob red" style="position: absolute; top: 26px;"></div> &nbsp;&nbsp;&nbsp; Ongoing Live Session</h5>
							<hr />
							<div class="row">
								<div class="col-md-12">
									<div class="card border-success">
										<div class="card-body">
											<h5><?php echo $currentSessionInfo['session_topic']; ?></h5>
											<p class="no-td-space"><?php echo $presenter_details['first_name'].' '.$presenter_details['last_name']; ?></p>
											<p class="text-success p-detail">Session ID: <?php echo $_GET['live_session_id']; ?></p>
											<div class="row">
												<div class="col-md-6">
													<p class="text-dark-grey p-detail no-td-space"><strong>Started On:</strong></p>
													<p class="text-muted p-detail no-td-space"><?php echo date('jS F Y', strtotime($currentSessionInfo['session_creation_time'])) ?></p>
													<p class="text-muted p-detail"><?php echo date('g:i a', strtotime($currentSessionInfo['session_creation_time'])) ?></p>
												</div>
												<div class="col-md-6">
													<p class="text-dark-grey p-detail no-td-space"><strong>Live Duration:</strong></p>
													<p class="text-muted p-detail no-td-space" id="live-duration-time"> -- </p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a class="btn btn-success btn-block" href="?pg=live_session_room&live_session_id=<?php echo $_GET['live_session_id']; ?>&audience_key=<?php echo $_SESSION['audience_key']; ?>">CONTINUE SESSION</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br />
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		
		<br />
		<br />
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
		
		<script>
			var live_session_id = '<?php echo $_GET['live_session_id']; ?>';
			var audience_key = '<?php echo $_GET['audience_key']; ?>';
			var currentSessionStatus = "<?php echo $currentSessionInfo['session_live_status']; ?>";
			
			$(document).ready(function(){
				
				setInterval(update_questions, 3000);
				
				function update_questions()
				{
					$.ajax({
						url:'audience/control/refresh_poll.php',
						method:'POST',
						data:{ update_poll_questions:1, live_session_id:live_session_id, audience_key:audience_key },
						success:function(data)
						{
							console.log('Updated');
							$('#poll-questions-audience').html(data);
						}
					});
					
					if(currentSessionStatus != "2")
					{
						$.ajax({
							url:'audience/control/refresh_poll.php',
							method:'POST',
							data:{ check_session_status:1, live_session_id:live_session_id },
							success:function(data)
							{
								if(data == 1)
									location.reload();
							}
						});
					}
				}
				
				$(document).on('click', '.btn-vote', function(){
					
					var vote_choice = $(this).attr('data-choice');
					var audience_key = $(this).attr('data-audience-key');
					var live_session_id = $(this).attr('data-live-session-id');
					var live_question_id = $(this).attr('data-live-question-id');
					
					$.ajax
					({
						url:'audience/control/refresh_poll.php',
						method:'POST',
						data:{ answer_poll_question:1, vote_choice:vote_choice, audience_key:audience_key, live_session_id:live_session_id, live_question_id:live_question_id },
						success:function(data)
						{
							alert(data);
							$('#poll-questions-audience').html(data);
						}
					});
				});
			});
		</script>
		<script>
			// Set the date we're counting down to
			var countDownDate = new Date("<?php echo date('d M Y h:i a', strtotime($currentSessionInfo['session_start_time'])); ?>").getTime();
			
			// Update the count down every 1 second
			var x = setInterval(function(){
				
				// Get today's date and time
				var now = new Date().getTime();
				
				// Find the distance between now and the count down date
				var distance = now - countDownDate;
				
				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
				// Display the result in the element with id="demo"
				if(days == 0)
				{
					if(hours == 0)
						document.getElementById("live-duration-time").innerHTML = minutes + " min " + seconds + " secs ";
					else
						document.getElementById("live-duration-time").innerHTML = hours + " hr " + minutes + " min " + seconds + " secs ";
				}
				else
					document.getElementById("live-duration-time").innerHTML = days + " days " + hours + " hr " + minutes + " min " + seconds + " secs ";
				
				// If the count down is finished, write some text
				if (distance < 0)
				{
					clearInterval(x);
					document.getElementById("live-duration-time").innerHTML = "EXPIRED";
				}
			}, 1000);
		</script>
	</body>
</html>