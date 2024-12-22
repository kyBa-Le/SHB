<?php
    if (!$authentication) {
        header('Location: /login');
    }
?>

<link rel="stylesheet" href="css/cart.css">
<div class="cart-container">
    <div class="cart-items-column">
        <div class="items-header element-white items-table">
            <label for="choose-all">
                <input class="ms-3 me-3" type="checkbox" id="choose-all" name="choose-all">
                Product
            </label>
            <p>Unit price</p>
            <p>Quantity</p>
            <p>Total</p>
            <i class="fa-regular fa-trash-can"></i>
        </div>
        <div id="cart-items-body" class="items-body element-white">

        </div>
    </div>
    <div class="total-price-column element-white">
        <div class="mt-2 ms-3 me-3 row align-items-center total-price-header border-bottom rounded">
            <p class="col-9">Provisional</p>
            <p class="col-3">Price</p>
        </div>
        <div class="ms-3 me-3 mt-2 row">
            <p class="col-9">Total</p>
            <p class="col-3" style="color: #FF0000">Price</p>
        </div>
        <div class="mt-5 mb-2 w-100 d-flex justify-content-center align-items-center">
            <button class="w-75 p-2" style="color: white; background: black" onclick="{document.getElementById('search-focus').focus()}">Search products</button>
        </div>
    </div>
</div>
<script type="module" src="js/cart.js"></script>