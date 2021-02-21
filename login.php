<?php
	
	if(!defined('Login'))
	{
		$h=str_replace("login.php","?pg=home",$_SERVER['PHP_SELF']);
		header('Location:'.$h);
	}
	
	$msg = "";
	if(isset($_POST['login']))
	{
		$lemail = $_POST['lemail'];
		$lpwd = $_POST['lpwd'];
		
		$msg = "";
		
		if(login($lemail, $lpwd))
		{
			$_SESSION['user_key'] = randomString();
			echo $_SESSION['user_key'];
			setUserKey($lemail, $_SESSION['user_key']);
			header('Location:?pg=dashboard&user_key='.$_SESSION['user_key']);
		}
		else
			$msg = "Wrong Email or Password!";
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
		<title>Super Polling &raquo; Login</title>
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
							<h4 class="no-td-space">Welcome back</h4>
							<p class="text-muted p-small">Don't have an Account ? <a href="?pg=signup">Create One</a></p>
								<?php
									if(!empty($msg))
										echo '<p class="text-center text-danger">'.$msg.'</p>';
								?>
								<form action="" method="POST">
									<div class="form-group">
										<label for="formGroupExampleInput">Email</label>
										<input type="text" class="form-control" maxlength="24" id="formGroupExampleInput" placeholder="Enter Email" name="lemail">
									</div>
									<div class="form-group">
										<label for="formGroupExampleInput2">Password</label>
										<input type="password" class="form-control" maxlength="20" id="formGroupExampleInput2" placeholder="Enter Password" name="lpwd">
									</div>
									<div class="row">
										<div class="col-md-6">
											
										</div>
										<div class="col-md-6">
											<button class="btn btn-success btn-block" name="login"><i class="fa fa-sign-in-alt fa-fw fa-lg"></i> &nbsp;Let Me In</button>
										</div>
									</div>
								</form>
						</div>
					</div>
					<div class="col-md-4"></div>
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