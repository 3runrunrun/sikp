$(document).ready(function(){
  $('input[name=kecelakaan_kerja]').change(function() {
    if ($(this).val() === '1') {
      $('#tombol-add-kecelakaan-kerja').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-kecelakaan-kerja" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah riwayat kecelakaan kerja</button> ' +
          '</div>' +
        '</div>';
      $('#tombol-add-kecelakaan-kerja').append(btn);
    } else {
      $('#tombol-add-kecelakaan-kerja').children(this).remove();
      $('#kecelakaan-kerja-out').children().remove();
      $('#tombol-add-kecelakaan-kerja').hide();
    }
  });

  $('body').on('click', '#add-kecelakaan-kerja', function(){
    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-4">' +
          '<input type="text" name="jenis_kecelakaan_kerja[]" class="form-control" placeholder="Kecelakaan kerja yang dialami">' +
        '</div>' +
        '<div class="col-md-2">' +
          '<input type="number" name="tahun_kejadian[]" class="form-control" min="1000" max="9999" placeholder="0">' +
          '<span class="help-block"><small>Isi dengan tahun kejadian</small></span>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<input type="text" name="jenis_kelainan[]" class="form-control" placeholder="Jenis kelainan yang dialami">' +
          '<span class="help-block"><small>Jika ada</small></span>' +
        '</div>' +
        '<div class="col-md-2">' +
          '<input type="number" name="durasi_perawatan[]" class="form-control" min="0" max="999" placeholder="0">' +
          '<span class="help-block"><small>Dalam hari</small></span>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#kecelakaan-kerja-out').append(element);
  });
});