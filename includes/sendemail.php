<?php
	if(isset($_POST['submit'])){
		$admin_email = 'jgee@college.harvard.edu';
		$subject = "sup nigga";
		$comment = trim($_POST['comment']);
		$email = trim($_POST['email']);
		mail($admin_email, "$subject", $comment, "From:" . $email);
	}
?>