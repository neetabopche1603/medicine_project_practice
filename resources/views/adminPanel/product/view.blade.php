@extends('layouts.adminPanel.app')
@section('admintitle', 'View Product')
@section('admin_content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"> Product</div>
                    <div class="breadcrumb-item">View Product Details</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">View Product</h2>
                <p class="section-lead">
                  View details
                  <a href="javascript:history.back()" class="btn btn-warning float-right btn-sm"><i class="fa fa-backward"></i> Back</a>
                </p>

                <div class="card">
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Company: </b></label>
                                       <strong class="text-primary">{{$viewProduct->company_id}}</strong>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Category:</b></label>
                                        <strong class="text-primary">{{$viewProduct->category_id}}</strong>

                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Product Name :</b></label>
                                        <strong class="text-primary">{{$viewProduct->product_name}}</strong>

                                        
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_mrp" class="col-form-label"><b>MRP:</b><span
                                                class="text-danger">*</span></label>
                                                <strong class="text-primary">{{$viewProduct->mrp}}</strong>

                                    </div>
                                </div>


                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_offerPrice" class="col-form-label"><b>Offer Price:</b><span
                                                class="text-danger">*</span></label>
                                                <strong class="text-primary">{{$viewProduct->offer_price}}</strong>

                                    </div>
                                </div>


                                <div class="col-6 col-md-12">
                                    <div class="form-group">
                                        <label for="product_desc" class="col-form-label"><b>Product Description:</b></label>
                                        <p>{{strip_tags($viewProduct->product_desc)}}</p>
                                    </div>
                                </div>

                                <div class="col-6 col-md-12">
                                    <div class="form-group">
                                        <label for="product_img" class="col-form-label"><b>Image:</b><span
                                                class="text-danger">*</span></label>
                                                @php
                                                    $images = json_decode($viewProduct->product_img)
                                                @endphp
                                            @foreach ($images as $img)
                                            <img src="{{$img}}" alt="" width="50" height="50">
                                            @endforeach
                                    </div>
                                </div>


                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>Status :</b> </label>
                                        @if ($viewProduct->Status == 1)
                                        <span class="badge badge-info">Active</span>
                                        @else
                                        <span class="badge badge-dark">Archive</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>IS Featured :</b> </label>
                                        @if ($viewProduct->is_featured == 1)
                                        <span class="badge badge-primary">Featured</span>
                                        @else
                                        <span class="badge badge-secondary">No-Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                </div>

        </section>
    </div>

@endsection
