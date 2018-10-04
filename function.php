<?php
//require_once('classes/userClass.php'); 
require_once('./vendor/autoload.php');
$userObj = new Newsite\Login\User();    //always need to instantiate a class wheather calling its static or non-static function
session_start();
$type = $_GET['type'];
 
//print_r($_REQUEST);die('yes');

if(empty($type) || !isset($type)) {
 
  echo 'Request type is not set';
 
} else if($type == 'signup') {
   $data =  Newsite\Login\User::addNewUser($_REQUEST);
   $_SESSION = $data;
   if($data['status'] == 'error') {
     header("location:register.php");
   } else {
     header("location:index.php");
   }
} else if($type == 'login') {
   $username = addslashes($_REQUEST['email']);
   $password = addslashes($_REQUEST['password']);
   //print_r($password);die();
   $_SESSION =  Newsite\Login\User::login($username, $password);
   //print_r($_SESSION);die();
   if($_SESSION['status'] == 'error') {
     header("location:index.php");
   } else {
     header("location:profile.php");
   }
 
} else if($type == 'logout') {
 unset($_SESSION);
 session_destroy();
 header("location:index.php");
}
 
?>