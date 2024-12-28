<link rel="stylesheet" href="css/detailProducts.css">
<span id="product-details-data" class="d-none" data-color="" data-image-link="" data-size="S"></span>
<div class="container-detailProducts">
    <div class="product-header">
        <div class="product-image-detail">
            <div id="container-product-detail-image" class="container-product-image">
            </div>
            <div id="sub-product-image" class="sub-product-image">

            </div>
        </div>
        <div class="product-info-detail">
            <h4 class="product-name-detail" id="product-name-detail"></h4>
            <p>Available: <span id="product-detail-quantity" style="color: green;"></span></p>
            <p class="mb-0">
                <span class="price-detail" id="product-detail-price"></span>
            </p>
            <hr>
            <div class="color-selection-detail">
                <p>Colors:</p>
                <div id="button-color-detail" class="button-color-detail">
                </div>
            </div>
            <div class="size-selection-detail">
                <p class="mt-3">Size:</p>
                <div class="button-size-detail">
                    <button class="size-btn" data-size="S">S</button>
                    <button class="size-btn" data-size="M">M</button>
                    <button class="size-btn" data-size="L">L</button>
                    <button class="size-btn" data-size="XL">XL</button>
                </div>
            </div>
            <hr>
            <div class="quantity-detail">
                    <p>Quantity:</p>
                    <button id="minusBtn">-</button>
                    <input type="text" id="quantity-buy" value="1" style="width: 30px; text-align: center; border:none;">
                    <button id="plusBtn">+</button>
                    <span id="quantity-error" style="color: red; margin-left: 5px;"></span>
            </div>
            <span id="addToCartMessage"></span>
            <div class="button-detail" id="button-place">
                <button id="addToCartBtn" class="addToCartBtn-detail">Add to cart</button>
                <button class="orderBtn-detail" id="orderBtn">Order</button>
            </div>
        </div>
    </div>
    <div class="product-description-details">
        <h4>Product details</h4>
        <ul id="product-detail-description">Highlighted features of oversized unisex T-shirts.
        </ul>
    </div>
    <div class="product-reviews-detail">
        <h4>Product reviews</h4>
        <div class="review-detail">
            <img src="https://via.placeholder.com/40" alt="User">
            <div class="review-content-detail">
                <h5>Username</h5>
                <p>Chất lượng quá tuyệt vời! Áo rất đẹp và mình sẽ ủng hộ thêm nhiều lần nữa.</p>
            </div>
        </div>
    </div>
<script src="js/detailedProduct.js" type="module"></script>