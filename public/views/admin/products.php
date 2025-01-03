<link rel="stylesheet" href="css/admin/products.css">

<div class="container-products-admin">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">Products</h5>
        <button class="btn btn-add" id="btn-add-product">Add Product</button>
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
                            <button class='btn btn-edit' data-id=$id><i class='fa fa-edit'></i></button>
                            </td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="overlay d-none" id="overlay">
        <div class="form-container-add-product d-none" id="form-container-add-product">
            <h4>ADD NEW PRODUCT</h4>
            <form id="product-form">
                <input type="text" name="product_name" id="product_name" placeholder="Enter product name" required>
                <input type="text" name="image_link" id="image_link" placeholder="Product Image Link" required>
                <div class="form-row">
                    <select name="category" id="category" required>
                        <option value="MEN">MEN</option>
                        <option value="WOMEN">WOMEN</option>
                        <option value="CHILDREN">CHILDREN</option>
                    </select>                  
                    <select name="color" id="color" required>
                        <option value="BROWN">BROWN</option>
                        <option value="DARK">DARK</option>
                        <option value="WHITE">WHITE</option>
                    </select>
                </div>             
                <input type="number" name="price" id="price" placeholder="Price" required>
                <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
                <textarea name="description" id="description" placeholder="Enter description" required></textarea>              
                <button type="button" id="add-product-btn">ADD PRODUCT</button>
            </form>
        </div>
        <div id="form-container-update-product" class="form-container-update-product d-none">
            <h4>UPDATE PRODUCT INFORMATION</h4>
            <form id="update-product-form" >
                <input type="text" name="product_name" id="update-product_name" placeholder="Enter new product name" required>
                <input type="text" name="image_link" id="update-image_link" placeholder="Enter new image link" required>
                <input type="number" name="price" id="update-price" placeholder="Enter new price" required>
                <input type="number" name="quantity" id="update-quantity" placeholder="Enter new quantity" required>
                <select name="category" id="update-category" required>
                    <option value="MEN">MEN</option>
                    <option value="WOMEN">WOMEN</option>
                    <option value="CHILDREN">CHILDREN</option>
                </select>
                <textarea name="description" id="update-description" placeholder="Enter description" required></textarea> 
                <button type="button" id="update-product-btn">UPDATE PRODUCT</button>
            </form>
        </div>
    </div>
</div>

<script src="js/admin/products.js" type="module"></script>


