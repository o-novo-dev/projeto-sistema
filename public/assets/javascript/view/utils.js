const enviarViaAjax = (form, idModal, dataTableToRefresh = '') => {

  var formData = new FormData(form);

  $.ajax({
    url: form.action,
    dataType: 'json',
    type: form.method.toUpperCase(),
    processData: false, 
    contentType: false,
    data: formData,
    success: function(data) {
      console.log(data);
      if (data.status == 'true') {
        
        document.getElementById('toast-title').innerHTML = data.title
        document.getElementById('toast-message').innerHTML = data.message
        $('#toast1').toast('show');

        if (dataTableToRefresh.length > 0)
          $('#'+dataTableToRefresh).DataTable().ajax.reload()

        $('#'+idModal).modal('hide');
      } else {
        document.getElementById('toast-title').innerHTML = data.title
        document.getElementById('toast-message').innerHTML = data.message
        $('#toast1').toast('show');
      }
    },
    error: function(data){
      document.getElementById('toast-title').innerHTML = 'Aviso'
      document.getElementById('toast-message').innerHTML = 'Desculpe pelo transtorno. Já estamos verificando o problema.'
      $('#toast1').toast('show');
      console.log(data);
    }
  });

}

const submitDelete = (e) =>{
  e.preventDefault();

  var myForm = document.getElementById('formDelete');
  var datatable = document.getElementById('datatable').value
  enviarViaAjax(myForm, 'modalFormDelete', datatable);
}

$('#modalFormDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var row = button.data('row')
  
  document.getElementById('tabelaDel'  ).value = button.data('tabela')
  document.getElementById('campoStatus').value = button.data('campo')
  document.getElementById('valorStatus').value = button.data('valor')
  document.getElementById('datatable'  ).value = button.data('datatable')

  if (row !== undefined){
    document.getElementById('idDel').value = row.id
    document.getElementById('labelDelete').innerHTML = 'Deseja deletar este registro ?'
    if (row.nome !== undefined){
      document.getElementById('labelDelete').innerHTML = ''
      document.getElementById('labelRegistro').innerHTML = 'Deseja deletar o registro ' + row.nome + ' ?';
    }
  }
  //console.log(row);
})

$('#modalFormDelete').on('hidden.bs.modal', function (event) {  
  document.getElementById('formDelete').reset();   
  document.getElementById('idDel').value = '';
  document.getElementById('tabelaDel').value = '';
  document.getElementById('campoStatus').value = '';
  document.getElementById('valorStatus').value = '';
  document.getElementById('datatable').value = '';
  
})

document.getElementById('formDelete').addEventListener('submit', submitDelete);