$(document).ready(function(){
  $('input[name=alkohol]').change(function() {
    if ($(this).val() === '1' || $(this).val() === '2') {
      $('#alkohol-out').children().remove();
      $('#alkohol-out').show();
      var btn = '<div class="col-md-4">' +
          '<input type="number" name="durasi" class="form-control" min="0" max="999" placeholder="Lamanya konsumsi alkohol">' +
          '<span class="help-block"><small>Dalam tahun</small></span>' +
        '</div>';
      $('#alkohol-out').append(btn);
    } else {
      $('#alkohol-out').children().remove();
    }
  });
});