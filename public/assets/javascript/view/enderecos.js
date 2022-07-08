var table
const load = (e) => {
  table = $('#data-endereco').DataTable( {
    ajax: base_url + '/enderecos/get/',
    responsive: true,
    dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'table-responsive'tr>
      <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
    language: {
      paginate: {
        previous: '<i class="fa fa-lg fa-angle-left"></i>',
        next: '<i class="fa fa-lg fa-angle-right"></i>'
      }
    },
    columns: [
      { data: 'nome' },
      { data: 'rua' },
      { data: 'principal' },
      { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
    ],
    columnDefs: [{
      targets: 3,
      render: function (data, type, row, meta) {
        //console.log(data, type, row, meta);
        let dataRow = JSON.stringify(row);
        return `
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalFormEndereco"><i class="fa fa-pencil-alt"></i></a>
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalFormDelete" data-tabela="enderecos" data-campo="ativo" data-valor="Não" data-datatable="data-endereco"><i class="far fa-trash-alt"></i></a>
        `
      }
    }]
  } );


  $('#modalFormEndereco').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var row = button.data('row')
    if (row !== undefined){
      document.getElementById('id').value = row.id
      document.getElementById('nome').value = row.nome
      document.getElementById('rua').value = row.rua
      document.getElementById('cep').value = row.cep
      document.getElementById('numero').value = row.numero
      document.getElementById('bairro').value = row.bairro
      document.getElementById('complemento').value = row.complemento
      document.getElementById('estado').value = row.estado
      document.getElementById('cidade').value = row.cidade
      document.getElementById('telefone').value = row.telefone
      document.getElementById('principal').value = row.principal
      document.getElementById('ativo').value = row.ativo
    }
    //console.log(row);
  })

  
  $('#modalFormEndereco').on('hidden.bs.modal', function (event) {  
    document.getElementById('formAdd').reset();   
    document.getElementById('id').value = '';
    document.getElementById('ativo').value = 'Sim';
  })
}


const submitForm = (e) => {
  if (e !== undefined)
    e.preventDefault();

  var myForm = document.getElementById('formAdd');
  enviarViaAjax(myForm, "modalFormEndereco", "data-endereco")
}

/**
 *  Submit
 */
  document.getElementById('formAdd').addEventListener('submit', submitForm);

  /**
  *  Carregar
  */
  window.addEventListener('load', load);

