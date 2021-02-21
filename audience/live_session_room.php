<?php
	
	if(generateSessionInfotoAudience($_GET['live_session_id']))
	{
		foreach(generateSessionInfotoAudience($_GET['live_session_id']) as $currentSessionInfo)
		{ }
		
		foreach(generateSessionPresenter($currentSessionInfo['user_id']) as $presenter_details)
		{ }
		
		if($currentSessionInfo['session_live_status'] == '0')
			header('Location: ?pg=logout');
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
		
		<?php
			if($currentSessionInfo['session_live_status'] == '1')
			{
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br />
					<p class="no-td-space text-dark-grey">Welcome Voter</p>
					<h3><div class="blob red" style="position: absolute; top: 54px;"></div> &nbsp;&nbsp;&nbsp; Session is Live</h3>
					<div class="row">
						<div class="col-md-8">
							<p class="no-td-space">Topic : <span class="text-primary"><?php echo $currentSessionInfo['session_topic']; ?></span></p>
							<p class="no-td-space">Presented By : <span class="text-primary"><?php echo $presenter_details['first_name'].' '.$presenter_details['last_name']; ?></span></p>
							<p class="no-td-space">Session ID : <span class="text-primary"><?php echo $_GET['live_session_id']; ?></span></p>
							<br />
						</div>
						<div class="col-md-4"></div>
					</div>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card border-info">
						<div class="card-body">
							<div id="poll-questions">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th scope="col">No.</th>
											<th scope="col">Questions</th>
											<th scope="col" class="text-center">Cast the Vote</th>
										</tr>
									</thead>
									<tbody id="poll-questions-audience">
										<tr>
											<td colspan="3"><h6 class="text-muted text-center">Loading your Session. . .</h6></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
			else
			{
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br />
					<p class="no-td-space text-dark-grey">Welcome Voter</p>
					<h3>Session is Over. <br />Thanks for Joining Us.</h3>
					<div class="row">
						<div class="col-md-8">
							<p class="no-td-space">Topic : <span class="text-primary"><?php echo $currentSessionInfo['session_topic']; ?></span></p>
							<p class="no-td-space">Presented By : <span class="text-primary"><?php echo $presenter_details['first_name'].' '.$presenter_details['last_name']; ?></span></p>
							<p class="no-td-space">Session ID : <span class="text-primary"><?php echo $_GET['live_session_id']; ?></span></p>
							<br />
						</div>
						<div class="col-md-4"></div>
					</div>
					<br />
				</div>
			</div>
		</div>
		<?php
			}
		?>
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
							$('#poll-questions-audience').html(data);
						}
					});
				});
			});
		</script>
	</body>
</html>