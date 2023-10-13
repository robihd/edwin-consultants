@extends('layouts.layout')
@push('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@section('title', 'Products')
@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <button class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                    <i class="fas fa-plus">
                    </i>
                    Add New Product
                  </button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Discount</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  {{-- <tr>
                    <td>P001</td>
                    <td>Produk 1</td>
                    <td>Rp100.000</td>
                    <td>10%</td>
                    <td class="project-actions text-right">
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Add New Product</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="form-add-product">
            <div class="card-body">
              <div class="form-group">
                <label for="inputKodeProduk">Kode</label>
                <input type="text" class="form-control" id="inputKodeProduk" placeholder="P001" name="code">
              </div>
              <div class="form-group">
                <label for="inputNamaProduk">Nama Produk</label>
                <input type="text" class="form-control" id="inputNamaProduk" placeholder="Tabung gas" name="name">
              </div>
              <div class="form-group">
                <label for="inputHargaProduk">Harga Produk</label>
                <input type="text" class="form-control" id="inputHargaProduk" placeholder="20000" name="price">
              </div>
              <div class="form-group">
                <label for="inputDiskonProduk">Diskon</label>
                <input type="text" class="form-control" id="inputDiskonProduk" placeholder="10" name="discount">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" onclick="addProduct()">Submit</button>
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
            <h3 class="card-title">Edit Product</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="form-edit-product">
            <div class="card-body">
              <div class="form-group">
                <label for="inputKodeProduk">Kode</label>
                <input type="text" class="form-control" id="inputEditKodeProduk" placeholder="P001" name="code">
              </div>
              <div class="form-group">
                <label for="inputNamaProduk">Nama Produk</label>
                <input type="text" class="form-control" id="inputEditKNamaProduk" placeholder="Tabung gas" name="name">
              </div>
              <div class="form-group">
                <label for="inputHargaProduk">Harga Produk</label>
                <input type="text" class="form-control" id="inputEditKHargaProduk" placeholder="20000" name="price">
              </div>
              <div class="form-group">
                <label for="inputDiskonProduk">Diskon</label>
                <input type="text" class="form-control" id="inputEditKDiskonProduk" placeholder="10" name="discount">
              </div>
            </div>
            <input id="ProdukId" type="hidden" >
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" onclick="updateProduct()">Update</button>
            </div>
          </form>
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
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  var baseUrl = "{{url('api/products')}}"
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1],
        'className': 'project-actions text-right'
      }]
    });
  });

  const clearDataTable = () => {
    $('#example1').DataTable().clear().draw();
  };

  const getDataProducts = () => {
    $.ajax({
        url: baseUrl,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data)
            clearDataTable();
            
            // Add the new product data with action buttons
            data.forEach(product => {
                const actionButtons = `
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit" onclick="editProduct(${product.id})">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                      </button>
                      <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})" >
                          <i class="fas fa-trash">
                          </i>
                          Delete
                      </button>
                    `;
                $('#example1').DataTable().row.add([product.code, product.name, product.price, product.discount, actionButtons]).draw();
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching product data:', error);
        }
    });
  };

  function addProduct(productId) {
    event.preventDefault();
    // Serialize the form data
    const formData = $('#form-add-product').serialize();

    // Make an AJAX POST request to add the product
    $.ajax({
        url: baseUrl, 
        type: 'POST',
        data: formData,
        success: function(response) {
            getDataProducts();

            // Close the modal
            $('#modal-add').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Error adding product:', error);
        }
    });
  }

  function editProduct(productId) {
    // Implement your edit logic here
    $.ajax({
        url: `${baseUrl}/${productId}`, // Replace with your actual URL for fetching product data by ID
        type: 'GET',
        dataType: 'json',
        success: function(product) {
            // Populate the form fields with the product data
            $('#inputEditKodeProduk').val(product.code);
            $('#inputEditKNamaProduk').val(product.name);
            $('#inputEditKHargaProduk').val(product.price);
            $('#inputEditKDiskonProduk').val(product.discount);
            $('#ProdukId').val(product.id);

            // Show the modal
            $('#modal-edit').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching product data for editing:', error);
        }
    });
  }

  function updateProduct() {
    event.preventDefault();
    // Serialize the form data
    const formData = $('#form-edit-product').serialize();
    let productId = $('#ProdukId').val();
    // Make an AJAX PUT request to add the product
    $.ajax({
        url: `${baseUrl}/${productId}`, 
        type: 'PUT',
        data: formData,
        success: function(response) {
            getDataProducts();

            // Close the modal
            $('#modal-edit').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Error updating product:', error);
        }
    });
  }

  function deleteProduct(productId) {
    // Show a SweetAlert confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this product!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with delete
            proceedToDelete(productId);
        }
    });
  }

  // Function to proceed with the delete action
function proceedToDelete(productId) {
    // Make an AJAX DELETE request to delete the product
    $.ajax({
        url: `${baseUrl}/${productId}`, // Replace with your actual URL for deleting a product
        type: 'DELETE',  // Use DELETE method for deletion
        success: function(response) {
            // Assuming response contains a success message or any other useful information
            Swal.fire('Deleted!', response.message, 'success');
            // You can update the DataTable to remove the deleted product's row if needed
            getDataProducts();
        },
        error: function(xhr, status, error) {
            console.error('Error deleting product:', error);
            Swal.fire('Error', 'Could not delete the product. Please try again later.', 'error');
        }
    });
}

  getDataProducts();

  $('#modal-add').on('hidden.bs.modal', function () {
    $('#form-add-product')[0].reset(); // Reset the form to clear the fields
  });
  $('#modal-edit').on('hidden.bs.modal', function () {
    $('#form-edit-product')[0].reset(); // Reset the form to clear the fields
  });
</script>
@endpush