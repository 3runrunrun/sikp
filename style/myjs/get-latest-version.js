function get_latest (modul, selector) {
  var modul = modul;
  var nama = $(selector).val();
  $.ajax({
    url: './data_master/C_modul_kesehatan/show_latest',
    type: 'post',
    dataType: 'json',
    data: {modul: modul, nama: nama},
    success: function(data) {
      if (data['data'].length === 0) {
        $('#versi').attr('min', '1');
      } else {
        var minval = parseInt(data['data'][0]['versi']);
        $('#versi').attr('min', minval + 1);
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