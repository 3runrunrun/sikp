$(document).ready(function(){
  $('body').on('click', '#add-anamnesis', function(){
    var keluhan_box = '<div id="keluhan-out" class="row" style="margin-bottom: 20px !important">' +
        '<div class="form-group">' +
          '<div class="col-md-6">' +
            '<label for="keluhan" class="control-label">Keluhan Pasien</label>' +
            '<textarea name="keluhan[]" class="form-control"></textarea>' +
          '</div>' +
          '<div class="col-md-1">' +
            '<label class="control-label" style="color: white !important">Tombol</label>' +
            '<button type="button" class="btn btn-lg btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>';

    $('#keluhan-out').append(keluhan_box);
  });
});