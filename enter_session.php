<?php
	
	require_once('db/init.php');
	
	$msg = "";
	
	if(isset($_POST['enter_session']))
	{
		$live_session_id = $_POST['live_session_id'];
		$msg = "";
		
		if(!empty($live_session_id))
		{
		
			if(checkRoomExistence($live_session_id))
			{
				foreach(checkRoomExistence($live_session_id) as $session_room_details)
				{ }
				
				if($session_room_details['session_live_status'] == '0')
				{
					$msg = "The Presenter hasn't started the Session Yet!";
				}
				else if($session_room_details['session_live_status'] == '1')
				{
					$audience_ip = getAudienceIPAddress();
					
					if(checkAudienceExistence($audience_ip, $live_session_id))
					{
						foreach(getAudienceDetailsByIP($audience_ip) as $audience_details)
						{ }
						echo "Hello";
						$_SESSION['audience_key'] = $audience_details['audience_key'];
						header('Location:?pg=session_room&live_session_id='.$live_session_id.'&audience_key='.$_SESSION['audience_key']);
					}
					else
					{
						$audience_id = audienceIdGenerator();
						$audience_key = audienceKeyGenerator();
					
						createAudience($live_session_id, $audience_id, $audience_key, $audience_ip);
					
						$_SESSION['audience_key'] =  $audience_key;
						header('Location:?pg=session_room&live_session_id='.$live_session_id.'&audience_key='.$_SESSION['audience_key']);
					}
				}
				else if($session_room_details['session_live_status'] == '2')
				{
					$msg = "The Session has already Ended!";
				}
			}
			else
				$msg = "Please, Recheck your Session ID.";
		}
		else
			$msg = "Enter Session ID";
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
		<title>Super Polling &raquo; Join Session</title>
	</head>
	<body class="d-flex flex-column min-vh-100">
		<?php
			require_once('assets/navigation_bar/navbar.php');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<br />
					<div class="card">
						<div class="card-body">
							<h4 class="no-td-space">Join Session</h4>
							<p class="text-muted p-small">Enter Session ID to continue</a></p>
							<br />
							<form action="" method="POST">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter Session ID" maxlength="24" name="live_session_id" value="<?php if(isset($live_session_id)) echo $live_session_id; ?>" />
									<?php
										if(!empty($msg))
											echo '<p class="text-center text-danger p-detail">'.$msg.'</p>';
										else
											echo '<p class="text-center text-danger p-detail">&nbsp;</p>';
									?>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-primary btn-block" name="enter_session">Enter Session</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		
		<?php
			require_once('assets/footer_bar/footer.php');
		?>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	</body>
</html>