function destroy_anamnesis_harian(a, b, c){
  var is_delete = confirm('Apakah anda yakin untuk menghapus data anamnesis pasien ' + c + '?');
  if (is_delete) {
    delete_anamnesis(a, b);
  } else {
    console.log('gajadi deng');
  }
}

function delete_anamnesis(id_registrasi, no_bpjs){
  $.post('http://localhost/sikp/index.php/destroy-anamnesis', {id_registrasi: id_registrasi, no_bpjs: no_bpjs}, function() {
    // kosong
  });
}