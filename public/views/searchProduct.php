<?php ?>
<link rel="stylesheet" href="css/searchProduct.css">
<div class="searchProduct-container">
    <div class="search-text-result d-flex justify-content-center align-items-center flex-column mt-5">
        <p>Your search results for:</p>
        <p><b>"Swetter"</b></p>
        <p>12 products found</p>
    </div>
    <form id="form-filter-product" action="/product/search" method="get" class="d-flex justify-content-center">
        <select id="search-filter-price">
            <option disabled selected>Price</option>
        </select>
        <select id="search-filter-categories">
            <option disabled selected>Categories</option>
        </select>
        <button type="submit" id="search-filter-button">FILTER</button>
    </form>
    <div class="searchProduct-content">

    </div>
</div>

