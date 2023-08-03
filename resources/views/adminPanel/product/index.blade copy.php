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
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#productAddDataForm" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>
                    Add Product</button>

                <a href="javascript:void(0)" class="btn btn-danger m-3" id="deleteAll">Delete All</a>
                <a href="javascript:void(0)" class="btn btn-primary m-3" id="selectAll">All Select </a>
                <a href="javascript:void(0)" class="btn btn-info m-3" id="deselectAll">All Deselect</a>
                <div class="pb-20">
                    <p class="section-lead">
                    </p>

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

    <?php
    $companies = DB::table('companies')
        ->where(['status' => 1])
        ->get();
    $categories = DB::table('categories')
        ->where(['status' => 1])
        ->get();
    ?>
    <!-- Add Model Form -->
    <div class="modal fade" id="productAddDataForm" tabindex="-1" role="dialog" aria-labelledby="productAddDataFormLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light text-center p-4">
                    <h5 class="modal-title" id="productAddDataFormLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" id="addFormProduct">
                        @csrf
                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="product1"><b>Select Company: <span
                                        class="text-danger">*</span></b></label>
                                    <select class="form-control companySelect" id="companyId">
                                        @foreach ($companies as $company)
                                            <option value="AL">--Select Company--</option>
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="companyNameError" class="error text-danger"></span>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="product1"><b>Select Category:<span
                                        class="text-danger">*</span></b></label>
                                    <select class="form-control" id="categoryId">
                                        @foreach ($categories as $category)
                                            <option value="AL">--Select Category--</option>
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                    <span id="categoryNameError" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="company_name" class="col-form-label"><b>Product Name:</b><span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                        required>
                                    <span id="productNameError" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="product_mrp" class="col-form-label"><b>MRP:</b><span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product_mrp" id="product_mrp"
                                        required>
                                    <span id="productMRPError" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="product_offerPrice" class="col-form-label"><b>Offer Price:</b><span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product_offerPrice" id="product_offerPrice"
                                        required>
                                    <span id="offerPriceError" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product_desc" class="col-form-label"><b>Product Description:</b><span
                                            class="text-danger">*</span></label>
                                    <textarea name="product_desc" id="product_desc" cols="30" rows="10" class="form-control"></textarea>
                                    <span id="productDescError" class="error text-danger"></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product_img" class="col-form-label"><b>Image:</b><span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="product_img" id="product_img"
                                        disabled required>
                                    <span id="productImageError" class="error text-danger"></span>

                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-check-label mr-4"> <b>IS Featured :</b> </label>
                                    <div class="form-check-inline">
                                        <input type="checkbox" class="form-check-input categoryStatus" name="is_feature"
                                            id="editStatusActive" value="1">
                                    </div>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-check-label mr-4"> <b>Status :</b> </label>
                                    <div class="form-check-inline">
                                            <input type="radio" class="form-check-input categoryStatus" name="status"
                                                id="productStatusActive" value="1"> Active
                                                &nbsp;
                                                <input type="radio" class="form-check-input categoryStatus" name="status"
                                                id="productStatusBlock" value="0">
                                           Archive
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addProductForm">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Model Form -->

    <!-- Edit Model Form -->
    <div class="modal fade" id="categoryEditDataForm" tabindex="-1" role="dialog"
        aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" class="form-control" name="" id="categoryId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName" class="col-form-label">Category Name:</label>
                        <input type="text" class="form-control" name="category_name" id="categoryName">
                    </div>

                    <div class="form-group">
                        <label for="categoryImagess" class="col-form-label"> Image:</label>
                        <input type="file" class="form-control" name="" id="categoryImages">
                        <img src="" alt="" id="categoryImgPic" width="64" height="64">
                    </div>

                    {{-- <div class="form-group">
                        <label class="form-check-label mr-4"> Status </label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input categoryStatus" name="status"
                                id="editStatusActive" value="1"> Active
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" class="form-check-input categoryStatus" name="status"
                                id="editStatusBlock" value="0">
                            Block

                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="form-check-label mr-4"> Status : </label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input categoryStatus" name="status"
                                    id="editStatusActive" value="1"> Active
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input categoryStatus" name="status"
                                    id="editStatusBlock" value="0">
                                Block
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="categoryUpdateBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Model Form -->
    <!-- EDIT Model Form -->



@endsection

@push('script')
    @include('adminPanel.product.product_JS');
@endpush
