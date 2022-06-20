var table
const load = (e) => {
  table = $('#data-carteira').DataTable( {
    ajax: base_url + '/usuario/perfil/getCarteira',
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
      { data: 'tipo' },
      { data: 'nome' },
      { data: 'numero' },
      { data: 'dt_expiracao' },
      { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
    ],
    columnDefs: [{
      targets: 4,
      render: function (data, type, row, meta) {
        //console.log(data, type, row, meta);
        let dataRow = JSON.stringify(row);
        return `
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalFormCarteira"><i class="fa fa-pencil-alt"></i></a>
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalFormDelete" data-tabela="cartoes" data-campo="ativo" data-valor="Não" data-datatable="data-carteira"><i class="far fa-trash-alt"></i></a>
        `
      }
    }]
  } );


  $('#modalFormCarteira').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var row = button.data('row')
    if (row !== undefined){
      document.getElementById('id').value = row.id
      document.getElementById('tipo').value = row.tipo
      document.getElementById('numero').value = row.numero
      document.getElementById('nome').value = row.nome
      document.getElementById('dt_expiracao').value = row.dt_expiracao
      document.getElementById('cvv').value = row.cvv
      document.getElementById('bandeira').value = row.bandeira
      document.getElementById('ativo').value = row.ativo
    }
    //console.log(row);
  })

  
  $('#modalFormCarteira').on('hidden.bs.modal', function (event) {  
    document.getElementById('formAdd').reset();   
    document.getElementById('id').value = '';
    document.getElementById('ativo').value = 'Sim';
  })
}


const submitForm = (e) => {
  if (e !== undefined)
    e.preventDefault();

  var myForm = document.getElementById('formAdd');
  enviarViaAjax(myForm, "modalFormCarteira", "data-carteira")
}

/**
 *  Submit
 */
  document.getElementById('formAdd').addEventListener('submit', submitForm);

  /**
  *  Carregar
  */
  window.addEventListener('load', load);

