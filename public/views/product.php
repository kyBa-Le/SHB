<?php ?>
<link rel="stylesheet" href="css/product.css">
<h1 class="text-center mt-2"><?php echo $category ?>'s fashion</h1>
<div id="category-products-container">
    <?php
        foreach ($products as $product) {
            $image_link = $product['image_link'];
            $name = $product['product_name'];
            $price = $product['price'];
            $purchases = $product['purchases'];
            echo "
                 <div class='category-product-card'>
                    <div class='product-image' style='background-image: url($image_link)'></div>
                    <div class='product-contents'>
                        <p class='fw-bold fs-5 category-product-name'>$name</p>
                        <div class='product-price-and-sold d-flex justify-content-between align-items-center mb-2'>
                            <div>
                                <p class='m-0'><span class='money'>$price</span> vnd</p>
                                <p class='text-decoration-line-through m-0 fst-italic'>400.000 vnd</p>
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
<form class="mt-2 mb-3 d-flex justify-content-center"><button id="category-products-see-more">See more</button></form>
