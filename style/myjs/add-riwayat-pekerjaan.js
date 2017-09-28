$(function(){
  $('#add-riwayat-pekerjaan').click(function(){
    var mintime = $('#rp-dari-tahun').attr('min');
    var maxtime = $('#rp-dari-tahun').attr('max');

    var namelist = $('#rp-kepala-keluarga > option').map(function(){
      var no_bpjs = $(this).val();
      var nama = $(this).text();
      return '<option value="' + no_bpjs + '">' + nama + '</option>';
    }).get();

    var element = '<div class="box">' +
        '<div class="box-header with-border">' +
          '<h4 class="box-title">Riwayat Pekerjaan Lain</h4>' +
        '</div>' +
        '<div class="box-body">' +
          '<div class="row">' +
            '<div class="col-md-11">' +
              '<div class="form-group">' +
                '<input type="hidden" name="rp_no_bpjs[]" class="val-sampingan" required>' +
                '<select class="form-control rp-sampingan" style="width: 100%;" disabled>' +
                  namelist +
                '</select>' +
              '</div>' +
            '</div>' +
            '<div class="col-md-1">' +
              '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
            '</div>' +
          '</div>' +
          '<div class="row">' +
            '<div class="col-md-4">' +
              '<div class="form-group">' +
                '<input type="text" name="rp_pekerjaan[]" class="form-control" placeholder="Pekerjaan" required>' +
              '</div>' +
              '<div class="form-group">' +
                '<input type="text" name="rp_divisi[]" class="form-control" placeholder="Divisi">' +
              '</div>' +
              '<div class="form-group">' +
                '<input type="text" name="rp_sub_divisi[]" class="form-control" placeholder="Sub-Divisi">' +
                '<span class="help-block"><small>Opsional</small></span>' +
              '</div>' +
            '</div>' +
            '<div class="col-md-4">' +
              '<div class="form-group">' +
                '<input type="text" name="rp_jenis_aktivitas[]" class="form-control" placeholder="Jenis Aktivitas" required>' +
              '</div>' +
              '<div class="form-group">' +
                '<select name="rp_intensitas_aktivitas[]" class="form-control" required>' +
                  '<option value="" selected disabled>Intensitas Kegiatan</option>' +
                  '<option value="1">Ringan</option>' +
                  '<option value="2">Sedang</option>' +
                  '<option value="3">Berat</option>' +
                '</select>' +
              '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
              '<div class="form-group">' +
                '<input type="number" name="rp_dari_tahun[]" class="form-control new-rp-dari-tahun" minlength="4" maxlength="4" placeholder="Dari Tahun" required>' +
              '</div>' +
              '<div class="form-group">' +
                '<input type="number" name="rp_sampai_tahun[]" class="form-control new-rp-sampai-tahun" minlength="4" maxlength="4" placeholder="Sampai Tahun" required>' +
              '</div>' +
              '<div class="form-group">' +
                '<label class="control-label">Pekerjaan Sampingan</label><br />' +
                '<label style="margin-right: 20px !important;">' +
                  '<input type="radio" name="rp_pekerjaan_utama[]" value="2"> Ya' +
                '</label>' +
                '<label style="margin-right: 20px !important;">' +
                  '<input type="radio" name="rp_pekerjaan_utama[]" value="0" checked> Tidak' +
                '</label>' +
              '</div>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>';

    $('.riwayat-pekerjaan-out').append(element);
    $('.val-sampingan').val($('#rp-kepala-keluarga').val());
    $('.rp-sampingan').find("option[value=" + $('#rp-kepala-keluarga').val() + "]").attr('selected', 'selected');
    $('.riwayat-pekerjaan-out').find('.new-rp-dari-tahun, .new-rp-sampai-tahun').attr('min', mintime);
    $('.riwayat-pekerjaan-out').find('.new-rp-dari-tahun, .new-rp-sampai-tahun').attr('max', maxtime);
    
    $('.new-rp-dari-tahun').change(function(){
      if($(this).val() < mintime || $(this).val() > maxtime){
        $('.new-rp-sampai-tahun').attr('min', mintime);
      } else {
        $('.new-rp-sampai-tahun').attr('min', $(this).val());
      }
    });

    $('#rp-kepala-keluarga').change(function() {
      var x = $(this).val();
      $('.val-sampingan').val(x);
      $('.rp-sampingan').find("option[value=" + x + "]").attr('selected', 'selected');
    });
  });
});