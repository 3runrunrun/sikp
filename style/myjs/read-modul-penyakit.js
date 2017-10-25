// SIKP-PF-123
function get_modul_penyakit(selector) {
  console.log($(selector).find(':selected').prop('class'));
  var uri = 'http://localhost/sikp/mod_files/modul_penyakit/';
  var classname = $(selector).find(':selected').prop('class');
  var mod_name = $(selector).find(':selected').val() + classname + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-penyakit');

  $(selector_target).attr('href', uri + mod_name);
  // console.log(selector_target);
}

// SIKP-PF-124
function get_modul_faktor_risiko(selector) {
  var uri = 'http://localhost/sikp/mod_files/modul_faktor_risiko/';
  var classname = $(selector).find(':selected').prop('class');
  var mod_name = $(selector).find(':selected').val() + classname + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-faktor-risiko');

  $(selector_target).attr('href', uri + mod_name);
  // console.log(selector_target);
}

// SIKP-PF-125
function get_modul_faktor_pemicu(selector) {
  var uri = 'http://localhost/sikp/mod_files/modul_faktor_pemicu/';
  var classname = $(selector).find(':selected').prop('class');
  var mod_name = $(selector).find(':selected').val() + classname + '.pdf';
  var selector_target = $(selector).siblings('.help-block').children('.read-modul-faktor-pemicu');

  $(selector_target).attr('href', uri + mod_name);
  // console.log(selector_target);
}