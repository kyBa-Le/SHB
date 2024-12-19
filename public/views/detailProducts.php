<link rel="stylesheet" href="css/detailProducts.css">
<div class="container-detailProducts">
    <div class="product-header">
        <div class="product-image-detail">
            <div id="container-product-detail-image" class="container-product-image">
            </div>
            <div id="sub-product-image" class="sub-product-image">

            </div>
        </div>
        <div class="product-info-detail">
            <h4 class="product-name-detail" id="product-name-detail">Product name</h4>
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
                    <button>S</button>
                    <button>M</button>
                    <button>L</button>
                    <button>XL</button>
                </div>
            </div>
            <hr>
            <div class="quantity-detail">
                    <p>Quantity:</p>
                    <button>-</button>
                    <input type="text" value="1" style="width: 30px; text-align: center; border:none;">
                    <button>+</button>
                </div>
            <div class="button-detail">
                <button class="addToCartBtn-detail">Add to cart</button>
                <button class="orderBtn-detail">Order</button>
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