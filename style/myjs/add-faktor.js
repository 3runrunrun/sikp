$(document).ready(function(){
  $('body').on('click', '#add-faktor-risiko', function(){
    var mod_risiko = $('#modul-faktor-risiko > option').map(function(){
      var id_mod_faktor_risiko = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_mod_faktor_risiko + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
      '<div class="col-md-6">' +
        '<div class="form-group">' +
          '<label for="faktor-risiko" class="control-label">Faktor Risiko Penyakit</label>' +
          '<input type="text" name="faktor_risiko[]" id="faktor-risiko" class="form-control" required>' +
          '<span class="help-block"><small>&nbsp;</small></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-5">' +
        '<div class="form-group">' +
          '<label class="control-label">Modul Faktor Risiko</label>' +
          '<select name="id_mod_faktor_risiko[]" class="form-control select2-single modul-faktor-risiko" style="width: 100% !important;" onchange="get_modul_faktor_pemicu(this)" required>' +
            mod_risiko +
          '</select>' +
          '<span class="help-block"><a target="_blank" href="" class="read-modul-faktor-pemicu">Baca Modul</a></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-1">' +
        '<div class="form-group pull-right">' +
          '<label class="control-label" style="color: white;">hap</label>' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
        '</div>' +
      '</div>' +
    '</div>';
    $('#pemicu-risiko-out').append(element);
    $('.select2-single').select2();
  });

  $('body').on('click', '#add-faktor-pemicu', function(){
    var mod_pemicu = $('#modul-faktor-pemicu > option').map(function(){
      var id_mod_faktor_pemicu = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_mod_faktor_pemicu + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
      '<div class="col-md-6">' +
        '<div class="form-group">' +
          '<label for="faktor-pemicu" class="control-label">Faktor Pemicu Penyakit</label>' +
          '<input type="text" name="faktor_pemicu[]" id="faktor-pemicu" class="form-control" required>' +
          '<span class="help-block"><small>&nbsp;</small></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-5">' +
        '<div class="form-group">' +
          '<label class="control-label">Modul Faktor Pemicu</label>' +
          '<select name="id_mod_faktor_pemicu[]" class="form-control select2-single modul-faktor-pemicu" style="width: 100% !important;" onchange="get_modul_faktor_pemicu(this)" required>' +
            mod_pemicu +
          '</select>' +
          '<span class="help-block"><a target="_blank" href="" class="read-modul-faktor-pemicu">Baca Modul</a></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-1">' +
        '<div class="form-group pull-right">' +
          '<label class="control-label" style="color: white;">hap</label>' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
        '</div>' +
      '</div>' +
    '</div>';
    $('#pemicu-risiko-out').append(element);
    $('.select2-single').select2();
  });
});