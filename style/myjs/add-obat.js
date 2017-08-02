$(document).ready(function(){
  $('input[name=obat]').change(function() {
    if ($(this).val() === '1') {
      $('#tombol-add-obat').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-obat" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah data konsumsi obat-obatan</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-obat').append(btn);
    } else {
      $('#tombol-add-obat').children(this).remove();
      $('#obat-out').children().remove();
      $('#tombol-add-obat').hide();
    }
  });

  $('body').on('click', '#add-obat', function(){
    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-4">' +
          '<input type="text" name="jenis_obat[]" class="form-control" placeholder="Jenis obat">' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#obat-out').append(element);
  });
});