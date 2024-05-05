<?php include '../layout/header.php';?>

 

<div class="card">
   <div class="p-4">
      <div class="text-center">
         <h1>Selamat datang <?= $_SESSION["fullname"]; ?></h1>
         <h3>sisa cuti anda $sisaCuti</h3>
      </div>
   </div>
</div>
         
<script>
   $(document).ready(function () {
      data();
   });
   function data() {
      $.ajax({
         type: 'post',
         dataType: 'json',
         url: '../function/controller/indexController.php?func=dataindex',
         success: function (response) {
            // console.log(response);

         }
      })
   }
</script>

<?php include '../layout/footer.php'; ?>
