$(document).ready(function(){
  $('#add-obat-keluar').click(function(){
    var med_list = $('#obat > option').map(function(){
      var id_obat = $(this).val();
      var nama = $(this).text();
      return '<option value="' + id_obat + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
        '<div class="col-md-6 col-sm-12 col-xs-12">' +
          '<div class="form-group">' +
            '<label for="obat" class="control-label">Pilih Obat</label>' +
            '<select name="id_obat[]" class="form-control select2-single" style="width: 100% !important;" onchange="get_harga(this)" required>' +
              med_list +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-1 col-sm-5 col-xs-5">' +
          '<div class="form-group">' +
            '<label class="control-label">Signa</label>' +
            '<input type="number" name="a_signa[]" step="1" min="1" class="form-control" placeholder="0" required>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-1 col-sm-2 col-xs-1" style="width: 10px">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color: white">Signa</label><br />' +
            '<label class="control-label">&times;</label>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-1 col-sm-5 col-xs-5">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color: white">Signa</label>' +
            '<input type="number" name="b_signa[]" step="1" min="1" class="form-control" placeholder="0" required>' +
          '</div>' +
        '</div>' +
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