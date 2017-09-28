$(function(){
  $('#add-anggota-keluarga').click(function(){
    var namelist = $('#psg-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var element = '<div class="row">' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label class="control-label">Anggota Keluarga</label>' +
            '<select name="ak_no_bpjs[]" class="form-control select2-single" style="width: 100%;" required>' +
              namelist +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
          '<div class="form-group">' +
            '<label class="control-label">Hubungan Keluarga</label>' +
            '<select name="ak_hubungan_keluarga[]" class="form-control" onchange="perkawinan_out(this, $(this).parent().parent().parent().parent().parent().parent().children(\'[name=id_kk]\').val())" required>' +
              '<option value="" selected disabled>Pilih Opsi</option>' +
              '<option value="3">Anak</option>' +
              '<option value="4">Anggota Keluarga Lain</option>' +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-2">' +
          '<div class="form-group">' +
            '<label class="control-label">Domisili Serumah</label>' +
            '<select name="ak_domisili_serumah[]" class="form-control" required>' +
              '<option value="" selected disabled>Pilih Opsi</option>' +
              '<option value="1">Ya</option>' +
              '<option value="0">Tidak</option>' +
              '<option value="2">Kadang-Kadang</option>' +
            '</select>' +
          '</div>' +
        '</div>' +
        '<div class="perkawinan-ke-out"></div>' +
        '<div class="col-md-1">' +
          '<div class="form-group">' +
            '<label class="control-label" style="color: white !important;">Hapus</label>' +
            '<button class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-times"></i></button>' +
          '</div>' +
        '</div>' +
      '</div>';
    $('#anggota-keluarga-out').append(element);
    $('.select2-single').select2();
  });
});