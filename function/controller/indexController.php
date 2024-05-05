<?php
include '../model/Index.php';

class indexController{
   public function dataindex(){
      // die('aa');
      $model = new Index;
      $data = $model->get_user();

      echo json_encode($data);
   }
}

$ctrl = new indexController;
if ($_GET['func'] == 'dataindex') {
   return $ctrl->dataindex();
}