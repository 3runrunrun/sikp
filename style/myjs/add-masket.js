$(document).ready(function(){
  $('input[name=masalah_keturunan]').change(function() {
    if ($(this).val() === '1') {
      $('#tombol-add-masket').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-masket" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Anggota Keluarga</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-masket').append(btn);
    } else {
      $('#tombol-add-masket').children(this).remove();
      $('#masket-out').children().remove();
      $('#tombol-add-masket').hide();
    }
  });

  $('body').on('click', '#add-masket', function(){
    var id_kk = $('[name=id_kk]').val();

    get_ak(id_kk, function(output){
      var element = '<div class="row" style="margin-bottom: 10px !important">' +
          '<div class="col-md-4">' +
            '<select name="masket_no_bpjs[]" class="form-control select2-single" required>' +
              output +
            '</select>' +
          '</div>' +
          '<div class="col-md-4">' +
            '<select name="jenis_masalah_keturunan[]" class="form-control select2-single" required>' +
              '<option value="" selected>Pilih masalah keturunan</option>' +
              '<option value="1">Darah Tinggi</option>' + // risiko
              '<option value="2">Kencing Manis</option>' +
              '<option value="3">Kegemukan</option>' +
              '<option value="4">Diabetes</option>' + // risiko
              '<option value="5">Stroke</option>' + // risiko
              '<option value="6">Sakit Jantung</option>' + // risiko
              '<option value="7">Asam Urat</option>' + // risiko
              '<option value="8">Tumor</option>' +
            '</select>' +
          '</div>' +
          '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
          '</div>' +
        '</div>';
      $('#masket-out').append(element); 
      $(".select2-single").select2();
    });
  });
});