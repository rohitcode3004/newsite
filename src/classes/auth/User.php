<?php
namespace Newsite\Login;
/*
* Author: Rohit Kumar
* Website: iamrohit.in
* Version: 0.0.1
* Date: 27-09-2015
* App Name: PHP-Auth
* Description: Simple oops based login and registration script with exceptional handling in php and mysql.
*/
class User extends dbconfig {
 
   public static $data;
 
   function __construct() {
     parent::__construct();
   }
 
 // Create new user/signup
   public static function addNewUser($userData) {
    //$r = new \Exception();
    //print_r($r);die();
     try {
       //print_r($userData);die('gg');
       $checkEmpty = self::checkEmpty($userData);
       $checkCpass = self::checkCpass($userData['password'], $userData['cpassword']);
       //$checkPass = self::checkPass($userData);
       $check = self::checkUserExist($userData['username']);
       if($check['status'] == 'error') {
       $data = $check;
       } elseif ($checkEmpty['status'] == 'error') {
        $data = $checkEmpty;
       }elseif ($checkCpass['status'] == 'error') {
        $data = $checkCpass;
       }else
         {
       $query = "INSERT INTO users (name, username, password) ";
       $query .= "VALUES ('".$userData['name']."', '".$userData['username']."', '".md5($userData['password'])."')";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new \Exception("Error to create new user.");
       }       
       $data = array('status'=>'success', 'msg'=>"You have been registered successfully login now.", 'result'=>'');
      }
     } catch (\Exception $e) {
       $data = array('status'=>'error', 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

     // Check empty fields
     public static function checkEmpty($userData) {
      try {
        if($userData['name'] == ''){
        throw new \Exception("Name is required");
       }
       if($userData['password'] == ''){
        throw new \Exception("Password is required");
       }
       if($userData['cpassword'] == ''){
        throw new \Exception("Confirm your password");
       }
       if($userData['username'] == ''){
        throw new \Exception("Username is required");
       }
       $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
      } catch (\Exception $e) {
        //echo "in catch";die('c');
       echo  $data = array('status'=>'error', 'msg'=>$e->getMessage()); 
      } finally {
         return $data;
      }
    }

    // Check empty fields
    public static function checkCpass($password, $cpassword) {
      //echo $password."P".$cpassword;die();
      try {
        if(!($password === $cpassword)){
        throw new \Exception("Password and confirm password do not matched");
       }
       $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
      } catch (\Exception $e) {
        //echo "in catch";die('c');
       echo  $data = array('status'=>'error', 'msg'=>$e->getMessage()); 
      } finally {
         return $data;
      }
    }
 
  // Check if user already exist
   public static function checkUserExist($username) {
     try {
       //die($username);
       $query = "SELECT username FROM users WHERE username = '".$username."'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new \Exception("Error in query!");
       }
       $count = mysqli_num_rows($result); 
       if($count>0) {
         //die('already');
          throw new \Exception("Username already exist.");
       }       
       $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
     } catch (\Exception $e) {
       //echo "in catch";die('c');
      echo  $data = array('status'=>'error', 'msg'=>$e->getMessage()); 
     } finally {
        return $data;
     }
   }
 
// Check if username/password is incorrect
   public static function checkUser($username, $password) {
     try {
       $query = "SELECT username FROM users WHERE username = '".$username."' and password = '".md5($password)."'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new \Exception("Error in query!");
       }
       $count = mysqli_num_rows($result); 
       if($count == 0) {
          throw new \Exception("Username/Password is incorrect.");
       }        
       $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
     } catch (\Exception $e) {
      echo  $data = array('status'=>'error', 'msg'=>$e->getMessage()); 
     } finally {
        return $data;
     }
   }
 
  // login function
   public static function login($username, $password) {
     try {
        $check = self::checkUser($username, $password);
       if($check['status'] == 'error') {
       $data = $check;
       } else {
       $query = "SELECT id FROM users WHERE username = '".$username."' AND password = '".md5($password)."'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new \Exception("Error in query!");
       }
       $resultSet = mysqli_fetch_assoc($result);         
       $data = array('status'=>'success', 'msg'=>"User detail fetched successfully.", 'result'=>$resultSet);
      }
     } catch (\Exception $e) {
       $data = array('status'=>'error', 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }
 
  // Get user information by userid
  public static function getUserById($id) {
     try {
       $query = "SELECT * FROM users WHERE id=".$id;
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Error in query");
       }
       $resultSet = mysqli_fetch_assoc($result); 
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"User detail fetched successfully", 'result'=>$resultSet);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }
 
}