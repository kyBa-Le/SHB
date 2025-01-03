<link rel="stylesheet" href="css/admin/order.css">

<div class="container-order">
    <div class="order-content">
        <div class="order-title-order-quantity-date">
            <span class="title-quantity-order">
                <span class="order-title" style="font-size:24px; font-weight:bold;">Order</span>
                <span class="order-quantity" id="order-quantity"  style="font-size:20px;"></span>
            </span>
            <div class="filter-by-date">
                <button id="order-date-filter-btn" class="order-date-filter-btn"><i class="fa-regular fa-calendar-days"></i> Fitler orders by date <i id="down-icon-date-filter-order" class="fa-solid fa-angle-down"></i><i id="up-icon-date-filter-order" class="fa-solid fa-angle-up d-none"></i></button>
                <div id="box-filter-order" class="box-filter-order d-none">
                    <div class="box-filter-content-order">
                       <span class="mb-3" style="font-weight:bold;">Select the date you want to view orders</span>
                        <span id="date-filter"><input type="date" id="date-input" required></span>
                    </div>
                    <div class="filter-order-button">
                        <button id="cancel-filter-btn" class="cancel-btn">Cancel filter</button>
                        <button id="filter-order-btn" class="filter-order-btn">Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-order mt-4 mb-4">
            <span class="all-orders" id="all-orders">All orders</span>
            <span class="delivered" id="delivered">Delivered</span>
            <span class="shipping" id="shipping">Shipping</span>
        </div>
        <!-- Orders content -->
        <div class="products-infor-orders" id="products-infor-orders">
            <!-- Nơi order hiển thị -->
        </div>
    </div>
</div>
<script type="module" src="js/admin/order.js"></script>
