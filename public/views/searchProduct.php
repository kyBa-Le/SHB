<?php ?>
<link rel="stylesheet" href="css/searchProduct.css">
<div class="searchProduct-container">
    <div class="search-text-result d-flex justify-content-center align-items-center flex-column mt-5">
        <p>Your search results for:</p>
        <p><b>"<?php echo $_GET['product-name'] ?>"</b></p>
        <p><?php echo count($products) ?> products found</p>
    </div>
    <form id="form-filter-product" action="/product/search" method="get" class="d-flex justify-content-center">
        <select id="search-filter-price" name='min-price' >
            <option disabled selected>Price</option>
            <option value="0">under 500.000 vnd</option>
            <option value="500000">under 1.000.000 vnd</option>
            <option value="10000000">over 1.000.000 vnd</option>
        </select>
        <select id="search-filter-categories">
            <option disabled selected>Categories</option>
        </select>
        <button type="submit" id="search-filter-button">FILTER</button>
    </form>
    <div class="searchProduct-content">
        <?php
            require_once 'views/components/productCards.php' ;
        ?>
    </div>
</div>

