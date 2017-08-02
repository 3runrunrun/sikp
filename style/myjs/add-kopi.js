$(document).ready(function(){
  $('input[name=kopi]').change(function() {
    if ($(this).val() === '1' || $(this).val() === '2') {
      $('#kopi-out').children().remove();
      $('#kopi-out').show();
      var btn = '<div class="col-md-4">' +
          '<input type="number" name="gelas_per_hari" class="form-control" min="0" max="999" placeholder="Konsumsi per hari">' +
          '<span class="help-block"><small>Gelas per hari</small></span>' +
        '</div>';
      $('#kopi-out').append(btn);
    } else {
      $('#kopi-out').children().remove();
    }
  });
});