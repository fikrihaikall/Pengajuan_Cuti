
<?php
session_start();
include '../model/Cuti.php';
// var_dump($_GET);die();
class cutiController{
   public function datacuti(){
      // die('aa');
      $params = [
         'role' => $_SESSION['role'],
         'fullname' => $_SESSION['fullname']
      ];
      
      $model = new Cuti;
      $data = $model->getData($params);

      echo json_encode($data);
   }
   
   public function addcuti(){
      // die('aa');
      // var_dump($_SESSION);die();
      $params = [

         'jenis_cuti' => $_POST['jenis_cuti'],
         'tanggal_mulai' => $_POST['tanggal_mulai'],
         'tanggal_akhir' => $_POST['tanggal_akhir'],
         'tanggal_akhir' => $_POST['tanggal_akhir'],
         'pesan' => $_POST['pesan'],
         'created_by' => $_SESSION['fullname']
      ];

      $model = new Cuti;
      $data = $model->addDataCuti($params);

      echo json_encode($data);
   }
}

$ctrl = new cutiController;
if ($_GET['func'] == 'datacuti') {
   return $ctrl->datacuti();
} elseif ($_GET['func'] == 'addcuti') {
   return $ctrl->addcuti();
}