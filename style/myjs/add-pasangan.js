$(function(){
  $('#add-pasangan').click(function() {
    var namelist = $('#psg-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var lines = '<div class="row">' +
      '<div class="col-md-2">' +
        '<div class="form-group">' +
          '<label class="control-label">Pasangan</label>' +
          '<select name="psg_no_bpjs[]" class="form-control select2-single" required>' +
            namelist +
          '</select>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-2">' +
        '<div class="form-group">' +
          '<label class="control-label">Hubungan Keluarga</label>' +
          '<select name="psg_hubungan_keluarga[]" class="form-control" required>' +
            '<option value="" selected disabled>Pilih Opsi</option>' +
            '<option value="2">Istri</option>' +
          '</select>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-2">' +
        '<div class="form-group">' +
          '<label class="control-label">Domisili Serumah</label>' +
          '<select name="psg_domisili_serumah[]" class="form-control" required>' +
            '<option value="" selected disabled>Pilih Opsi</option>' +
            '<option value="1">Ya</option>' +
            '<option value="2">Tidak</option>' +
            '<option value="3">Kadang-Kadang</option>' +
          '</select>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-2">' +
        '<div class="form-group">' +
          '<label class="control-label">Status Perkawinan</label>' +
          '<select name="psg_status_kawin[]" class="form-control" required>' +
            '<option value="" selected disabled>Pilih Opsi</option>' +
            '<option value="1">Menikah</option>' +
            '<option value="0">Cerai</option>' +
          '</select>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-2">' +
        '<div class="form-group">' +
          '<label class="control-label">Perkawinan ke-</label>' +
          '<input type="number" name="psg_perkawinan_ke[]" class="form-control perkawinan-ke" min="1" onkeyup="set_perkawinan_ke_min(this)" onchange="set_perkawinan_ke_min(this)" required>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-1">' +
        '<div class="form-group">' +
          '<label class="control-label">Umur</label>' +
          '<input type="number" name="psg_umur_pasangan[]" class="form-control" min="16" required>' +
          '<span class="help-block"><small>Ketika menikah</small></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-1">' +
        '<div class="form-group">' +
          '<label class="control-label" style="color: white !important;">Hapus</label>' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()">' +
            '<i class="fa fa-times"></i>' +
          '</button>' +
        '</div>' +
      '</div>' +
    '</div>';
    $('#pasangan-out').append(lines);
    $(".select2-single").select2();

    var last_selector = $('#pasangan-out').find('.perkawinan-ke').last();

    set_perkawinan_ke_min(last_selector);
    get_perkawinan_terakhir('#psg-kepala-keluarga');
  });
});

function set_perkawinan_ke_min(selector){
  var selector_target_prev = $(selector).parent().parent().parent().prev().children().children().find('.perkawinan-ke');
  var selector_target_next = $(selector).parent().parent().parent().next().children().children().find('.perkawinan-ke');

  console.log($(selector_target_prev).val());
  console.log($(selector_target_prev).attr('min'));

  if (selector_target_prev.length != 0) {
    var prev_min_val = parseInt($(selector_target_prev).attr('min'));
    var prev_val = parseInt($(selector_target_prev).val());

    if (isNaN(prev_val)) {
      $(selector).attr('min', prev_min_val + 1);
    } else { 
      $(selector).attr('min', prev_val + 1);
      $(selector).val(prev_val + 1);
    }
  }

  if (selector_target_next.length != 0) {
    var min_val = parseInt($(selector).attr('min'));
    var val = parseInt($(selector).val());

    if (isNaN(val)) {
      $(selector_target_next).attr('min', min_val + 1);
    } else { 
      $(selector_target_next).attr('min', val + 1);
      $(selector_target_next).val(val + 1);
    }
  } 
}

function get_perkawinan_terakhir(selector) {
  var no_bpjs = $(selector).find(':selected').val();
  var target = $('#pasangan-out').find('.perkawinan-ke');
  console.log(target);

  $.ajax({
    url: './data_dasar/C_data_dasar/show_perkawinan_terakhir',
    type: 'post',
    dataType: 'json',
    data: {no_bpjs: no_bpjs},
    success: function(data){
      if (data['data'].length == 0) {
        console.log('kosong');
      } else {
        var minlength = parseInt(data['data'][0]['perkawinan_ke']);
        if (target.length != 0) {
          $(target).first().attr('min', minlength + 1);
        }
      }
    }
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}