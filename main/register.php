<?php
  echo '<!DOCTYPE html>
<html>
  <head>
    <title>Course Force</title>
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
  </head>
  <body>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : \'732364916872693\',
          xfbml      : true,
          version    : \'v2.4\'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, \'script\', \'facebook-jssdk\'));
    </script>
    <script src = "js/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>
     <div class = "navbar navbar-default navbar-fixed-top">
      <div class = "container">
        <a href = "index.html" class = "navbar-brand">
          Course Force
        </a>
        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
        </button>
        <div class = "collapse navbar-collapse navHeaderCollapse">
          <ul class = "nav navbar-nav navbar-right">
            <li class = "active"><a href = "index.html">My Courses</a></li>
            <li><a href = "#">Message Board</a></li>
            <li class = "dropdown">
              <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Options<b class = "caret"></b></a>
              <ul class = "dropdown-menu">
                <li><a href = "editprofile.php">Edit Profile</a></li>
                <li><a href = "requirements.php">View Requirements</a></li>
                <li><a href = "#">See My Posts</a></li>
                <li><a href = "logout.php">Logout</a></li>
              </ul>
            </li>
            <li><a href = "about.html">About</a></li>
            <li><a href = "#contact" data-toggle="modal">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </div>';
?>
    <div class="col-xs-12" style="height:75px;"></div>
<div class="row">
      <div class="col-lg-1"></div>
<b>Register</b>
</div>
<div class="col-xs-12" style="height:50px;"></div>
<form>
  <div class="row">
      <div class="col-lg-1"></div>
	  <div class="form-group col-lg-3">
	    <label>First Name</label>
	    <input type="text" class="form-control" name="first_name" placeholder="First Name" size="30" value="">
	  </div>
  <div class="form-group col-lg-3">
    <label>Last Name</label>
    <input type="text" class="form-control" name="last_name" placeholder="Last Name" size="30" value="">
  </div>
  </div>
  <div class="row">
    <div class="col-lg-1"></div>
  <div class="form-group col-lg-3">
    <label>Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" size="30" value="">
  </div>
  </div>
   <div class="row">
    <div class="col-lg-1"></div>
  <div class="form-group col-lg-3">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" size="30" value="">
  </div>
  <div class="form-group col-lg-3">
    <label>Password Confirmation</label>
    <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" size="30" value="">
  </div>
  </div>
  <div class="row">
    <div class="col-lg-1"></div>
  <div class="form-group col-lg-3">
    <label>Email</label>
    <input type="text" class="form-control" name="email" placeholder="Email" size="30" value="">
  </div>
  </div>
  <?php
    	require_once('../includes/mysqli_connect.php');
    	$result = @mysqli_query($dbc,'SHOW COLUMNS FROM students WHERE FIELD=\'concentration\'');
	    if($result){
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
			           echo "<option>$v</option>";
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
	?>
  <div class="col-xs-12" style="height:25px;"></div>
  <div class="row">
  <div class="col-lg-1"></div>
  <div class="form-group col-lg-3">
  <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
  </div>
  </div>
</form>
<?php
  require_once('../includes/footer.php');
?>