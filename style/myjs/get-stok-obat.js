function get_harga(selector){
  var id_obat = $(selector).find(':selected').val();
  var input_target = $(selector).parent().parent().next().children().children('.jumlah');
  console.log(input_target);

  $.ajax({
    url: './../pengelolaan_obat/C_pencatatan_obat_keluar/show_sisa_obat',
    type: 'post',
    dataType: 'json',
    data: {id_obat: id_obat},
    success: function(data){
      var jumlah = data['data'][0]['jumlah'];
      $(input_target).attr('max', jumlah);
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