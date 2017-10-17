$(function(){
  $('#add-riw-1-tahun').click(function(){
    var id_kk = $('[name=id_kk]').val();

    get_ak(id_kk, function(output){
      var element = '<div class="row" style="margin-bottom:10px !important">' +
          '<div class="col-md-4">' +
            '<select name="st_no_bpjs[]" class="form-control select2-single" required>' +
              output +
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
});