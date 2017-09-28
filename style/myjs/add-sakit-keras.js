$(document).ready(function(){
  $('input[name=sakit_keras]').change(function() {
    if ($(this).val() === '1') {
      $('#tombol-add-sakit-keras').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-sakit-keras" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah riwayat sakit keras</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-sakit-keras').append(btn);
    } else {
      $('#tombol-add-sakit-keras').children(this).remove();
      $('#sakit-keras-out').children().remove();
      $('#tombol-add-sakit-keras').hide();
    }
  });

  $('body').on('click', '#add-sakit-keras', function(){
    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-4">' +
          '<input type="text" name="jenis_sakit_keras[]" class="form-control" placeholder="Sakit keras yang diderita" required>' +
        '</div>' +
        '<div class="col-md-2">' +
          '<input type="number" name="tahun_sakit[]" class="form-control" min="1000" max="9999" placeholder="0" required>' +
          '<span class="help-block"><small>Isi dengan tahun kejadian</small></span>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#sakit-keras-out').append(element);
  });
});