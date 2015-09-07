<?php
	require_once('../includes/mysqli_connect.php');
	$class_id = intval($_POST['class_id']);
    //echo '<p>' . $class_id . '</p>';
    $facebook_id = 1;
    $year = $_POST['grade'];
    $term = $_POST['term'];
	if(!($year == "---Grade---") and !($term == "---Term---")){

		$query = "INSERT INTO classlog (facebook_id, class_id, year, term) VALUES (?,?,?,?)";
	    
	    $stmt = mysqli_prepare($dbc, $query);
	    
	    //i Integers,d Doubles,b Blobs,s Everything Else
	    //mysqli_stmt_bind_param($stmt, "sss", $f_name, $l_name, $concentration);
	    
	    mysqli_stmt_bind_param($stmt,"iiss",$facebook_id,$class_id,$year,$term);
	    mysqli_stmt_execute($stmt);
	    $affected_rows = mysqli_stmt_affected_rows($stmt);
	    if($affected_rows == 1){
	        echo 'Student Entered';
	        mysqli_stmt_close($stmt);
	        //mysqli_close($dbc);
	    } else {
	        echo 'Error Occurred<br />';
	        echo '<p>' . mysqli_error() . '</p>';
	        mysqli_stmt_close($stmt);
	        //mysqli_close($dbc);
	    }
	}
	else{

	}
    mysqli_close($dbc);
?>