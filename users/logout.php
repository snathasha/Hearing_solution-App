<?php

	
	// logout
		$_SESSION=array();
		session_destroy();
		
		header('Location:?pg=home');

?>