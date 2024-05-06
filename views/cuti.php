<?php include '../layout/header.php' ?>

<div class="card">
   <div class="p-4">
      <div class="row">
         <div class="col-md-6">
            <div>
               <h5>Pengajuan Cuti</h5>
            </div>
            <form id="addCuti">
               <div class="mb-2">
                  <label for="">Jenis Cuti</label>
                  <select name="jenis_cuti" id="jenisCuti" class="form-control">
                     <option value="-" selected disabled>-</option>
                     <option value="Cuti Tahunan">Cuti Tahunan</option>
                     <option value="Cuti Besar">Cuti Besar</option>
                     <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                     <option value="Cuti Sakit">Cuti Sakit</option>
                     <option value="Cuti Pernikahan">Cuti Pernikahan</option>
                     <option value="Cuti Menikah">Cuti Menikah</option>
                     <option value="Cuti Kematian">Cuti Kematian</option>
                  </select>
               </div>
               <div class="d-flex gap-3 mb-2">
                  <div class="w-50">
                     <label for="">Tanggal Mulai</label>
                     <input type="date" name="tanggal_mulai" class="form-control">
                  </div>
                  <div class="w-50">
                     <label for="">Tanggal Akhir</label>
                     <input type="date" name="tanggal_akhir" class="form-control">
                  </div>
               </div>
               <div class="form-floating mb-2">
                  <textarea class="form-control" placeholder="Leave a comment here" name="pesan" id="floatingTextarea"></textarea>
                  <label for="floatingTextarea">Pesan</label>
               </div>
               <div>
                  <button type="button" id="saveCuti" class="btn btn-primary">Simpan</button>
               </div>
            </form>
         </div>
         <div class="col-md-6">
            <div>
               <h5>Riwayat Cuti</h5>
            </div>
            <div>
               <table class="table table-light table-striped table-hover">
                  <thead>
                     <tr>
                        <th>Pengajuan</th>
                        <th>Waktu cuti</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                     </tr>
                  </thead>
                  <tbody id="dataCuti">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function () {
      // alert('aa');
      data();
   });

   function data() {
      $.ajax({
         type: 'post',
         dataType: 'json',
         url: '../function/controller/cutiController.php?func=datacuti',
         success: function (response) {
            var html = '';
            console.log(response);
            $.each(response, function (i, v) {
               var bgColor;
               if (v.STATUS == 'Need Approval') {
                  bgColor = 'bg-secondary';
               } else if (v.STATUS == 'Approved') {
                  bgColor = 'bg-success';
               } else if (v.STATUS == 'Rejected') {
                  bgColor = 'bg-danger';
               }
               html += `
                  <tr>
                     <td>${v.CREATED_DATE}</td>
                     <td>${v.TANGGAL_MULAI} - ${v.TANGGAL_AKHIR}</td>
                     <td>
                        <button type="button" class="btn ${bgColor} text-white">${v.STATUS}</button>
                     </td>
                     <td>${v.KETERANGAN}</td>
                  </tr>
               `;
            });
            $('#dataCuti').html(html);
         },
         error: function (err) {
            console.error(err);
         }
      })
   }

   $('#saveCuti').on('click', function () {
      // alert('aa');
      var data = $('#addCuti').serialize();
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
               url: '../function/controller/cutiController.php?func=addcuti',
               data: data,
               success: function (response) {
                  Swal.fire("Saved!", "", "success");
               },
               error: function (err) {
                  console.error();
               },
               complete: function () {
                  setInterval(function() {
                     location.reload();
                  }, 3000);
               },
            })
         } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
         }
      });
   })
</script>

<?php include '../layout/footer.php' ?>
