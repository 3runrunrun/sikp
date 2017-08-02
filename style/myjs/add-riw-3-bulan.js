$(function(){
  $('#add-riw-3-bulan').click(function(){
    $('#riw-3-bulan').show();
    var namelist = $('#psg-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row" style="margin-bottom:10px !important">' +
      '<div class="col-md-4">' +
        '<select name="tb_no_bpjs[]" class="form-control select2-single" tabindex="-1">' +
          namelist +
        '</select>' +
      '</div>' +
      '<div class="col-md-7">' +
        '<input type="text" name="tb_jenis_penyakit[]" class="form-control" placeholder="penyakit atau kecelakaan yang pernah dialami">' +
      '</div>' +
      '<div class="col-md-1">' +
        '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
      '</div>' +
    '</div>';
    $('#riw-3-bulan').append(element);
    $(".select2-single").select2();
  });
});