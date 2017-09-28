function filter_region(filter_data, selector) {
  var id = $(selector).find(':selected').val();
  var target_selector;

  if (filter_data == 'kabupaten') {
    target_selector = '#input-kk-kabupaten';
    $(target_selector).empty();
    $(target_selector).append('<option value="" selected disabled>Kabupaten / Kota</option>');
    $('#input-kk-kecamatan').empty();
    $('#input-kk-kecamatan').append('<option value="" selected disabled>Kecamatan</option>');
    $('#input-kk-kelurahan').empty();
    $('#input-kk-kelurahan').append('<option value="" selected disabled>Kelurahan</option>');
  } else if (filter_data == 'kecamatan') {
    target_selector = '#input-kk-kecamatan';
    $(target_selector).empty();
    $(target_selector).append('<option value="" selected disabled>Kecamatan</option>');
    $('#input-kk-kelurahan').empty();
    $('#input-kk-kelurahan').append('<option value="" selected disabled>Kelurahan</option>');
  } else if (filter_data == 'kelurahan') {
    target_selector = '#input-kk-kelurahan';
    $(target_selector).empty();
    $(target_selector).append('<option value="" selected disabled>Kelurahan</option>');
  }

  $.ajax({
    url: 'http://localhost/sikp/index.php/data_dasar/C_data_dasar/filter_region',
    type: 'post',
    dataType: 'json',
    data: {
      filter_data: filter_data,
      id: id
    },
    success: function(data){
      var option = $.map(data['data'], function(index, value){
        var ret_id;
        if (filter_data == 'kabupaten') {
          ret_id = index.id_kabupaten;
        } else if (filter_data == 'kecamatan') {
          ret_id = index.id_kecamatan;
        } else if (filter_data == 'kelurahan') {
          ret_id = index.id_kelurahan;
        }
        return '<option value="' + ret_id + '">' + index.nama + '</option>';
      });

      $.each(option, function(index, val) {
        $(target_selector).append(val);
      });
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