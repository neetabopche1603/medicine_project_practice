@extends('layouts.adminPanel.app')
@section('admintitle', 'Category Details')
@section('admin_content')
    @push('style')
        <!-- Include jQuery UI CSS -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Companies Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Category</a></div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Category</h2>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#categoryAddDataForm" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i>
                    Add Category</button>

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
                                        <table class="table table-striped" id="category">
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
                                                    <th>Category</th>
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



    <!-- Add Model Form -->
    <div class="modal fade" id="categoryAddDataForm" tabindex="-1" role="dialog"
        aria-labelledby="categoryAddDataFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddDataFormLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.categoryStore') }}" id="addFormcategories">
                        @csrf
                        <div class="form-group">
                            <label for="company_name" class="col-form-label">Category Name:<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                            <span id="categoryNameError" class="error text-danger"></span>
                        </div>


                        <div class="form-group">
                            <label for="images" class="col-form-label">Image:<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="cate_images" id="cate_images" disabled
                                required>
                            <span id="catImageError" class="error text-danger"></span>

                        </div>

                        <div class="form-group">
                            <label class="form-check-label mr-4"> Status </label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1"
                                    checked> Active
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="form-check-input" name="status" id="status" value="0">
                                Block
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addCategoryForm">Add</button>
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
    @include('adminPanel.category.catJs');
@endpush
