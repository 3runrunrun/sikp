$(document).ready(function(){
  $('input[name=merokok]').change(function() {
    if ($(this).val() === '1' || $(this).val() === '2') {
      $('#merokok-out').show();
      $('#merokok-out').children(this).remove();
      var btn = '<div class="row" style="margin-top: 10px !important">' +
          '<div class="col-md-2" id="durasi-merokok">' +
            '<input type="number" name="durasi_merokok" class="form-control" placeholder="0" min="0" max="999" required>' +
            '<span class="help-block"><small>Lama merokok dalam tahun</small></span>' +
          '</div>' +
          '<div class="col-md-2" id="jumlah-batang">' +
            '<input type="number" name="batang_per_hari" class="form-control" placeholder="0" min="0" max="999" required>' +
            '<span class="help-block"><small>Batang per hari</small></span>' +
          '</div>' +
          '<div class="col-md-3" id="jenis-kretek-filter">' +
            '<label style="margin-right: 20px !important">' +
              '<input type="radio" name="kretek_filter" value="kretek" required>&nbsp;Kretek' +
            '</label>' +
            '<label style="margin-right: 20px !important">' +
              '<input type="radio" name="kretek_filter" value="filter" required>&nbsp;Filter' +
            '</label>' +
            '<span class="help-block"><small>Jenis rokok yang dikonsumsi</small></span>' +
          '</div>' +
        '</div>';
      $('#merokok-out').append(btn);
    } else if ($(this).val() === '3') {
      $('#merokok-out').show();
      $('#merokok-out').children(this).remove();
      var btn = '<div class="row" style="margin-top: 10px !important">' +
          '<div class="col-md-2" id="durasi-merokok">' +
            '<input type="number" name="durasi_merokok" class="form-control" placeholder="0" min="0" max="999">' +
            '<span class="help-block"><small>Lama merokok dalam tahun</small></span>' +
          '</div>' +
          '<div class="col-md-2" id="durasi-berhenti-merokok">' +
            '<input type="number" name="durasi_berhenti" class="form-control" placeholder="0" min="0" max="999">' +
            '<span class="help-block"><small>Lama berhenti merokok dalam tahun</small></span>' +
          '</div>' +
          '<div class="col-md-2" id="jumlah-batang">' +
            '<input type="number" name="batang_per_hari" class="form-control" placeholder="0" min="0" max="999">' +
            '<span class="help-block"><small>Batang per hari</small></span>' +
          '</div>' +
          '<div class="col-md-3" id="jenis-kretek-filter">' +
            '<label style="margin-right: 20px !important">' +
              '<input type="radio" name="kretek_filter" value="kretek">&nbsp;Kretek' +
            '</label>' +
            '<label style="margin-right: 20px !important">' +
              '<input type="radio" name="kretek_filter" value="filter">&nbsp;Filter' +
            '</label>' +
            '<span class="help-block"><small>Jenis rokok yang dikonsumsi</small></span>' +
          '</div>' +
        '</div>';
      $('#merokok-out').append(btn);
    } else {
      $('#merokok-out').children(this).remove();
      $('#merokok-out').hide();
    }
  });
});