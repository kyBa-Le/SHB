<?php ?>
<link rel="stylesheet" href="css/product.css">
<h1 class="text-center mt-5"><?php echo $category ?>'s fashion</h1>
<div id="category-products-container">
    <?php
        foreach ($products as $product) {
            $image_link = $product['image_link'];
            $name = $product['product_name'];
            $price = $product['price'];
            $sale_price = 1.2 * (int)$price;
            $purchases = $product['purchases'];
            echo "
                 <div class='category-product-card'>
                    <div class='product-image' style='background-image: url($image_link)'></div>
                    <div class='product-contents'>
                        <p class='fw-bold fs-5 category-product-name'>$name</p>
                        <div class='product-price-and-sold d-flex justify-content-between align-items-center mb-2'>
                            <div>
                                <p class='m-0'><span class='money'>$price</span> vnd</p>
                                <p class='text-decoration-line-through m-0 fst-italic'><span class='money'>$sale_price</span> vnd</p>
                            </div>
                            <p class='text-end'>Sold: $purchases</p>
                        </div>
                        <div class='product-add-cart-and-order d-flex justify-content-between align-items-center w-100'>
                            <button>Add to cart</button>
                            <button>Order</button>
                        </div>
                    </div>
                </div>
            ";
        }
    ?>
</div>
<form class="mt-2 mb-3 d-flex justify-content-center">
    <input class="d-none" name="pageNo" id="category-products-page-number" value="2">
    <input class="d-none" name="pageSize" value="6">
    <button id="category-products-see-more" name="category" value="<?php echo $category ?>" type="button">See more</button>
</form>
<script type="module" src="js/product.js"></script>
