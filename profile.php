<?php 
//die('jh');
session_start(); ?>
<!DOCTYPE html>
<?php include_once('header.php');  
//require_once('classes/userClass.php');
require_once('./vendor/autoload.php');
$userObj = new Newsite\Login\User(); 
//$userObj = new USER();
$userInfo = $userObj->getUserById($_SESSION['result']['id']);
//echo ""; print_r($userInfo); exit;
 ?>
<div class="panel panel-primary" style="width:35%;margin:0 auto; margin-top:2%">
<div class="panel-heading"><h3>User Profile</h3></div>
<div class="panel-body" style="height:40%; text-align:center;" >
<p class="bg-info" id="msg"></p>
 <form class="form-horizontal" role="form" id="signupForm" method="post" action="function.php?formType=signup">
 <div class="form-group">
    <label class="control-label col-sm-3" for="name">Name:</label>
    <div class="col-sm-9">
     <?php echo $userInfo['result']['name']; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="username">Username:</label>
    <div class="col-sm-9">
      <?php echo $userInfo['result']['username']; ?>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-3" for="password">Password:</label>
    <div class="col-sm-9">
      <?php echo $userInfo['result']['password']; ?>
    </div>
  </div>
  <div class="form-group">
      <a href="function.php?type=logout" class="btn btn-primary btn-lg" style="width:90%; margin-top:5px;">
         <span class="glyphicon glyphicon-home" ></span> Logout
      </a>
  </div>
</form>
</div>
</div>
<?php include_once('footer.php'); ?>