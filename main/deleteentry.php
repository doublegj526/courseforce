<?php
	require_once('../includes/mysqli_connect.php');
    $dummy = trim($_POST['dummy']);
    $sql = "DELETE FROM classlog WHERE facebook_id=1 && class_id='" . $dummy . "'";

    if (@mysqli_query($dbc, $sql)) {
        $query = "SELECT department,class_number,class_name FROM classes WHERE class_id=" . $dummy;
        $response = @mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($response);
        echo "<p class=\"text-center\">" . $row['department'] . ' ' . $row['class_number'] . ': ' . $row['class_name'] . " removed successfully</p>";
    } else {
        echo "<p class=\"text-center\">Error deleting record: " . mysqli_error($dbc) . "</p>";
    }
?>