<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
			<a class="navbar-brand fredoka" href="?pg=dashboard&user_key=<?php echo $_SESSION['user_key']; ?>">
				<div class="logo">
					<h4>Super Polling</h4>
				</div>
			</a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-create-room">
							CREATE A SESSION
						</button>
					</li>
					<li class="nav-item">
						<a class="btn btn-warning btn-block" href="?pg=view_history&user_key=<?php echo $_GET['user_key']; ?>">VIEW HISTORY</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-danger btn-block" href="?pg=logout">LOGOUT</a>
					</li>
				</ul>
			</div>
		</nav>