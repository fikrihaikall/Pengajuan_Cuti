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
               html += `
                  <tr>
                     <td>${v.CREATED_DATE}</td>
                     <td>${v.TANGGAL_MULAI} - ${v.TANGGAL_AKHIR}</td>
                     <td>${v.STATUS}</td>
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
      $.ajax({
         type: 'post',
         url: '../function/controller/cutiController.php?func=addcuti',
         data: data,
         success: function (response) {
            console.log(response);
         }
      })
   })
</script>

<?php include '../layout/footer.php' ?>
