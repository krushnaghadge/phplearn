<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container mt-4">
    <h2 class="text-center">Product List</h2>
    <button class="btn btn-success mb-3" id="addProductBtn">Add Product</button>
    
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Exp Date</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTable"></tbody>
    </table>

    <!-- Add & Update Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="product_id">
                    <input type="text" class="form-control mb-2" id="product_name" placeholder="Product Name" required>
                    <input type="number" class="form-control mb-2" id="product_price" placeholder="Price" required>
                    <input type="number" class="form-control mb-2" id="product_qty" placeholder="Quantity" required>
                    <input type="text" class="form-control mb-2" id="product_description" placeholder="Description">
                    <input type="date" class="form-control mb-2" id="product_exp_date">
                    <input type="text" class="form-control mb-2" id="product_company" placeholder="Company">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveProduct">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            fetchProducts();
        });

        function fetchProducts() {
            $.ajax({
                url: "getAll.php",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    let tableData = "";
                    response.forEach((product) => {
                        tableData += `
                            <tr>
                                <td>${product.product_id}</td>
                                <td>${product.product_name}</td>
                                <td>${product.product_price}</td>
                                <td>${product.product_qty}</td>
                                <td>${product.product_description || 'N/A'}</td>
                                <td>${product.product_exp_date || 'N/A'}</td>
                                <td>${product.product_company || 'N/A'}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editProduct(${product.product_id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.product_id})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $("#productTable").html(tableData);
                },
                error: function () {
                    alert("Error fetching product data");
                }
            });
        }

        $("#addProductBtn").click(function () {
            $("#modalTitle").text("Add Product");
            $("#product_id").val("");
            $("#product_name, #product_price, #product_qty, #product_description, #product_exp_date, #product_company").val("");
            $("#productModal").modal("show");
        });

        $("#saveProduct").click(function () {
            let id = $("#product_id").val();
            let data = {
                product_id: id ? id : null,  // Use NULL for new products
                product_name: $("#product_name").val(),
                product_price: $("#product_price").val(),
                product_qty: $("#product_qty").val(),
                product_description: $("#product_description").val(),
                product_exp_date: $("#product_exp_date").val(),
                product_company: $("#product_company").val()
            };

            let url = id ? "updateProduct.php" : "addProduct.php";
            let method = id ? "PUT" : "POST";

            $.ajax({
                url: url,
                type: method,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {
                    alert(response.message);
                    $("#productModal").modal("hide");
                    fetchProducts();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("Error saving product");
                }
            });
        });

        function editProduct(id) {
            $.ajax({
                url: "getById.php",
                type: "GET",
                data: { id: id },
                dataType: "json",
                success: function (data) {
                    $("#modalTitle").text("Edit Product");
                    $("#product_id").val(data.product_id);
                    $("#product_name").val(data.product_name);
                    $("#product_price").val(data.product_price);
                    $("#product_qty").val(data.product_qty);
                    $("#product_description").val(data.product_description);
                    $("#product_exp_date").val(data.product_exp_date);
                    $("#product_company").val(data.product_company);
                    $("#productModal").modal("show");
                },
                error: function () {
                    alert("Error fetching product details");
                }
            });
        }

        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: "deleteProduct.php",
                    type: "DELETE",
                    data: JSON.stringify({ id: id }),
                    contentType: "application/json",
                    success: function (response) {
                        alert(response.message);
                        fetchProducts();
                    },
                    error: function () {
                        alert("Error deleting product");
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
