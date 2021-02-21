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
		<link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
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
		<title>Super Polling &raquo; History</title>
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
					<h3>Session History</h3>
					<br />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive-sm">
						<table class="table table-hover" id="view_history_table">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Topic</th>
									<th scope="col">Session ID</th>
									<th scope="col">Duration</th>
									<th scope="col">Start Time</th>
									<th scope="col">End Time</th>
									<th scope="col">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$slno = 1;
									if(generateSessionsHistory($user_details['user_id']))
									{
										foreach(generateSessionsHistory($user_details['user_id']) as $end_session)
										{
											echo '<tr>
													<th>'.$slno++.'</th>
													<td>'.$end_session['session_topic'].'</td>
													<td>'.$end_session['session_id'].'</td>
													<td>'.(gmdate("H:i:s", (strtotime($end_session['session_end_time'])) - (strtotime($end_session['session_start_time'])))).'</td>
													<td>
														'.date("jS F Y", strtotime($end_session['session_start_time'])).'
														<br />
														'.date("g:i:s a", strtotime($end_session['session_start_time'])).'
													</td>
													<td>
														'.date("jS F Y", strtotime($end_session['session_end_time'])).'
														<br />
														'.date("g:i:s a", strtotime($end_session['session_end_time'])).'
													</td>
													<td><a class="btn btn-success" href="?pg=session_result&user_key='.$_GET['user_key'].'&session_room='.$end_session['session_id'].'" target="_blank">VIEW DETAILS</a></td>
												</tr>';
										}
									}
									else
										echo '<tr><td colspan="7"><h6 class="text-center text-muted">You have not Created any Sessions yet.</h6></td></tr>';
								?>
							</tbody>
						</table>
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
							<input type="text" class="form-control" id="session_topic" placeholder="Enter Session Topic">
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
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/datatables.min.js"></script>
		<script>
			$(document).ready(function(){
				
				$('#view_history_table').DataTable();
			});
		</script>
	</body>
</html>