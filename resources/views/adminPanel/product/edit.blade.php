@extends('layouts.adminPanel.app')
@section('admintitle', 'Edit Product')
@section('admin_content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Product</div>
                    <div class="breadcrumb-item">Edit Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Product</h2>
                <p class="section-lead">
                    Edit the form
                    <a href="javascript:history.back()" class="btn btn-warning float-right btn-sm"><i
                            class="fa fa-backward"></i> Back</a>
                </p>

                <div class="card">
                    <form action="{{ route('admin.productUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $editProductForm->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Select Company: <span
                                                    class="text-danger">*</span></b></label>
                                        <select class="form-control" name="companyId" id="">
                                            <option value="" selected disabled>--Select Company--</option>
                                            @foreach ($company as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $editProductForm->company_id ? 'selected' : '' }}>
                                                    {{ $row->company_name }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Select Category:<span
                                                    class="text-danger">*</span></b></label>
                                        <select class="form-control" name="categoryId" id="categoryId">
                                            @foreach ($category as $data)
                                                <option value="{{ $data->id }}"
                                                    {{ $data->id == $editProductForm->category_id ? 'selected' : '' }}>
                                                    {{ $data->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product1"><b>Product Name :<span
                                                    class="text-danger">*</span></b></label>
                                        <input type="text" class="form-control" name="product_name" id="product_name"
                                            value="{{ $editProductForm->product_name }}">
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_mrp" class="col-form-label"><b>MRP:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_mrp" id="product_mrp"
                                            value="{{ $editProductForm->mrp }}">
                                    </div>
                                </div>


                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_offerPrice" class="col-form-label"><b>Offer Price:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_offerPrice"
                                            id="product_offerPrice" value="{{ $editProductForm->offer_price }}">
                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label for="product_img" class="col-form-label"><b>Image:</b><span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="product_img[]" id="product_img"
                                            multiple>
                                        @php
                                            $images = json_decode($editProductForm->product_img);
                                        @endphp
                                        @if (!empty($images))
                                            
                                        @foreach ($images as $key => $img)
                                            <div id="img{{ $key }}" style="display: inline-flex;">
                                                <img src="{{ $img }}" alt="{{ $img }}" width="50"
                                                    height="50">

                                                <a href="javascript:void(0)" class="text-danger imgRemove"
                                                    data-key="{{ $key }}" data-id="{{ $editProductForm->id }}"
                                                    data-name="{{ $img }}"><i class="fa fa-times"></i></a>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                </div>


                                <div class="col-6 col-md-12">
                                    <div class="form-group">
                                        <label for="product_desc" class="col-form-label"><b>Product Description:</b><span
                                                class="text-danger">*</span></label>
                                        <textarea name="product_desc" id="product_desc" cols="30" rows="10" class="form-control">{{ $editProductForm->product_desc }}</textarea>
                                    </div>
                                </div>


                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>Status :</b> </label>
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input categoryStatus" name="status"
                                                id="productStatusActive" value="1"
                                                @if ($editProductForm->status == 1) checked @endif>
                                            Active &nbsp;
                                            <input type="radio" class="form-check-input categoryStatus" name="status"
                                                id="productStatusBlock" value="0"
                                                @if ($editProductForm->status == 0) checked @endif>
                                            Archive
                                        </div>

                                    </div>
                                </div>

                                <div class="col-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label mr-4"> <b>IS Featured :</b> </label>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="is_feature"
                                                id="" value="1"
                                                {{ $editProductForm->is_feature == 1 ? 'checked' : '0' }}>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Update Product">

                            </div>
                        </div>
                    </form>
                </div>
        </section>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.imgRemove').on('click', function() {
                let cmr = confirm('Are you sure to delete this image?');
                if (cmr) {
                    let id = $(this).data('id');
                    let imagename = $(this).data('name');
                    let key = $(this).data('key');
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.productUpdateTimeDeleteImg') }}",
                        data: {
                            'id': id,
                            'imagename': imagename
                        },
                        success: function(response) {
                            // console.log(response,"res");
                            if (response.msg === 'success') {
                                // console.log(`#img${key}`);
                                $(`#img${key}`).remove();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
