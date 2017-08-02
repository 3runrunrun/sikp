$(document).ready(function(){
  $('#input-pkes-sumber-air').change(function(){
    if ($(this).val() === '5') {
      $('#sumber-air-lain').show();
    } else {
      $('input[name=sumber_air_lain]').val(null);
      $('#sumber-air-lain').hide();
    }
  });
});