<?php
include '../model/Index.php';

class indexController{
   public function dataindex(){
      // die('aa');
      $model = new Index;
      $data = $model->get_user();

      echo json_encode($data);
   }

   public function updatecuti(){
      // die('aa');
      // var_dump($_POST);die();
      $model = new Index;
      $data = $model->update_cuti($_POST);

      echo json_encode($data);
   }
}

$ctrl = new indexController;
if ($_GET['func'] == 'dataindex') {
   return $ctrl->dataindex();
} elseif ($_GET['func'] == 'approvalcuti') {
   return $ctrl->updatecuti();
}