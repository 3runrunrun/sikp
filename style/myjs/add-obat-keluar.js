$(document).ready(function(){
  $('#add-obat-keluar').click(function(){
    var med_list = $('#obat > option').map(function(){
      var id_obat = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_obat + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
        '<div class="col-xs-9 col-md-9">' +
          '<div class="form-group">' +
            '<label for="obat" class="control-label">Pilih Obat</label>' +
            '<select name="id_obat[]" class="form-control select2-single" style="width: 100% !important;" onchange="get_harga(this)" required>' +
              med_list +
            '</select>' +
          '</div>' +
        '</div>' +
        '<!-- /obat -->' +
        '<div class="col-xs-9 col-md-2">' +
          '<div class="form-group">' +
            '<label for="jumlah-keluar" class="control-label">Jumlah Obat Keluar</label>' +
            '<input type="number" min="0" name="jumlah_keluar[]" class="form-control jumlah" step="1" placeholder="0" required>' +
            '<span class="help-block"><small>Dalam butir atau botol</small></span>' +
          '</div>' +
        '</div>' +
        '<div class="col-xs-1 col-md-1">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color: white !important;">Hapus</label>' +
            '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>';
      $('#obat-keluar-out').append(element);
      $('.select2-single').select2();
  });
});