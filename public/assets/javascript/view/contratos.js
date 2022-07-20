
  var table
  const load = (e) => {
    table = $('#datatable').DataTable( {
      ajax: base_url + '/contratos/get', //retornar json
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
        { data: 'plano' },
        { data: 'dt_contrato' },
        { data: 'dt_fim' },
        { data: 'status' },
        { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
      ]
    } );
  
  
    $('#modalForm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var row = button.data('row')
      if (row !== undefined){
        				document.getElementById('id').value = row.id // campos da tabela				document.getElementById('nome').value = row.nome // campos da tabela				document.getElementById('ativo').value = row.ativo // campos da tabela				document.getElementById('dt_contrato').value = row.dt_contrato // campos da tabela				document.getElementById('plano_id').value = row.plano_id // campos da tabela				document.getElementById('empresa_id').value = row.empresa_id // campos da tabela				document.getElementById('status').value = row.status // campos da tabela				document.getElementById('dt_fim').value = row.dt_fim // campos da tabela
      }
      //console.log(row);
    })
  
    
    $('#modalForm').on('hidden.bs.modal', function (event) {  
      document.getElementById('formAdd').reset();   
      		document.getElementById('id').value = '';		document.getElementById('nome').value = '';		document.getElementById('ativo').value = '';		document.getElementById('dt_contrato').value = '';		document.getElementById('plano_id').value = '';		document.getElementById('empresa_id').value = '';		document.getElementById('status').value = '';		document.getElementById('dt_fim').value = '';
    })
  }
  
  
  const submitForm = (e) => {
    if (e !== undefined)
      e.preventDefault();
  
    var myForm = document.getElementById('formAdd');
    enviarViaAjax(myForm, 'modalForm', 'datatable')
  }
  
  /**
   *  Submit
   */
  document.getElementById('formAdd').addEventListener('submit', submitForm);
  
  /**
   *  Carregar
   */
  window.addEventListener('load', load);
  