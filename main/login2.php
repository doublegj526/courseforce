<?php
	require_once('../core/init.php');
	if(empty($_POST) === false){
		require_once('../includes/mysqli_connect.php');
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (empty($username)){
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You forgot to enter your username. <a href="login.php" >Login again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($password))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You forgot to enter your password. <a href="login.php" >Login again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(user_exists($username,$dbc) === false){
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">Your username does not exist. <a href="register.php" >Register?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(user_active($username,$dbc) === false){
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">Your account is not activated yet. Please check your email to activate your account.</p>';
			require_once('../includes/footer.php');
		}
		else{
			$login = match($username,$password,$dbc);
			if($login === false){
				// username password combination is incorrect
				echo '<p>Your username password combination is incorrect</p>';
			}
			else{
				$_SESSION['user_id'] = $login;
				header("Location: index.html");
				exit();
			}
		}
		mysql_close($dbc);
	}
?>