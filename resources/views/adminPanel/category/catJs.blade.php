<script>
    $(document).ready(function() {
        // Data table Showing Data
        $('#category').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.category') }}",
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
                    data: 'images',
                    name: 'images'
                },
                {
                    data: 'category',
                    name: 'category'
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

                // Add form ajax
                // Add form ajax
                $("#addCategoryForm").click(function(e) {
                    e.preventDefault();

                    var formData = new FormData();
                    var category_name = $('#category_name').val();
                    var status = $('#status').val();
                    var category_img = $('#cate_images').prop('files')[0];

                    formData.append('photo', category_img);
                    formData.append('category_name', category_name);
                    formData.append('status', status);

                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.categoryStore') }}",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            $('#categoryAddDataForm').modal('hide');
                            $('#addFormcategories')[0].reset();

                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                title: 'Category Successfully Created.',
                                showConfirmButton: true,
                                // timer: 2000
                            });

                            // Refresh the DataTable
                            $('#category').DataTable().draw(false);
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error',
                                showConfirmButton: true,
                                // timer: 2000
                            });

                            // Refresh the DataTable
                            $('#category').DataTable().draw(false);
                        }
                    });
                });


                // EDIT CATEGORY FORM
                $(document).on('click', '.editBtn', function(e) {
                    e.preventDefault();
                    let dataId = $(this).data('id');
                    $.ajax({
                        type: "get",
                        url: "/admin/category-edit/" + dataId,
                        success: function(response) {
                            console.log(response)
                            $('#categoryEditDataForm').modal('show');
                            $('#categoryId').val(response.editCategoryData.id);
                            $('#categoryName').val(response.editCategoryData
                                .category);
                            $('#categoryImgPic').attr('src',
                                response.editCategoryData.image)

                            if (response.editCategoryData.status === 1) {
                                $('#editStatusActive').prop('checked', true);
                            } else {
                                $('#editStatusBlock').prop('checked', true);
                            }
                        }
                    });

                });


                $(document).on('click', '#categoryUpdateBtn', function(e) {
                    e.preventDefault();
                    let btn = $(this)

                    let id = $('#categoryId').val();
                    let categoryName = $('#categoryName').val();
                    let status = $('.categoryStatus:checked').val();
                    let categoryImages = $('#categoryImages').prop('files')[0];

                    var formData = new FormData();
                    formData.append('id', id);
                    formData.append('photo', categoryImages);
                    formData.append('category_name', categoryName);
                    formData.append('status', status);
                    $.ajax({
                        contentType: 'multipart/form-data',
                        type: "post",
                        url: "{{ route('admin.categoryUpdate') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // console.log(response)
                            $('#categoryEditDataForm').modal('hide');
                            // alert('Data Updated');
                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                title: 'category Successfully Updated.',
                                showConfirmButton: true,
                                // timer: 2000
                            });
                            // Refresh the DataTable
                            $('#category').DataTable().draw(false);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                // position: 'top-end',
                                icon: 'error',
                                title: 'Error',
                                showConfirmButton: true,
                                // timer: 2000
                            });
                            // Refresh the DataTable
                            $('#category').DataTable().draw(false);
                        }

                    });
                });

                // DELETE CATEGORY
                $(document).on('click', '.deleteBtn', function(e) {
                    e.preventDefault();
                    let deleteId = $(this).data('id');

                    let conf = confirm("Are you sure you want to delete?");
                    if (conf) {
                        $.ajax({
                            type: "post",
                            url: "{{route('admin.categoryDelete')}}",
                            data: {
                                'id': deleteId
                            },
                            success: function(response) {
                                console.log(response)
                                Swal.fire({
                                     position: 'top-end',
                                    icon: 'success',
                                    title: 'Category Successfully Deleted.',
                                    showConfirmButton: true,
                                    // timer: 2000
                                });
                                // Refresh the DataTable
                                $('#category').DataTable().draw(false);
                            },
                            error: function(error) {
                                Swal.fire({
                                     position: 'top-end',
                                    icon: 'error',
                                    title: 'Error',
                                    showConfirmButton: true,
                                    // timer: 2000
                                });
                                // Refresh the DataTable
                                $('#category').DataTable().draw(false);
                            }
                        });
                    }
                });


                // multiple delete data
                   // Multiple Rows Delete Function
                   $('#master').on('click', function(e) {
                    if ($(this).is(':checked', true)) {
                        $(".sub_chk").prop('checked', true);
                    } else {
                        $(".sub_chk").prop('checked', false);
                    }
                });

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
                                    url: "{{ route('admin.multipleDeleteCategory') }}",
                                    data: {
                                        "ids": allVals
                                    },
                                    success: function(response) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Your data has been deleted.',
                                            'success'
                                        );

                                        $('#category').DataTable().draw(
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

<script>
    //=========================Frontend Validation======================
    // Category Name
    var categoryNameInput = document.getElementById("category_name");
    var categoryError = document.getElementById("categoryNameError");
    // Image 
    var imageInput = document.getElementById("cate_images");
    var imageInputError = document.getElementById("catImageError");

    categoryNameInput.addEventListener("keyup", categorynameValidation);

    function categorynameValidation() {
        var categoryName = categoryNameInput.value.trim();

        if (categoryNameInput.value.trim() !== '') {
            imageInput.disabled = false;
        } else {
            imageInput.disabled = false;
            categoryError.textContent = "Please fill the first Category";
        }
        if (!/^[a-zA-Z]+$/.test(categoryName)) {
            categoryError.textContent = "Category Name should contain only letters";
            return false;
        }

        categoryError.textContent = "";
        return true;
    }

    // Image validation
    imageInput.addEventListener("change", imagevalidation);

    function imagevalidation() {
        var file = imageInput.files[0];
        var allowedTypes = ["image/png", "image/jpeg", "image/jpg"];

        if (!file) {
            imageInputError.textContent = "Please select an image";
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            imageInputError.textContent = "Only PNG and JPG/JPEG images are allowed";
            return false;
        }

        imageInputError.textContent = "";
        return true;
    }
    // ----------------------------------Validation end----------------------------------------------
</script>
