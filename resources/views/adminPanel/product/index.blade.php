@extends('layouts.adminPanel.app')
@section('admintitle', 'Product Details')
@section('admin_content')
    @push('style')
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Category</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product</h2>
                <a href="{{ route('admin.addProductForm') }}" class="btn btn-primary  float-right"><i
                        class="fa fa-plus"></i> Add Product</a>

                <a href="javascript:void(0)" class="btn btn-danger m-3" id="deleteAll">Delete All</a>
                <a href="javascript:void(0)" class="btn btn-primary m-3" id="selectAll">All Select </a>
                <a href="javascript:void(0)" class="btn btn-info m-3" id="deselectAll">All Deselect</a>
                <div class="pb-20">
                    <p class="section-lead">
                    </p>

                    @include('layouts.alertMessage');

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="product">
                                            <thead>
                                                <tr>
                                                    <th class="">

                                                        <div class="dt-checkbox">
                                                            <input type="checkbox" name="select_all" value="1"
                                                                id="master">
                                                            <span class="dt-checkbox-label"></span>
                                                        </div>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Product</th>
                                                    <th>Is Featured</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection

@push('script')
    <script>
        
        $(document).ready(function() {
            $('#product').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.products') }}",
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_img',
                        name: 'product_img'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'is_featured',
                        name: 'is_featured'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    },
                    // Add more columns as needed
                ],

                initComplete: function() {


                    // Toggle Switch click event
                    $(document).on('click', '.toggle-button', function() {
                        var itemId = $(this).data('id');
                        var currentStatus = $(this).data('status');
                        $.ajax({
                            method: 'POST',
                            url: '{{ route('admin.toggleStatus', '') }}/' + itemId, // Use named route here
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                alert(data.message);
                                var newStatus = currentStatus ? 'Off' : 'On';
                                $(this).html(newStatus);
                                $(this).data('status', !currentStatus);
                            },
                            error: function(error) {
                                alert('Error occurred while updating status.');
                            }
                        });
                    });


                    // -----------------------Image Popup-----------------
                    // Custom JS Load After Yajra Table
                    $('.productimgPopup').click(function() {
                        var src = $(this).attr('src');
                        var $dialogBox = $('<div>').addClass('dialog-box');
                        var $image = $('<img>').attr('src', src);

                        $dialogBox.append($image).dialog({
                            modal: true,
                            title: $(this).attr('alt'),
                            width: 500,
                            height: 500,
                            close: function() {
                                $dialogBox.dialog('destroy').remove();
                            }
                        });
                    });




                    // ----------------------Delete PRODUCT FORM -----------------------

                    // all Delete data script function
                    // Multiple Rows Delete Function

                    // Select All
                    $('#selectAll').click(function() {
                        $(".sub_chk").prop('checked', true);
                        $('#master').prop('checked', true);
                    });

                    // Deselect All
                    $('#deselectAll').click(function() {
                        $(".sub_chk").prop('checked', false);
                        $('#master').prop('checked', false);
                    });


                    $('#master').on('click', function(e) {
                        if ($(this).is(':checked', true)) {
                            $(".sub_chk").prop('checked', true);
                        } else {
                            $(".sub_chk").prop('checked', false);
                        }
                    });



                    $(document).on('click', '#deleteAll', function(e) {
                        e.preventDefault();
                        var allVals = [];
                        $(".sub_chk:checked").each(function() {
                            allVals.push($(this).attr('data-id'));
                        });

                        if (allVals.length > 0) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "post",
                                        url: "{{ route('admin.productDestroy') }}",
                                        data: {
                                            "ids": allVals
                                        },
                                        success: function(response) {
                                            Swal.fire(
                                                'Deleted!',
                                                'Your data has been deleted.',
                                                'success'
                                            );

                                            $('#product').DataTable().draw(
                                                false);
                                            $("#master").is(':checked',
                                                false)
                                            table
                                                .draw();
                                            // Redraw the table to update the data
                                        }
                                    });
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please select at least one record!',
                            })
                        }
                    });

                }
            });
        });
    </script>
@endpush
