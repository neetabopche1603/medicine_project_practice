@extends('layouts.adminPanel.app')
@section('admintitle', 'Add Product')
@section('admin_content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>

                    <div class="breadcrumb-item">Add Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Add Product</h2>
                <p class="section-lead">
                    Fill the form
                </p>

                <div class="card">
                    <form action="{{route('admin.productStore')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Select Company: <span
                                                    class="text-danger">*</span></b></label>
                                        <select class="form-control companySelect" name="companyId" id="companyId">
                                            <option value="">--Select Company--</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="companyNameError" class="error text-danger"></span>

                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Select Category:<span
                                                    class="text-danger">*</span></b></label>
                                        <select class="form-control" name="categoryId" id="categoryId">
                                            <option value="">--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                        <span id="categoryNameError" class="error text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Product Name :<span
                                                    class="text-danger">*</span></b></label>
                                        <input type="text" class="form-control" name="product_name" id="product_name"
                                            required>
                                        <span id="productNameError" class="error text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_mrp" class="col-form-label"><b>MRP:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_mrp" id="product_mrp"
                                            required>
                                        <span id="productMRPError" class="error text-danger"></span>
                                    </div>
                                </div>


                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_offerPrice" class="col-form-label"><b>Offer Price:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_offerPrice" id="product_offerPrice"
                                            required>
                                        <span id="offerPriceError" class="error text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_img" class="col-form-label"><b>Image:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="product_img[]" id="product_img"
                                        multiple  required>
                                        <span id="productImageError" class="error text-danger"></span>
    
                                    </div>
                                </div>


                                <div class="col-6 col-md-12">
                                    <div class="form-group">
                                        <label for="product_desc" class="col-form-label"><b>Product Description:</b><span
                                                class="text-danger">*</span></label>
                                        <textarea name="product_desc" id="product_desc" cols="30" rows="10" class="form-control"></textarea>
                                        <span id="productDescError" class="error text-danger"></span>
                                    </div>
                                </div>

                             
                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>Status :</b> </label>
                                        <div class="form-check-inline">
                                                <input type="radio" class="form-check-input categoryStatus" name="status"
                                                    id="productStatusActive" value="1" checked> Active
                                                    &nbsp;
                                                    <input type="radio" class="form-check-input categoryStatus" name="status"
                                                    id="productStatusBlock" value="0">
                                               Archive
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>IS Featured :</b> </label>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="is_feature"
                                                id="" value="1" >
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Add Product">

                            </div>
                        </div>
                    </form>
                </div>

        </section>
    </div>

@endsection
