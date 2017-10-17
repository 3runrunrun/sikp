$(document).ready(function(){
  $('input[name=masalah_kesehatan]').change(function() {
    if ($(this).val() === '1') {
      $('#tombol-add-maskes').show();
      var btn = '<div class="row" style="margin-top: 10px; margin-bottom: 20px !important">' +
          '<div class="col-md-4">' +
            '<button type="button" id="add-maskes" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Anggota Keluarga</button>' +
          '</div>' +
        '</div>';
      $('#tombol-add-maskes').append(btn);
    } else {
      $('#tombol-add-maskes').children(this).remove();
      $('#maskes-out').children().remove();
      $('#tombol-add-maskes').hide();
    }
  });

  $('body').on('click', '#add-maskes', function(){
    var id_kk = $('[name=id_kk]').val();

    get_ak(id_kk, function(output){
      var element = '<div class="row" style="margin-bottom: 10px !important">' +
          '<div class="col-md-4">' +
            '<select name="maskes_no_bpjs[]" class="form-control select2-single" required>' +
              output +
            '</select>' +
          '</div>' +
          '<div class="col-md-7">' +
            '<input type="text" name="masalah_kes[]" class="form-control" placeholder="Masalah kesehatan yang diderita" required>' +
          '</div>' +
          '<div class="col-md-1">' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
          '</div>' +
        '</div>';
      $('#maskes-out').append(element); 
      $(".select2-single").select2();
    });
  });
});