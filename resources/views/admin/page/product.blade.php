@extends('admin.layout.index')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
    .pagination .page-link {
        font-size: 12px;
        padding: 4px 8px;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>

<div class="card rounded-lg shadow-lg">
    <div class="card-header bg-warning text-dark d-flex justify-content-between">
        <button class="btn btn-light" id="addData">
            <i class="fa fa-plus"></i>
            <span>Tambah Product</span>
        </button>
        <input type="text" wire:model="search" class="form-control w-25" placeholder="Search....">
    </div>
    <div class="card-body">
        <table class="table table-responsive table-striped" id="product-table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Date In</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated by DataTables -->
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mx-auto" style="max-width: 50%;">
            <div class="text-muted small">
                Data ditampilkan <span class="fw-semibold" id="data-count"></span> dari <span class="fw-semibold" id="total-count"></span>
            </div>
            <nav aria-label="Pagination" id="pagination"></nav>
        </div>
    </div>
</div>

<!-- Modal for Add Data -->
<div class="tampilData" style="display: none;"></div>
<!-- Modal for Edit Data -->
<div class="tampilEditData" style="display: none;"></div>

<script>
$(document).ready(function() {
    // Initialize DataTable with server-side processing
    var table = $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.products.data') }}", 
            method: 'GET',
            dataSrc: function(json) {
                
                $('#data-count').text(json.data.length);
                $('#total-count').text(json.recordsTotal);
                return json.data;
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'foto', name: 'foto'},
            { data: 'created_at', name: 'created_at' },
            { data: 'sku', name: 'sku' },
            { data: 'nama_product', name: 'nama_product' },
            { data: 'type', name: 'type' },
            { data: 'harga', name: 'harga' },
            { data: 'quantity', name: 'quantity' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        "order": [[1, 'asc']], 
    });

    // Add Data modal
    $('#addData').click(function() {
        $.ajax({
            url: '{{ route('addModal') }}',
            success: function(response) {
                $('.tampilData').html(response).show();
                $('#addModal').modal("show");
            }
        });
    });

    // Edit Data modal
    $(document).on('click', '.editModal', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "{{ route('editModal', ['id' => ':id']) }}".replace(':id', id),
            success: function(response) {
                $('.tampilEditData').html(response).show();
                $('#editModal').modal("show");
            }
        });
    });


    $(document).on('click', '.deleteData', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var sku = $(this).data('sku');  // Assuming SKU is stored as a data attribute
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
                setTimeout(function() {
                    table.ajax.reload();  // Reload DataTable after deleting
                }, 1000);
            },
        });

        Swal.fire({
            title: 'Hapus data ?',
            text: "Kamu yakin untuk menghapus SKU " + sku + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('deleteData', ['id' => ':id']) }}".replace(':id', id),
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Toast.fire({
                                icon: "success",
                                title: response.success,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection
