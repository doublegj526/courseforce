<?php
	require_once('../core/init.php');
	if(empty($_POST) === false){
		require_once('../includes/mysqli_connect.php');
		$oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		$newpasswordconfirmation = $_POST['newpasswordconfirmation'];
		if (empty($oldpassword)){
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter an old password. <a href="changepassword.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($newpassword))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter a new password. <a href="changepassword.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($newpasswordconfirmation))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter a new password confirmation. <a href="changepassword.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else{
			$response = @mysqli_query($dbc, "SELECT password FROM students WHERE facebook_id='" . $_SESSION['user_id'] . "'");
        	$row = @mysqli_fetch_array($response);
        	$password = $row[0];
        	$oldpassword = md5($oldpassword);
        	$newpassword = md5($newpassword);
        	$newpasswordconfirmation = md5($newpasswordconfirmation);
        	if(!($password === $oldpassword)){
        		require_once('../includes/header.php');
				echo '<div class="col-xs-12" style="height:75px;"></div>
				<p style="text-indent: 5em;">Your old password is incorrect. <a href="changepassword.php" >Try again?</a></p>';
				require_once('../includes/footer.php');
        	}
        	else if(!($newpassword === $newpasswordconfirmation)){
        		require_once('../includes/header.php');
				echo '<div class="col-xs-12" style="height:75px;"></div>
				<p style="text-indent: 5em;">Your old password is incorrect. <a href="changepassword.php" >Try again?</a></p>';
				require_once('../includes/footer.php');
        	}
        	else{
        		$response = @mysqli_query($dbc, "UPDATE students SET password='" . $newpassword . "' WHERE facebook_id='" . $_SESSION['user_id'] . "'");
				require_once('../includes/header.php');
				echo '<div class="col-xs-12" style="height:75px;"></div>';
				if($response){
					echo '<p style="text-indent: 5em;">Password changed successfully. <a href="index.html" >Return Home?</a></p>';
				}
				else{
					echo '<p style="text-indent: 5em;">Password couldn\'t be changed. <a href="changepassword.php" >Try again?</a></p>';
				}
				require_once('../includes/footer.php');
        	}
		}
		mysql_close($dbc);
	}
?>