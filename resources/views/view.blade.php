<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Product Management</h2>

        <table class="table table-bordered mt-4 bg-white shadow rounded"  id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody >
                <!-- Data will be dynamically loaded here -->
            </tbody>
        </table>
    </div>

    <script>
        $.ajax({
            url: "http://127.0.0.1:8000/api/products",
            type: "GET",
            dataType: "json",
            success: function(response) {
                
                let products = response.products; // Handle different response formats
                console.log(products);
               
                
                let tableBody = $("#productTable tbody");
                tableBody.empty();
                
                $.each(products, function(index, product) {
                    let row = `<tr>
                        <td>${product.id}</td>
                        <td>${product.product_name}</td>
                        <td>${product.product_code || 'N/A'}</td>
                        <td>${product.product_price}</td>
                        <td>${product.product_quantity || 'N/A'}</td>
                    </tr>`;
                    
                    tableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching products:", xhr.responseText);
                alert("Failed to fetch products");
            }
        });
    </script>

</body>
</html>
