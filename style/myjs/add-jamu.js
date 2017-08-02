$(document).ready(function(){
  $('input[name=jamu]').change(function() {
    if ($(this).val() === '1' || $(this).val() === '2') {
      $('#tombol-add-jamu').show();
      $('#tombol-add-jamu').children(this).remove();
      $('#jamu-out').children().remove();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-jamu" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah riwayat konsumsi jamu</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-jamu').append(btn);
    } else {
      $('#tombol-add-jamu').children(this).remove();
      $('#jamu-out').children().remove();
      $('#tombol-add-jamu').hide();
    }
  });

  $('body').on('click', '#add-jamu', function(){
    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-4">' +
          '<input type="text" name="jenis_jamu[]" class="form-control" placeholder="Jenis jamu yang dikonsumsi">' +
        '</div>' +
        '<div class="col-md-2">' +
          '<input type="number" name="jamu_per_minggu[]" class="form-control" min="0" max="99" placeholder="0">' +
          '<span class="help-block"><small>Jumlah konsumsi jamu (gelas per minggu)</small></span>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#jamu-out').append(element);
  });
});