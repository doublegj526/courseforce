<?php
	function loggedin(){
		return isset($_SESSION['id']);
	}
	function user_exists($username,$dbc){
		$username = sanitize($username);
		$response = @mysqli_query($dbc, "SELECT COUNT(*) FROM students WHERE username='" . $username . "'");
		$row = @mysqli_fetch_array($response);
		$num = $row[0];
		return ($num == 1) ? true : false;
	}
	function user_active($username,$dbc){
		$username = sanitize($username);
		$response = @mysqli_query($dbc, "SELECT COUNT(*) FROM students WHERE active=1 AND username='" . $username . "'");
		$row = @mysqli_fetch_array($response);
		$num = $row[0];
		return ($num == 1) ? true : false;
	}
	function user_id($username,$dbc){
		$username = sanitize($username);
		$response = @mysqli_query($dbc, "SELECT facebook_id FROM students WHERE username='" . $username . "'");
		$row = @mysqli_fetch_array($response);
		return $row[0];
	}
	function match($username,$password,$dbc){
		$username = sanitize($username);
		$userid = user_id($username,$dbc);
		$password = md5($password);
		$response = @mysqli_query($dbc, "SELECT COUNT(*) FROM students WHERE username='" . $username . "' AND password='" . $password . "'");
		$row = @mysqli_fetch_array($response);
		return ($row[0] == 1) ? $userid : false;
	}
	
?>