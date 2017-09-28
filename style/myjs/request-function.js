$(function(){
  
  $('.modul-faktor-risiko').change(function(){
    var val = $('.modul-faktor-risiko > option:selected').val();
    get_harga(val);  
  });

  function get_harga(id_stok){
    $.ajax({
      url: 'http://localhost/sikp/index.php/C_home/coba',
      type: 'get',
      dataType: 'json',
      data: {id_stok:id_stok}
      success: function(data){
    
        var ini = data['pasien']['data'];
        $.each(ini, function(i, value){
    
          $('.faktor').append('<option value="">' + value['pendidikan_terakhir'] + '</option>'); 
        });
      }
    });
  }
});