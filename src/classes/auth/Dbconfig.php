<?php
namespace Newsite\Login;

class Dbconfig{
    protected static $host = '';
    protected static $username = 'root';
    protected static $password = "rohit";
    protected static $dbname = "php-auth";

    static $con;

    function __construct() {
    self::$con = self::connect(); 
  }

  protected static function connect()  {
    try {
        $link = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname); 
         if(!$link) {
           throw new \Exception(mysqli_error($link));
         }
         return $link;
      } catch (\Exception $e) {
        echo "Error: ".$e->getMessage();
      }
  }

  public static function close() {
    mysqli_close(self::$con);
 }

 public static function run($query) {
    try {
      if(empty($query) && !isset($query)) {
        throw new \Exception("Query string is not set.");
      }
      $result = mysqli_query(self::$con, $query);
      //self::close();
     return $result;
    } catch (\Exception $e) {
      echo "Error: ".$e->getMessage();
    }
 
  } 
}
?>