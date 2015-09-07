<?php
	require_once('../core/init.php');
	if(empty($_POST) === false){
		require_once('../includes/mysqli_connect.php');
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$concentration = $_POST['concentration'];
		if (empty($first_name)){
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter a first name. <a href="editprofile.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($last_name))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter a last name. <a href="editprofile.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($email))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter an email. <a href="editprofile.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else if(empty($concentration))
		{
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>
			<p style="text-indent: 5em;">You did not enter a concentration. <a href="editprofile.php" >Try again?</a></p>';
			require_once('../includes/footer.php');
		}
		else{
			$response = @mysqli_query($dbc, "UPDATE students SET first_name='" . $first_name . "',last_name='" . $last_name . "',email='" . $email . "',concentration='" . $concentration . "' WHERE facebook_id='" . $_SESSION['user_id'] . "'");
			require_once('../includes/header.php');
			echo '<div class="col-xs-12" style="height:75px;"></div>';
			if($response){
				echo '<p style="text-indent: 5em;">Changes made successfully. <a href="index.html" >Return Home?</a></p>';
			}
			else{
				echo '<p style="text-indent: 5em;">Changes couldn\'t be made. <a href="editprofile.php" >Try again?</a></p>';
			}
			require_once('../includes/footer.php');
		}
		mysql_close($dbc);
	}
?>