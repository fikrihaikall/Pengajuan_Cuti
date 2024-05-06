<?php include '../layout/header.php';?>

 

<div class="card">
   <div class="p-4">
      <div class="text-center">
         <h3>Data Cuti</h3>
         <hr>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive">
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

<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="statusModalLabel">Approval Cuti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
         <form id="updateStatus">
            <input type="hidden" name="id" id="idId">
            <select name="status" id="statusId" class="p-2 px-3 rounded bg-light">
             <option value="Need Approval">Need Approval</option>
             <option value="Approved">Approved</option>
             <option value="Rejected">Rejected</option>
            </select>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="submitStatus" class="btn btn-primary">Save changes</button>
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
                  // console.log(row.ID);
                  
                  return `
                     <button type="button" id="btnStatus" class="btn ${bgColor} text-white" data-id="${row.ID}" data-status="${data}" data-bs-toggle="modal" data-bs-target="#statusModal">${data}</button>
                  `;
               }
            }
         ],
         // columnDefs: [
         //    { 
         //       targets: 0,
         //       visible: false
         //    }
         // ]
      });
   });

   $('#myTable').on('click', '#btnStatus', function () {
      // console.log('aa');
      var id = $(this).data('id');
      var status = $(this).data('status');

      $('#idId').val(id);
      $('#statusId').val(status);
   })

   $('#submitStatus').on('click', function () {
      var data = $('#updateStatus').serialize();
      // console.log(data);
      Swal.fire({
         title: "Do you want to save the changes?",
         showDenyButton: true,
         showCancelButton: true,
         confirmButtonText: "Save",
         denyButtonText: `Don't save`
      }).then((result) => {
         /* Read more about isConfirmed, isDenied below */
         if (result.isConfirmed) {
            $.ajax({
               type: 'post',
               url: '../function/controller/indexController.php?func=approvalcuti',
               data: data,
               success: function (response) {
                  // console.log(response);
                  Swal.fire("Saved!", "", "success");
               },
               complete: function () {
                  setInterval(function() {
                     location.reload();
                  }, 3000);
               },
               error: function (err) {
                  console.error(err);
               }
            });
         } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
         }
      });
   })
</script>

<?php include '../layout/footer.php'; ?>
