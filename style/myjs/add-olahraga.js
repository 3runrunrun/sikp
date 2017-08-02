$(document).ready(function(){
  $('input[name=olahraga]').change(function(){
    if ($(this).val() === '1') {
      $('#tombol-add-olahraga').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-olahraga" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah data rutinitas olahraga</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-olahraga').append(btn);
    } else {
      $('#tombol-add-olahraga').children(this).remove();
      $('#olahraga-out').children().remove();
      $('#tombol-add-olahraga').hide();
    }
  });

  $('body').on('click', '#add-olahraga', function(){
    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-3">' +
          '<input type="text" name="jenis_olahraga[]" class="form-control" placeholder="Jenis olahraga">' +
        '</div>' +
        '<div class="col-md-2">' +
          '<input type="number" name="jumlah_per_minggu[]" class="form-control" min="0" max="999" placeholder="0">' +
          '<span class="help-block"><small>Kali per minggu</small></span>' +
        '</div>' +
        '<div class="col-md-4">' +
          '<select name="olahraga_keluarga[]" class="form-control">' +
            '<option selected disabled>Pilih opsi</option>' +
            '<option value="1">Ya</option>' +
            '<option value="0">Tidak</option>' +
          '</select>' +
          '<span class="help-block"><small>Apakah olahraga dilakukan bersama keluarga?</small></span>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#olahraga-out').append(element);
  });
});