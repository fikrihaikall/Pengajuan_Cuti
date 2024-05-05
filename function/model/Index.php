<?php
class Index {

   private $conn;

   function __construct(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "ourdash";

      try {
         $this->conn = new mysqli($servername, $username, $password, $dbname);
      } catch (Exception $e) {
         die('Connection error: ' . $e->getMessage());
      }
   }

   function __destruct(){
      if ($this->conn) {
         $this->conn->close(); 
      }
   }

   function get_user(){
      $sql = "SELECT * FROM users";
      
      try {
         $result = $this->conn->query($sql);
         if ($result->num_rows > 0) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
         } else {
            return [];
         }
      } catch (Exception $e) {
         die('Error executing query: ' . $e->getMessage());
      }
   }

}