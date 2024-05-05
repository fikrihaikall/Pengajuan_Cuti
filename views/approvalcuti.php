<?php include '../layout/header.php';?>

 

<div class="card">
   <div class="p-4">
      <div class="text-center">
         <h1>Selamat datang <?= $_SESSION["fullname"]; ?></h1>
         <hr>
         <h3>Data Cuti</h3>
         <div class="row">
            <div class="col-md-12">
               <div>
                  <table id="myTable" class="table">
                     <thead>
                        <tr>
                           <th>Nama</th>
                           <th>Jenis Cuti</th>
                           <th>Tanggal Mulai</th>
                           <th>Tanggal Akhir</th>
                           <th>Keterangan</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody></tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function () {
      // data();
      $('#myTable').DataTable({
         ajax : {
            url : "../function/controller/cutiController.php?func=datacuti",
            dataSrc : ""
         },
         columns : [
            {data : "CREATED_BY"},
            {data : "JENIS_CUTI"},
            {data : "TANGGAL_MULAI"},
            {data : "TANGGAL_AKHIR"},
            {data : "KETERANGAN"},
            {
               data: "STATUS",
               render: function (data ,type, row, meta) {
                  let bgColor;
                  if (data == 'Need Approval') {
                     bgColor = 'bg-secondary';
                  } else if (data == 'Approved') {
                     bgColor = 'bg-success';
                  } else if (data == 'Rejected') {
                     bgColor = 'bg-danger';
                  }
                  return `
                     <select name="status" id="statusId" class="p-2 rounded ${bgColor} text-white">
                        <option value="Need Approval" ${(data == data ? 'selected' : '')}>Need Approval</option>
                        <option value="Approved" ${(data == data ? 'selected' : '')}>Approved</option>
                        <option value="Rejected" ${(data == data ? 'selected' : '')}>Rejected</option>
                     </select>
                  `;
               }
            }
         ],
         // columnDefs: [{ className: 'text_center', targets: ["_all"]}]
      });
   });

   $('#myTable').on('change','#statusId', function () {
      var data = $('#statusId').val();
      console.log(data);
   })
</script>

<?php include '../layout/footer.php'; ?>
