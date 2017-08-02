$(document).ready(function(){
  $('input[name=batuk]').change(function(){
    if ($(this).val() === '1') {
      $('#tombol-add-batuk').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important;">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-batuk" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Anggota Keluarga</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-batuk').append(btn);
    } else {
      $('#tombol-add-batuk').children(this).remove();
      $('#batuk-out').children().remove();
      $('#tombol-add-batuk').hide();
    }
  });

  $('body').on('click', '#add-batuk', function(){
    $('#batuk-out').show();
    var namelist = $('#psg-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row" style="margin-bottom: 10px !important">' +
        '<div class="col-md-4">' +
          '<select name="batuk_no_bpjs[]" class="form-control select2-single">' +
          namelist +
          '</select>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
        '</div>' +
      '</div>';
    $('#batuk-out').append(element);
    $(".select2-single").select2();
  });
});