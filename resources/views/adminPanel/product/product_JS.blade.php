<script>
    // In your Javascript (external .js resource or <script> tag)
    // $(document).ready(function() {
    //     $('.companySelect').select2();
    // });

    $(document).ready(function() {
        // select company validation
        let companyNameError = $('#companyNameError').val();
        let selectCompany = $('#companyId').val();

        // select category validation 
        let categoryNameError = $('#categoryNameError').val();
        let selectCompanyInput = $('#categoryId').val();



        selectCompany.addEventListener("keyup", selectCompanyValidation);

        function selectCompanyValidation() {
            var companyName = $('#companyId').val();

            if (companyName === "" || companyName === "AL") {
                $('#companyNameError').text("Please select a company.");
                return false;
            }

            $('#companyNameError').text("");
            return true;
        }

        function selectCategoryValidation() {
            var categoryName = $('#categoryId').val();

            if (categoryName === "" || categoryName === "AL") {
                $('#categoryNameError').text("Please select a category.");
                return false;
            }

            $('#categoryNameError').text("");
            return true;
        }




    });
</script>
