<link rel="stylesheet" href="css/admin/products.css">
<div class="container-products-admin">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">Products</h5>
        <button class="btn btn-add">Add Product</button>
    </div>
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold">Product List</h6>
            <form id="sort-form">
                <label><input type="radio" name="sort" value="increase" checked class="sort-price" id="increase"> Price Increase</label>
                <label><input type="radio" name="sort" value="decrease" class="sort-price" id="decrease"> Price Decrease</label>
                <button class="sort-btn" type="button" id="sort-btn">Sort</button>
            </form>
            <div class="input-group w-25">
                <input type="text" class="form-control" id="search-input" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button" id="submit-btn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Image Link</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Categories</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="products-list">
                <?php
                    foreach ($products as $product){
                        $id = $product['id'];
                        $name = $product['product_name'];
                        $img = $product['image_link'];
                        $price = $product['price'];
                        $quantity = $product['quantity'];
                        $category = $product['category'];
                        $description = $product['description'];
                        echo "<tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td><img src='$img'></td>
                            <td>$price</td>
                            <td>$quantity</td>
                            <td>$category</td>
                            <td>$description</td>
                            <td>
                            <button class='btn btn-edit'><i class='fa fa-edit' data-id=$id></i></button>
                            <button class='btn btn-delete'><i class='fa fa-trash' data-id=$id></i></button>
                            </td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<nav  class="w-100 d-flex justify-content-end align-items-center pe-5 mt-5">
    <ul class="pagination pagination-lg" style="max-width: 25vw; overflow-x: scroll">
        <?php
            $totalPage = $totalProducts / 10 + 1;
            if (!isset($_GET['page'])) {
                $page = 1;
            } else{
                $page = $_GET['page'];
            }
            for ($i = 1; $i <= $totalPage; $i++) {
                $active = "";
                if ($i == $page) {
                    $active = "active";
                }
                echo "<li class='page-item $active' aria-current='page'>
                        <a class='page-link' href='/admin/products?page=$i&size=10'>$i</a
                    </li>";
            }
        ?>
    </ul>
</nav>
<script src="js/admin/products.js" type="module"></script>


