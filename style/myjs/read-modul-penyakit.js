function get_modul_penyakit(selector) {
  var uri = 'http://localhost/sikp/mod_files/modul_penyakit/';
  var mod_name = $(selector).find(':selected').val() + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-penyakit');

  $(selector_target).attr('href', uri + mod_name);
  console.log(selector_target);
}

function get_modul_faktor_risiko(selector) {
  var uri = 'http://localhost/sikp/mod_files/modul_faktor_risiko/';
  var mod_name = $(selector).find(':selected').val() + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-faktor-risiko');

  $(selector_target).attr('href', uri + mod_name);
  console.log(selector_target);
}

function get_modul_faktor_pemicu(selector) {
  var uri = 'http://localhost/sikp/mod_files/modul_faktor_pemicu/';
  var mod_name = $(selector).find(':selected').val() + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-faktor-pemicu');

  $(selector_target).attr('href', uri + mod_name);
  console.log(selector_target);
}