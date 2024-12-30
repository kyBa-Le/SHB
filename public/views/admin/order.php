<link rel="stylesheet" href="css/admin/order.css">

<div class="container-order">
    <div class="order-content">
        <div class="order-title-order-quantity-date">
            <span class="title-quantity-order">
                <span class="order-title" style="font-size:24px; font-weight:bold;">Order</span>
                <span class="order-quantity" id="order-quantity"  style="font-size:20px;"></span>
            </span>
            <button class="order-date-filter-btn"><i class="fa-regular fa-calendar-days"></i>Mar - April, 2024 <i class="fa-solid fa-angle-down"></i></button>
        </div>
        <div class="nav-order mt-4 mb-4">
            <span class="all-orders">All orders</span>
            <span class="delivered">Delivered</span>
            <span class="shipping">Shipping</span>
        </div>
        <!-- Orders content -->
        <div class="products-infor-orders" id="products-infor-orders">
            <!-- Nơi order hiển thị -->
        </div>
    </div>
</div>
<script type="module" src="js/admin/order.js"></script>
