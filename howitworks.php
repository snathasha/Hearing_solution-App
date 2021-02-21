<?php
	if(!defined('HowItWorks'))
	{
		$h=str_replace("howitworks.php","?pg=home",$_SERVER['PHP_SELF']);
		header('Location:'.$h);
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
		<style>
			.navbar-nav li
			{
				padding-right: 2px;
				padding-left: 2px;
			}
		</style>
		<title>SUPER POLLING &raquo; How It Works ?</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		
		<?php
			require_once('assets/navigation_bar/navbar.php');
		?>
		
		<br />
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br />
					<br />
					<h3><strong>How It Works ?</strong></h3>
					<br />
					<p>
						It is as Simple as it says. One who hosts a Session is known as Presenter and one who present their opinions are Voters.
					</p>
					<br />
					<div class="row">
						<div class="col-md-6">
							<div class="card border-info">
								<div class="card-body">
									<h5><strong><i class="fa fa-chalkboard-teacher fa-fw fa-lg"></i> &nbsp;As a Presenter</strong></h5>
									<br />
									<p class="text-dark-grey">
										Create Live Polling Sessions, post Polls and let opinions flow in instantly.
										You need to share the Session ID of the hosted Polling Session in order to let audiences join in.
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card border-info">
								<div class="card-body">
									<h5><strong><i class="fa fa-vote-yea fa-fw fa-lg"></i> &nbsp;As a Voter</strong></h5>
									<br />
									<p class="text-dark-grey">
										Join Live Polling Sessions, produce your opinion instantly. 
										You need to have a Session ID (can also be called as Session Key) that will be provided to you by Presenter.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<br />
			<br />
			<br />
			<br />
			<br />
		</div>
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	</body>
</html>