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
		<title>SUPER POLLING &raquo; Home</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		
		<?php
			require_once('assets/navigation_bar/navbar.php');
		?>
		
		<div class="container">
			<br />
			<br />
			<div class="row">
				<div class="col-md-6">
					<h2><strong>Live Polling System</strong></h2>
					<br />
					<p class="text-dark-grey" style="line-height: 26px; letter-spacing: 0.2px;">
						A Presenter wants to get opinions from the audience. 
						<br />
						The audiences may be too shy to answer out loud.
						<br />
						Hence a <strong>Live Polling System</strong> may the answer to getting participation from the crowd.
						<br />
						<br />
						At the end of presentation, the presenter is able to display the results or opinions of all the questions asked
						during the presentation.
					</p>
					<br />
					<br />
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-success btn-block btn-lg" href="?pg=signup"><i class="fa fa-chalkboard-teacher fa-fw"></i> &nbsp;GET STARTED</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-primary btn-block btn-lg" href="?pg=enter_session"><i class="fa fa-vote-yea fa-fw"></i> &nbsp;JOIN SESSION</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="assets/images/cover.jpg" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); border-radius: 10px;" />
				</div>
			</div>
		</div>
		<br />
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	</body>
</html>