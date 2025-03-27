<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Product</h2>
        <form id="productForm" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>

            <div class="mb-3">
                <label for="product_code" class="form-label">Product Code:</label>
                <input type="text" class="form-control" name="product_code" id="product_code" required>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price:</label>
                <input type="number" class="form-control" name="product_price" id="product_price" required>
            </div>

            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image:</label>
                <input type="file" class="form-control" name="product_image" id="product_image" required>
            </div>

            <div class="mb-3">
                <label for="product_description" class="form-label">Description:</label>
                <textarea class="form-control" name="product_description" id="product_description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="product_category" class="form-label">Category:</label>
                <input type="text" class="form-control" name="product_category" id="product_category" required>
            </div>

            <div class="mb-3">
                <label for="product_brand" class="form-label">Brand:</label>
                <input type="text" class="form-control" name="product_brand" id="product_brand" required>
            </div>

            <div class="mb-3">
                <label for="product_quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" name="product_quantity" id="product_quantity" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>

        <p id="responseMsg" class="mt-3 text-center"></p>
    </div>

    <script>
        $(document).ready(function () {
            $("#productForm").on('submit', function (e) {
                e.preventDefault(); // Form submit hone se roken

                let formData = new FormData(this); // Form ke sare fields ka data lena

                $.ajax({
                    url: "http://127.0.0.1:8000/api/add/product", // Laravel API ka URL
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        $("#responseMsg").html("<b style='color: green;'>Product added successfully!</b>");
                        $("#productForm")[0].reset(); // Form clear karna
                    },
                    error: function (xhr, status, error) {
                        let errMsg = "<b style='color: red;'>Error: " + xhr.responseText + "</b>";
                        $("#responseMsg").html(errMsg);
                    }
                });
            });
        });
    </script>

</body>
</html>
