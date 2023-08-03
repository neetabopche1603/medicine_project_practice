<script>
    $(document).ready(function() {
        $('#company').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.company') }}",
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
                    data: 'company_name',
                    name: 'company_name'
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


                // -----------------------Image Popup-----------------
                // Custom JS Load After Yajra Table
                $('.companyimgPopup').click(function() {
                    var src = $(this).attr('src');
                    var $dialogBox = $('<div>').addClass('dialog-box');
                    var $image = $('<img>').attr('src', src);

                    $dialogBox.append($image).dialog({
                        modal: true,
                        title: $(this).attr('alt'),
                        width: 500,
                        height: 400,
                        close: function() {
                            $dialogBox.dialog('destroy').remove();
                        }
                    });
                });

                // ----------------------ADD COMPANY FORM -----------------------
                $('#addForm').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData();

                    let company_name = $('#company_name').val();
                    let status = $('#status').val();
                    let images = $('#images').prop('files')[0];
                    
                    formData.append('photo', images);
                    formData.append('company_name', company_name);
                    formData.append('status', status);
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.addCompany') }}",
                        data: formData,
                        contentType: 'multipart/form-data',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            $('#addDataForm').modal('hide');
                            $('#addFormSerialize')[0].reset()

                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                title: 'Company Successfully Created.',
                                showConfirmButton: true,
                                // timer: 2000
                            });
                            // Refresh the DataTable
                            $('#company').DataTable().draw(false);

                        }

                    });

                });


                // ----------------------Edit COMPANY FORM -----------------------
                // Update function
                $(document).on('click', '.editBtn', function(e) {
                    e.preventDefault();
                    var info_id = $(this).data('id');
                    // alert(info_id);
                    // console.log(info_id);
                    $.ajax({
                        type: "get",
                        url: "/admin/company-edit/" + info_id,
                        success: function(response) {
                            console.log(response)

                            $('#editDataForm').modal('show');
                            $('#infoId').val(response.editCompanyData.id)
                            $('#companyName').val(response.editCompanyData
                                .company_name)
                            $('#companyImgPic').attr('src',
                                response.editCompanyData.images)

                            if (response.editCompanyData.status == 1) {
                                $('#editStatusActive').prop('checked', true);
                            } else {
                                $('#editStatusBlock').prop('checked', true);
                            }
                        }
                    });

                });
                // ---------------------------------------------

                // Update Data without using form
                $(document).on('click', '#updateBtn', function(e) {
                    e.preventDefault();
                    let btn = $(this)

                    var formData = new FormData();
                    let infoId = $('#infoId').val();
                    let companyName = $('#companyName').val();
                    let status = $('.companyStatus:checked').val();

                    let company_img = $('#companyimages').prop('files')[0];

                    formData.append('id', infoId);
                    formData.append('photo', company_img);
                    formData.append('companyName', companyName);
                    formData.append('status', status);

                    $.ajax({
                        contentType: 'multipart/form-data',
                        type: "post",
                        url: "{{ route('admin.updateCompany') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            $('#editDataForm').modal('hide');
                            alert('Data Updated');
                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                title: 'Company Successfully Updated.',
                                showConfirmButton: true,
                                // timer: 2000
                            });
                            // Refresh the DataTable
                            $('#company').DataTable().draw(false);
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
                            $('#company').DataTable().draw(false);
                        }

                    });
                })

                // -----------------------------------------------


                // ----------------------Delete COMPANY FORM -----------------------
                $(document).on('click', '.delete-btn', function() {
                    var dataId = $(this).data('id');
                    let conf = confirm("Are You sure want to delete !");

                    if (conf) {
                        $.ajax({
                            url: "{{ route('admin.deleteCompany') }}",
                            type: "post",
                            data: {
                                // 'id': info_id
                                'id': dataId
                            },
                            success: function(response) {
                                console.log(response)
                                Swal.fire({
                                    // position: 'top-end',
                                    icon: 'success',
                                    title: 'Company Successfully Created.',
                                    showConfirmButton: true,
                                    // timer: 2000
                                });
                                // Refresh the DataTable
                                $('#company').DataTable().draw(false);
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
                                $('#company').DataTable().draw(false);
                            }
                        });
                    }
                });
                // ----------------------Delete COMPANY FORM -----------------------

                // all Delete data script function
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
                                    url: "{{ route('admin.multipleDeleteCompany') }}",
                                    data: {
                                        "ids": allVals
                                    },
                                    success: function(response) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Your data has been deleted.',
                                            'success'
                                        );

                                        $('#company').DataTable().draw(
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

{{-- Javascript Frontend side validation --}}
<script>
    const companyNameError = document.getElementById("companyNameError");
    var companyNameInput = document.getElementById("company_name");
    // Image validation
    const imageError = document.getElementById("imageError");
    var imageNameInput = document.getElementById("images");


    companyNameInput.addEventListener("keyup", validateCompanyName);

    function validateCompanyName() {
        var companyName = companyNameInput.value.trim();

        if (companyNameInput.value.trim() !== "") {
            imageNameInput.disabled = false;
        } else {
            imageNameInput.disabled = true;
            companyNameError.textContent = "Please fill the first company name";
        }

        if (companyName === "") {
            companyNameError.textContent = "Company Name is required";
            return false;
        }

        if (!/^[a-zA-Z]+$/.test(companyName)) {
            companyNameError.textContent = "Company Name should contain only letters";
            return false;
        }

        companyNameError.textContent = "";
        return true;
    }

    // Image validations
    imageNameInput.addEventListener("change", validationImages);

    function validationImages() {
        var file = imageNameInput.files[0];
        var allowedTypes = ["image/png", "image/jpeg", "image/jpg"];

        if (!file) {
            imageError.textContent = "Please select an image";
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            imageError.textContent = "Only PNG and JPG/JPEG images are allowed";
            return false;
        }

        imageError.textContent = "image is required";
        return true;
    }
</script>
