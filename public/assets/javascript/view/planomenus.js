
  var table
  const load = (e) => {
    table = $('#datatable').DataTable( {
      ajax: base_url + '/planomenus/get/'+id, //retornar json
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
        { data: 'menu' },
        { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
      ],
      columnDefs: [{
        targets: 1,
      render: function (data, type, row, meta) {
          let dataRow = JSON.stringify(row);
          return `
          <a class='btn btn-sm btn-icon btn-secondary' data-row='${dataRow}' data-toggle='modal' href='#modalForm'><i class='fa fa-pencil-alt'></i></a>
          <a class='btn btn-sm btn-icon btn-secondary' data-row='${dataRow}' data-toggle='modal' href='#modalFormDelete' data-tabela='dev_plano_menus' data-campo='ativo' data-valor='Não' data-datatable='datatable'><i class='far fa-trash-alt'></i></a>
          <!-- <a class='btn btn-sm btn-icon btn-secondary' data-row='${dataRow}' href='${base_url}/[controller]/[method]/[param1]/${row.id}' role='button' data-toggle='tooltip' data-placement='top' title='[Titulo Filho]'><i class='fab fa-elementor'></i></a> -->
          `
        }
      }]
    } );
  
  
    $('#modalForm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var row = button.data('row')
      if (row !== undefined){
        document.getElementById('id').value = row.id // campos da tabela				
        document.getElementById('nome').value = row.nome // campos da tabela				
        document.getElementById('ativo').value = row.ativo // campos da tabela				
        document.getElementById('plano_id').value = row.plano_id // campos da tabela				
        document.getElementById('menu_id').value = row.menu_id // campos da tabela
      }
      //console.log(row);
    })
  
    
    $('#modalForm').on('hidden.bs.modal', function (event) {  
      document.getElementById('formAdd').reset();   
      document.getElementById('id').value = '';		
      document.getElementById('nome').value = '';		
      document.getElementById('ativo').value = '';		
      document.getElementById('plano_id').value = '';		
      document.getElementById('menu_id').value = '';
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
  