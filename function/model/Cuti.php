<?php
class Cuti {

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

   function getData($params) {
      if ($params['role'] == '100' || $params['role'] == '101') {
         $where = "";
      } else {
         $where = "AND CREATED_BY = '{$params['fullname']}'";
      }
      
      $sql = "SELECT * FROM cuti WHERE 1 = 1 {$where}";

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

   function paramsAddDataCuti($jenis_cuti, $tanggal_mulai, $tanggal_akhir, $pesan, $created_by){
      $params = [
         'jenis_cuti' => $jenis_cuti,
         'tanggal_mulai' => $tanggal_mulai,
         'tanggal_akhir' => $tanggal_akhir,
         'pesan' => $pesan,
         'created_by' => $created_by
      ];

      return $this->addDataCuti($params);
   }

   function addDataCuti($params) {
      // var_dump($params);die();
      $sql = "INSERT INTO cuti (JENIS_CUTI, TANGGAL_MULAI, TANGGAL_AKHIR, STATUS, KETERANGAN, CREATED_BY, CREATED_DATE) VALUES (
         '{$params['jenis_cuti']}', 
         '{$params['tanggal_mulai']}', 
         '{$params['tanggal_akhir']}', 
         'Need Approval', 
         '{$params['pesan']}', 
         '{$params['created_by']}', 
         SYSDATE() 
         )";

      // var_dump($sql);die();
      try {
         $result = $this->conn->query($sql);
         return 'true';
      } catch (Exception $e) {
         die('Error executing query: ' . $e->getMessage());
      }
   }
}

class ExtendedCuti extends Cuti {

   function getData($params) {
      $sql = "SELECT * FROM cuti WHERE STATUS = 'Approved' AND role = '{$params['role']}'";
      
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