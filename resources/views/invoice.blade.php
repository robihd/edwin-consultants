@extends('layouts.layout')
@section('title', 'Invoices')
@push('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoices</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <button class="btn btn-success" data-toggle="modal" data-target="#modal-add" onclick="loadProductList(1)">
                    <i class="fas fa-plus">
                    </i>
                    Add New Invoice
                  </button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Customer</th>
                    <th>Total Belanja</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  {{-- <tr>
                    <td>10/10/2023</td>
                    <td>Produk 1</td>
                    <td>Alexander</td>
                    <td>Rp100.000</td>
                    <td class="project-actions text-right">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-view">
                        <i class="fas fa-eye">
                        </i>
                        View
                    </button>
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </button>
                      <button class="btn btn-danger btn-sm" >
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </button>
                    </td>
                  </tr> --}}
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Main content -->
            
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Add New Invoice</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="form-add-invoice">
            <div class="card-body">
              <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="invoice_date"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputKodeProduk">Nama Customer:</label>
                <input type="text" class="form-control" id="inputKodeProduk" placeholder="P001" name="customer_name">
              </div>
              <div class="product-entry">
                <div class="form-group add-product">
                  <label for="product1">Produk:</label>
                  <div class="row">
                    <div class="col-6">
                      <select id="product1" class="form-control" name="product[]">
                      </select>
                    </div>
                    <div class="col-4">
                      <input type="number" id="quantity1" name="quantity[]" class="form-control" placeholder="1" min="1">
                    </div>
                    <div class="col-2">
                      <button type="button" class="form-control btn btn-success btn-sm" onclick="addProduct()"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Add New Invoice</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="form-edit-invoice">
            <div class="card-body">
              <div class="form-group">
                <label>Tanggal:</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="invoice_date"/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputKodeProduk">Nama Customer:</label>
                <input type="text" class="form-control" id="inputKodeProduk" placeholder="P001" name="customer_name">
              </div>
              <div class="product-entry">
                <div class="form-group add-product">
                  <label for="product1">Produk:</label>
                  <div class="row">
                    <div class="col-6">
                      <select id="product1" class="form-control" name="product[]">
                      </select>
                    </div>
                    <div class="col-4">
                      <input type="number" id="quantity1" name="quantity[]" class="form-control" placeholder="1" min="1">
                    </div>
                    <div class="col-2">
                      <button type="button" class="form-control btn btn-success btn-sm" onclick="addProduct()"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Invoice Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Edwin Consultants
                  <small class="float-right" id="invoiceDate"></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <b>Nomor Invoice:</b> <span id="invoiceId"></span><br>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Nama Customer:</b> <span id="customerName"></span><br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <br>
            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped" >
                  <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Harga Satuan</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody id="listProduk">
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-8">
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="row">
                  <div class="col-6">Total:</div>
                  <div class="col-6"><b><span id="totalAmount"></span></b></div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@push('scripts')

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script type="text/javascript">
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1]
      }]
    });

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  });
</script>

<script>
  var baseUrl = "{{url('api/invoices')}}"
  const currencySymbol = 'Rp';
  const clearDataTable = () => {
    $('#example1').DataTable().clear().draw();
  };

  const getDataInvoices = () => {
    $.ajax({
        url: baseUrl,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data)
            clearDataTable();
            
            // Add the new invoice data with action buttons
            data.invoices.forEach(invoice => {
                const actionButtons = `
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-view" onclick="viewInvoice(${invoice.id})">
                          <i class="fas fa-eye">
                          </i>
                          View
                      </button>
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit" onclick="editInvoice(${invoice.id})">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </button>
                      <button class="btn btn-danger btn-sm" onclick="deleteInvoice(${invoice.id})" >
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </button>
                    `;
                $('#example1').DataTable().row.add([invoice.invoice_date, invoice.invoice_number, invoice.customer_name, invoice.total_amount, actionButtons]).draw();
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching invoice data:', error);
        }
    });
  };

  function addInvoice(invoiceId) {
    event.preventDefault();
    // Serialize the form data
    const formData = $('#form-add-invoice').serialize();

    // Make an AJAX POST request to add the invoice
    $.ajax({
        url: baseUrl, 
        type: 'POST',
        data: formData,
        success: function(response) {
            getDataInvoices();

            // Close the modal
            $('#modal-add').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Error adding invoice:', error);
        }
    });
  }

  function editInvoice(invoiceId) {
    // Implement your edit logic here
    $.ajax({
        url: `${baseUrl}/${invoiceId}`, // Replace with your actual URL for fetching invoice data by ID
        type: 'GET',
        dataType: 'json',
        success: function(invoice) {
            // Populate the form fields with the invoice data
            $('#inputEditKodeProduk').val(invoice.code);
            $('#inputEditKNamaProduk').val(invoice.name);
            $('#inputEditKHargaProduk').val(invoice.price);
            $('#inputEditKDiskonProduk').val(invoice.discount);
            $('#ProdukId').val(invoice.id);

            // Show the modal
            $('#modal-edit').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching invoice data for editing:', error);
        }
    });
  }

  function updateInvoice() {
    event.preventDefault();
    // Serialize the form data
    const formData = $('#form-edit-invoice').serialize();
    let invoiceId = $('#ProdukId').val();
    // Make an AJAX PUT request to add the invoice
    $.ajax({
        url: `${baseUrl}/${invoiceId}`, 
        type: 'PUT',
        data: formData,
        success: function(response) {
            getDataInvoices();

            // Close the modal
            $('#modal-edit').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Error updating invoice:', error);
        }
    });
  }

  function deleteInvoice(invoiceId) {
    // Show a SweetAlert confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this invoice!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with delete
            proceedToDelete(invoiceId);
        }
    });
  }

  // Function to proceed with the delete action
