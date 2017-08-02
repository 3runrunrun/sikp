$(document).ready(function(){
  var select = '.modul-penyakit';
  var select_risiko = '.modul-faktor-risiko';
  var select_pemicu = '.modul-faktor-pemicu';

  var aid = '#read-';
  var uri = 'http://localhost/sikp/mod_files/modul_penyakit/';
  var uri_risiko = 'http://localhost/sikp/mod_files/modul_faktor_risiko/';
  var uri_pemicu = 'http://localhost/sikp/mod_files/modul_faktor_pemicu/';
  
  $(select).change(function(){
    var a = aid + $(this).attr('id');
    var href = uri + $(this).find(':selected').val() + '.pdf';
    $(a).attr('href', href);
  });

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