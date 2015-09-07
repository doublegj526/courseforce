<?php
  require_once('../core/init.php');
  require_once('../includes/header.php');

  ?>
  <div class="col-xs-12" style="height:75px;"></div>
    
<div class="row">
      <div class="col-lg-1"></div>
<b>Change Password</b>
</div>
<div class="col-xs-12" style="height:50px;"></div>
<form action="changepassword2.php" method="post">
  <div class="row">
      <div class="col-lg-1"></div>
    <div class="form-group col-lg-3">
      <label>Old Password</label>
      <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" size="30" value="">
    </div>
  </div>
  <div class="row">
      <div class="col-lg-1"></div>
    <div class="form-group col-lg-3">
      <label>New Password</label>
      <input type="password" class="form-control" name="newpassword" placeholder="New Password" size="30" value="">
    </div>
  </div>
  <div class="row">
      <div class="col-lg-1"></div>
    <div class="form-group col-lg-3">
      <label>New Password Confirmation</label>
      <input type="password" class="form-control" name="newpasswordconfirmation" placeholder="New Password Confirmation" size="30" value="">
    </div>
  </div>
 
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