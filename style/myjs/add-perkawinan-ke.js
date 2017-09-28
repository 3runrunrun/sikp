function perkawinan_out(selector, id_kk){
  // var id_kk = $(selector).parent().parent().parent().parent().parent().children('[name=id_kk]').val();
  var value = $(selector).find(':selected').val();
  var input_target = $(selector).parent().parent().parent().find('.perkawinan-ke-out');
  get_perkawinan_ke(id_kk, value, input_target);
}

function get_perkawinan_ke(id_kk, value, selector_target){
  $.ajax({
    url: 'http://localhost/sikp/index.php/data_dasar/C_data_dasar/show_perkawinan_ke',
    type: 'post',
    dataType: 'json',
    data: {id_kk: id_kk},
    success: function(data){
      if (data['data'].length == 0) {
        console.log('data perkawinan ke is unavailable');
      } else {
        var option = $.map(data['data'], function(index, value){
          return '<option value="' + index.perkawinan_ke + '">' + index.perkawinan_ke + '</option>';
        });
        populating_data(option, value, selector_target);
      }
    }
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}

function populating_data(data, value, selector_target) {
  console.log(data);
  console.log(value);

  var element_one = '<div class="col-md-2">' +
      '<div class="form-group">' +
        '<label class="control-label">Dari Perkawinan ke-</label>' +
        '<select name="ak_perkawinan_ke[]" class="form-control" required>' +
          '<option value="" selected disabled>Pilih Opsi</option>' +
          data +
        '</select>' +
      '</div>' +
    '</div>';

  var element_two = '<input type="hidden" name="ak_perkawinan_ke[]" value="0">';

  if (value == '3') {
    selector_target.children().remove();
    selector_target.append(element_one);
  } else {
    selector_target.children().remove();
    selector_target.append(element_two);
  }
}