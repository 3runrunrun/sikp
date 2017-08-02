function get_data_family(id){
  var select = document.getElementById(id);
  // console.log(select.hasChildNodes());
  // console.log(select.childNodes);
  // select.removeChild(select.childNodes);
  $.ajax({
    url: 'http://localhost/sikp/index.php/C_home/coba',
    type: 'get',
    dataType: 'json',
    // data: {param1: 'value1'},
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function(result) {
    $.each(result.pasien.data, function(index, val) {
      var opt = document.createElement('option');
      opt.value = val.no_bpjs;
      opt.innerHTML = val.nama;
      select.appendChild(opt);
    });
  });
}