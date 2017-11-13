$(function(){
  $('#add-diagnosis').click(function(){
    console.log('the button is worked');
    var modul_list = $('.modul-penyakit > option').map(function(){
      var id_mod_penyakit = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_mod_penyakit + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label for="penyakit" class="control-label">Penyakit</label>' +
            '<input type="text" name="penyakit[]" id="penyakit" class="form-control" required>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label class="control-label">Modul Penyakit</label>' +
            '<select name="id_mod_penyakit[]" class="form-control select2-single modul-penyakit" style="width: 100% !important;" onchange="get_modul_penyakit(this)" required>' +
              modul_list +
            '</select>' +
            '<span class="help-block pull-right"><a target="_blank" class="read-modul-penyakit" href="">Baca Modul</a></span>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label for="terapi" class="control-label">Terapi</label>' +
            '<input type="text" name="terapi[]" id="terapi" class="form-control" required>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-1">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color: white;">hap</label>' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>';

    $('#diagnosis-out').append(element);
    $('.select2-single').select2();
  });
})