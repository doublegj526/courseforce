<?php
  require_once('../core/init.php');
  require_once('../includes/header.php');
  ?>
  <div class="col-xs-12" style="height:75px;"></div>
    
<div class="row">
      <div class="col-lg-1"></div>
<b>Edit Profile</b>
</div>
<div class="col-xs-12" style="height:50px;"></div>
<form action="editprofile2.php" method="post">
  <div class="row">
      <div class="col-lg-1"></div>
    <div class="form-group col-lg-3">

      <?php 
        require_once('../includes/mysqli_connect.php');
        $response = @mysqli_query($dbc, "SELECT first_name,last_name,email,concentration FROM students WHERE facebook_id='" . $_SESSION['user_id'] . "'");
        $row = @mysqli_fetch_array($response);

        echo '<label>First Name</label>
                  <input type="text" class="form-control" name="first_name" placeholder="First Name" size="30" value="' . $row['first_name'] . '">
                </div>
              
              <div class="form-group col-lg-3">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" size="30" value="' . $row['last_name'] . '">
              </div>
              </div>
              <div class="row">
                  <div class="col-lg-1"></div>
                <div class="form-group col-lg-3">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Email" size="30" value="' . $row['email'] . '">';
      ?>

      
    </div>
  </div>
  <?php
    	$result = @mysqli_query($dbc,'SHOW COLUMNS FROM students WHERE FIELD=\'concentration\'');
	    if($result){
        $concentration = $row['concentration'];
	    	  echo '<div class="row"> <div class="col-lg-1"></div>
	    	  		<div class="form-group col-lg-6">
	    	  		<label>Concentration</label>
	    	  		<select class="form-control" name="concentration">';
			  echo '<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			    Concentration
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
			    while ($row=mysqli_fetch_row($result))
			      {
			         foreach(explode("','",substr($row[1],6,-2)) as $v)
			         {
                 if($v == $concentration){
                   echo "<option selected>$v</option>";
                 }
                 else{
                    echo "<option>$v</option>";
                 }
			         }
			      }
				echo '</select>';
				echo '</div>';
				echo '</div>';
	    }
	    else{
	      echo "Couldn't issue database query<br />";
	      echo mysqli_error($dbc);
	    }
      mysql_close($dbc);
      ?>
  <div class="col-xs-12" style="height:25px;"></div>
  <div class="row">
  <div class="col-lg-1"></div>
  <div class="form-group col-lg-3">
  <input class="btn btn-primary" type="submit" name="submit" value="Save Changes" />
  </div>
  </div>
</form>
<?php
    
  require_once('../includes/footer.php');
?>