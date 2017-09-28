$(document).ready(function(){
  $('#add-obat-baru').click(function(){
    var element = '<div class="row">' +
        '<div class="col-md-6">' +
          '<div class="form-group">' +
            '<label for="obat-nama" class="control-label">Nama Obat</label>' +
            '<input type="text" name="nama[]" id="obat-nama" class="form-control" required>' +
          '</div>' +
          '<!-- #/obat-nama -->' +
          '<div class="form-group">' +
            '<label for="obat-jumlah" class="control-label">Jumlah Obat</label>' +
            '<input type="number" name="jumlah[]" id="obat-jumlah" class="form-control" min="1" required>' +
          '</div>' +
          '<!-- #/obat-jumlah -->' +
        '</div>' +
        '<div class="col-md-5 col-xs-9">' +
          '<div class="form-group">' +
            '<label for="obat-bpjs" class="control-label">Status Pembiayaan BPJS</label>' +
            '<select name="bpjs[]" id="obat-bpjs" class="form-control" required>' +
              '<option value="" selected disabled>Pilih Opsi</option>' +
              '<option value="1">Ya</option>' +
              '<option value="0">Tidak</option>' +
            '</select>' +
          '</div>' +
          '<!-- #/obat-bpjs -->' +
          '<div class="form-group">' +
            '<label for="obat-jenis" class="control-label">Jenis Obat</label>' +
            '<select name="jenis[]" id="obat-jenis" class="form-control" required>' +
              '<option value="" selected disabled>Pilih Opsi</option>' +
              '<option value="1">Kapsul</option>' +
              '<option value="2">Tablet</option>' +
              '<option value="3">Sirup</option>' +
            '</select>' +
          '</div>' +
          '<!-- #/obat-jenis -->' +
        '</div>' +
        '<div class="col-md-1 col-xs-1">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color:white">tombol</label>' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>';
      $('#obat-baru-out').append(element);
  });
});