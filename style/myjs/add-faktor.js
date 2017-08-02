$(document).ready(function(){
  $('body').on('click', '#add-faktor', function(){
    var select_risiko = '.modul-faktor-risiko';
    var select_pemicu = '.modul-faktor-pemicu';
    var uri_risiko = 'http://localhost/sikp/mod_files/modul_faktor_risiko/';
    var uri_pemicu = 'http://localhost/sikp/mod_files/modul_faktor_pemicu/';

    var mod_risiko = $('#modul-faktor-risiko > option').map(function(){
      var id_mod_faktor_risiko = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_mod_faktor_risiko + '">' + nama + '</option>';
    }).get();

    var mod_pemicu = $('#modul-faktor-pemicu > option').map(function(){
      var id_mod_faktor_pemicu = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_mod_faktor_pemicu + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
      '<div class="col-md-6">' +
        '<div class="form-group">' +
          '<label for="faktor-risiko" class="control-label">Faktor Risiko Penyakit</label>' +
          '<input type="text" name="faktor_risiko[]" id="faktor-risiko" class="form-control">' +
          '<span class="help-block"><small>&nbsp;</small></span>' +
        '</div>' +
        '<div class="form-group">' +
          '<label for="faktor-pemicu" class="control-label">Faktor Pemicu Penyakit</label>' +
          '<input type="text" name="faktor_pemicu[]" id="faktor-pemicu" class="form-control">' +
          '<span class="help-block"><small>&nbsp;</small></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-6">' +
        '<div class="form-group">' +
          '<label class="control-label">Modul Faktor Risiko</label>' +
          '<select name="id_mod_faktor_risiko[]" class="form-control select2-single modul-faktor-risiko" style="width: 100% !important;">' +
            mod_risiko +
          '</select>' +
          '<span class="help-block"><small><a target="_blank" href="">Baca Modul</a></small></span>' +
        '</div>' +
        '<div class="form-group">' +
          '<label class="control-label">Modul Faktor Pemicu</label>' +
          '<select name="id_mod_faktor_pemicu[]" class="form-control select2-single modul-faktor-pemicu" style="width: 100% !important;">' +
            mod_pemicu +
          '</select>' +
          '<span class="help-block"><small><a target="_blank" href="">Baca Modul</a></small></span>' +
        '</div>' +
      '</div>' +
      '<div class="col-md-12">' +
        '<div class="form-group pull-right">' +
          '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i>&nbsp;Hapus Faktor Pemicu dan Faktor Risiko Penyakit</button>' +
        '</div>' +
      '</div>' +
    '</div>';
    $('#pemicu-risiko-out').append(element);
    $('.select2-single').select2();

    $(select_risiko).change(function(){
      var href = uri_risiko + $(this).find(':selected').val() + '.pdf';
      var a = $(this).parent().find('a');
      $(a).attr('href', href);
    });

    $(select_pemicu).change(function(){
      var href = uri_pemicu + $(this).find(':selected').val() + '.pdf';
      var a = $(this).parent().find('a');
      $(a).attr('href', href);
    });
  });
});