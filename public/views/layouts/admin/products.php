<link rel="stylesheet" href="css/admin/products.css">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">Products <span class="text-muted">(15 products found)</span></h5>
        <button class="btn btn-add">Add Product</button>
    </div>
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold">Product List</h6>
            <div class="input-group w-25">
            <input type="text" class="form-control" placeholder="Search">
            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
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
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jacket for boy</td>
                    <td>https://example.com/image.jpg</td>
                    <td>300,000đ</td>
                    <td>24</td>
                    <td>Men</td>
                    <td>Áo jacket nam</td>
                    <td>
                    <button class="btn btn-edit"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-delete"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jacket for boy</td>
                    <td>https://example.com/image.jpg</td>
                    <td>300,000đ</td>
                    <td>24</td>
                    <td>Men</td>
                    <td>Áo jacket nam</td>
                    <td>
                    <button class="btn btn-edit"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-delete"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="see-more">
      <button class="btn btn-outline-secondary">See more <i class="fa fa-chevron-down"></i></button>
    </div>
</div>


