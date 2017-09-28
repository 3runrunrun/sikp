$(function(){
  $('#add-riw-1-tahun').click(function(){
    $('#riw-1-tahun').show();
    var namelist = $('#psg-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row" style="margin-bottom:10px !important">' +
      '<div class="col-md-4">' +
        '<select name="st_no_bpjs[]" class="form-control select2-single" required>' +
          namelist +
        '</select>' +
      '</div>' +
      '<div class="col-md-7">' +
        '<input type="text" name="st_jenis_penyakit[]" class="form-control" placeholder="penyakit atau kecelakaan yang pernah dialami" required>' +
      '</div>' +
      '<div class="col-md-1">' +
        '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
      '</div>' +
    '</div>';
    $('#riw-1-tahun').append(element);
    $(".select2-single").select2();
  });
});