$(document).ready(function(){
  $('input[name=asma]').change(function(){
    if ($(this).val() === '1') {
      $('#tombol-add-asma').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-asma" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Anggota Keluarga</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-asma').append(btn);
    } else {
      $('#tombol-add-asma').children(this).remove();
      $('#asma-out').children().remove();
      $('#tombol-add-asma').hide();
    }
  });

  $('body').on('click', '#add-asma', function(){
    $('#asma-out').show();
    var id_kk = $('[name=id_kk]').val();

    get_ak(id_kk, function(output){
      var element = '<div class="row" style="margin-bottom: 10px !important">' +
          '<div id="asma-anggota-keluarga" class="col-md-4">' +
            '<select name="asma_no_bpjs[]" class="form-control select2-single" required>' +
              output +
            '</select>' +
          '</div>' +
          '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
          '</div>' +
        '</div>';
      $('#asma-out').append(element);
      $(".select2-single").select2();
    });
  });
});