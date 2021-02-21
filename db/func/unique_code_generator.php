<?php

	//for generating unique public post ID
	function generate_unique_id()
	{
		$cur_year = date('y');  // date('y')
		$cur_month = date('m');
		$cur_day = date('d');
		$random_number = rand(100000 , 999999);
		$user_key = $random_number.$cur_month.$cur_day.$cur_year;
		
		return $user_key;
	}
	
	function generate_random_number()
	{
		$random_number = rand(1000, 9999);
		
		return $random_number;
	}
	
	//Random String Generator-----------------------------------------------------------
	function randomString()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 20; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function userIDGenerator()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 20; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'user'.$randomString;
	}
	
	function sessionIdGenerator()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 12; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'sess'.$randomString;
	}
	
	function liveQuestionIdGenerator()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 12; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'liveques'.$randomString;
	}
	
	function audienceIdGenerator()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 12; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'aud'.$randomString;
	}
	
	function audienceKeyGenerator()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 12; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return 'audkey'.$randomString;
	}

?>