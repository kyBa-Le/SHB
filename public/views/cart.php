<?php
    if (!$authentication) {
        header('Location: /login');
    }
?>

<link rel="stylesheet" href="css/cart.css">
<div class="cart-container">
    <div class="cart-items-column">
        <div class="items-header element-white items-table shadow-sm">
            <label for="choose-all">
                <input class="ms-3 me-3" type="checkbox" id="choose-all" name="choose-all">
                Product
            </label>
            <p>Unit price</p>
            <p>Quantity</p>
            <p>Total</p>
            <i class="fa-regular fa-trash-can" id="remove-all"></i>
        </div>
        <div id="cart-items-body" class="items-body element-white shadow-sm">

        </div>
    </div>
    <div class="total-price-column element-white shadow-sm">
        <div class="mt-2 ms-3 me-3 row align-items-center total-price-header border-bottom rounded">
            <p class="col-7">Provisional</p>
            <p class="col-5">Price</p>
        </div>
        <div class="ms-3 me-3 mt-2 row">
            <p class="col-7">Total</p>
            <p class="col-5" id="total-price-purchase" style="color: #FF0000">0 VND</p>
        </div>
        <div class="mt-5 mb-2 w-100 d-flex justify-content-center align-items-center">
            <button class="w-75 p-2" style="color: white; background: black" id="quantity-purchase">Purchases (0)</button>
        </div>
    </div>
</div>
<div class="container-track-order">
    <div class="container-track-order-content" style="font-size: 18px;">
        <div class="btn-order">
            <button id="btn-order-delivered" class="btn-order-paid" style="background-color:#0F0E0E;color:white;">Delivered Order</button>
            <button id="btn-order-shipping" class="btn-order-shipping" style="background-color:white;">Order Shipping</button>
        </div>
        <div class="order-infor">
            <!-- Order paid -->
            <div class="order-infor-content" id="order-delivered-infor-content">
                <div class="product-infor-content">
                    <p class="noOfOrder">Order 1</p>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Logo backprint t-shirt in dark brown</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x1</span>
                        <span class="produc-total-prie">Total price: 300.000đ</span>
                        <button class="review-product">Review</button>
                    </div>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Bomber co-ord in blacks</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x2</span>
                        <span class="produc-total-prie">Total price: 600.000đ</span>
                        <button class="review-product">View review</button>
                    </div>
                    <hr>
                    <p class="produc-total-order" style="font-weight:bold; text-align:end;">Total price: 900.000đ</p>
                </div>
                <div class="product-infor-content">
                    <p class="noOfOrder">Order 2</p>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Down puffer long line jacket in burgundy</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x1</span>
                        <span class="produc-total-prie">Total price: 300.000đ</span>
                        <button class="review-product">Review</button>
                    </div>
                    <hr>
                    <p class="produc-total-order" style="font-weight:bold; text-align:end;">Total price: 300.000đ</p>
                </div>
            </div>
            <!-- Order shipping -->
            <div class="order-infor-content" id="order-shipping-infor-content" style="display:none;">
                <div class="product-infor-content">
                    <p class="noOfOrder">Order 1</p>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Knitted semi sheer long sleeve top in dark grey</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x1</span>
                        <span class="produc-total-prie">Total price: 300.000đ</span>
                    </div>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Western suede look jacket in brown</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x2</span>
                        <span class="produc-total-prie">Total price: 600.000đ</span>
                    </div>
                    <hr>
                    <p class="produc-total-order" style="font-weight:bold; text-align:end;">Total price: 900.000đ</p>
                </div>
                <div class="product-infor-content">
                    <p class="noOfOrder">Order 2</p>
                    <div class="product-item-infor">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">Knitted semi sheer long sleeve top in dark grey</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">Dark</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">L</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x1</span>
                        <span class="produc-total-prie">Total price: 300.000đ</span>
                    </div>
                    <hr>
                    <p class="produc-total-order" style="font-weight:bold; text-align:end;">Total price: 300.000đ</p>
                </div>
            </div>
            <!-- End order shipping -->
        </div>
    </div>
</div>
<script type="module" src="js/cart.js"></script>