function proceedToDelete(invoiceId) {
    // Make an AJAX DELETE request to delete the invoice
    $.ajax({
        url: `${baseUrl}/${invoiceId}`, // Replace with your actual URL for deleting a invoice
        type: 'DELETE',  // Use DELETE method for deletion
        success: function(response) {
            // Assuming response contains a success message or any other useful information
            Swal.fire('Deleted!', response.message, 'success');
            // You can update the DataTable to remove the deleted invoice's row if needed
            getDataInvoices();
        },
        error: function(xhr, status, error) {
            console.error('Error deleting invoice:', error);
            Swal.fire('Error', 'Could not delete the invoice. Please try again later.', 'error');
        }
    });
}

// Function to display invoice details and transactions in a modal
function viewInvoice(invoiceId) {
    // Make an AJAX request to fetch invoice details and transactions
    $.ajax({
        url: `${baseUrl}/${invoiceId}`, // Replace with your actual URL for fetching invoice details
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Update modal content with invoice details and transactions
            $('#invoiceId').text(data.invoice.invoice_number);
            $('#customerName').text(data.invoice.customer_name);
            $('#invoiceDate').text(data.invoice.invoice_date);
            $('#totalAmount').text(formatCurrency(data.invoice.total_amount, currencySymbol));

            const transactionDetails = $('#listProduk');
            transactionDetails.empty();  // Clear any existing data

            // Loop through transactions and append them to the modal
            data.invoice.transactions.forEach(transaction => {
                const row = `<tr>
                                <td>${transaction.item_quantity}</td>
                                <td>${transaction.product.name}</td>
                                <td>${formatCurrency(transaction.item_price, currencySymbol)}</td>
                                <td>${transaction.item_discount}</td>
                                <td>${formatCurrency(transaction.total_price, currencySymbol)}</td>
                            </tr>`;
                transactionDetails.append(row);
            });

            // Show the modal
            $('#invoiceModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching invoice details:', error);
        }
    });
}

  getDataInvoices();

  $('#modal-add').on('hidden.bs.modal', function () {
    $('#form-add-invoice')[0].reset(); // Reset the form to clear the fields
  });
  $('#modal-edit').on('hidden.bs.modal', function () {
    $('#form-edit-invoice')[0].reset(); // Reset the form to clear the fields
  });
</script>

<script>
  let productCount = 1;

function addProduct() {
    productCount++;

    $.ajax({
        url: 'http://127.0.0.1:8000/api/products', // Replace with your actual URL to fetch the product list
        type: 'GET',
        dataType: 'json',
        success: function(products) {
          console.log(products)
          const formContainer = $('.product-entry');
          const productEntry = $('<div class="form-group add-product"><hr>' +
              '<label for="product' + productCount + '">Produk:</label>' +
              '<div class="row">' +
              '<div class="col-6">' +
              '<select class="form-control" id="product' + productCount + '" name="product[]">' +
              '</select>' +
              '</div>' +
              '<div class="col-4">' +
              '<input class="form-control" type="number" id="quantity' + productCount + '" name="quantity[]" placeholder="1" min="1" required>' +
              '</div>' +
              '<div class="col-2">' +
              '<button type="button" class="form-control btn btn-danger btn-sm" onclick="removeProduct(this)"><i class="fas fa-minus"></i></button>' +
              '</div>' +
              '</div>' +
              '</div>');

          formContainer.append(productEntry);
          const productDropdown = $(`#product${productCount}`);
            products.forEach(product => {
                productDropdown.append(`<option value="${product.id}">${product.name}</option>`);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching product list:', error);
        }
    });

    
}

function removeProduct(button) {
    $(button).closest('.add-product').remove();
}

function submitInvoice() {
    // Implement the logic to submit the invoice here
    // You can access the product and quantity data using jQuery or other DOM manipulation methods
    // Iterate through the products and quantities and gather the data for submission
    alert('Invoice submitted!');
}

function formatCurrency(price, currencySymbol) {
    const formattedPrice = parseFloat(price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    return currencySymbol + formattedPrice;
}
</script>
<script>
  function loadProductList(id) {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/products', // Replace with your actual URL to fetch the product list
        type: 'GET',
        dataType: 'json',
        success: function(products) {
            const productDropdown = $(`#product${id}`);
            console.log(productDropdown)
            productDropdown.empty(); // Clear any existing options

            products.forEach(product => {
                productDropdown.append(`<option value="${product.id}">${product.name}</option>`);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching product list:', error);
        }
    });
}
</script>
@endpush