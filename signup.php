<?php
	if(!defined('Signup'))
	{
		$h=str_replace("signup.php","?pg=home",$_SERVER['PHP_SELF']);
		header('Location:'.$h);
	}
	
	include_once('db/init.php');
	$error1 = $error2 = $error3 = $error4 = $error5 = $msg = "";
	$fname = $lname = $email = $pwd = "";
	
	if(isset($_POST['signup']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		
		$error1 = $error2 = $error3 = $error4 = $error5 = $error6 = $msg = "";
		
		if(empty($fname) || empty($lname) || empty($email) || empty($pwd))
		{
			$error1 = "Empty Fields!";
		}
		
		if(empty($fname))
		{
			$error2 = "Name cannot be empty!";
		}
		
		if(empty($lname))
		{
			$error3 = "Name cannot be empty!";
		}
		
		if(empty($email))
		{
			$error4 = "Empty Email!";
		}
		
		if(emailExistenceCheck($email))
		{
			$error5 = "Email Already Exist!";
		}
		
		if(empty($pwd))
		{
			$error6 = "Empty Password!";
		}
		
		if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5) && empty($error6))
		{
			signup($fname, $lname, $email, $pwd);
			$msg = "Account Created. Log In to continue.";
			$fname = $lname = $email = $pwd = "";
		}
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
		<title>Super Polling &raquo; Create Account</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<br />
					<h4 class="text-center"><a href="?pg=home" style="text-decoration: none;"><strong>SUPER POLLING</strong></a></h4>
					<div class="card">
						<div class="card-body">
							<h4 class="no-td-space">Create an Account</h4>
							<p class="text-muted p-small">Already have an Account ? <a href="?pg=login">Login</a></p>
							<form action="" method="POST">
								<?php
									if(!empty($error1))
										echo '<p class="text-center text-danger">'.$error1.'</p>';
									
									if(!empty($msg))
										echo '<p class="text-center text-success">'.$msg.'</p>';
								?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="formGroupExampleInput">First Name</label>
											<input type="text" class="form-control" id="formGroupExampleInput" maxlength="16" placeholder="First Name" value="<?php if(!empty($fname)) echo $fname; ?>" name="fname">
											<?php
												if(!empty($error2))
													echo '<p class="text-danger p-detail">'.$error2.'</p>';
											?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="formGroupExampleInput">Last Name</label>
											<input type="text" class="form-control" id="formGroupExampleInput" maxlength="16" placeholder="Last Name" value="<?php if(!empty($lname)) echo $lname; ?>" name="lname">
											<?php
												if(!empty($error3))
													echo '<p class="text-danger p-detail">'.$error3.'</p>';
											?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput2">Email</label>
									<input type="text" class="form-control" id="formGroupExampleInput2" maxlength="24" placeholder="Enter Email" value="<?php if(!empty($email)) echo $email; ?>" name="email">
									<?php
										if(!empty($error4))
											echo '<p class="text-danger p-detail">'.$error4.'</p>';
										if(!empty($error5))
											echo '<p class="text-danger p-detail">'.$error5.'</p>';
									?>
								</div>
								<div class="form-group">
									<label for="formGroupExampleInput2">Password</label>
									<input type="password" class="form-control" id="formGroupExampleInput2" maxlength="20" placeholder="Enter Password" name="pwd">
									<?php
										if(!empty($error6))
											echo '<p class="text-danger p-detail">'.$error6.'</p>';
									?>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-success btn-block" name="signup"><i class="fa fa-user fa-fw fa-lg"></i> &nbsp;Create an Account</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<br />
					<ul class="nav justify-content-center">
						<li class="nav-item">
							<a class="nav-link" href="?pg=howitworks">How it works ?</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?pg=about">About</a>
						</li>
					</ul>
					<p class=" text-dark-grey text-center p-detail">&copy; Super Polling 2021</p>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
	</body>
</html>