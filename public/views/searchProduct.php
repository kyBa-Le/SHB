<link rel="stylesheet" href="css/searchProduct.css">
<div class="searchProduct-container">
    <div class="search-text-result d-flex justify-content-center align-items-center flex-column mt-5">
        <p>Your search results for:</p>
        <p><b>"<?php echo $_GET['product-name'] ?>"</b></p>
        <p><?php echo count($products) ?> products found</p>
    </div>
    <form id="form-filter-product" action="/product/filter" method="get" class="d-flex justify-content-center">
        <input type="search" id="product-name-filter" name="product-name" style="display: none;" />
        <select id="search-filter-price" name='filter-price' >
            <option disabled selected>
                <?php
                    if (isset($_GET['filter-price'])) {
                        echo $_GET['filter-price'];
                    }else {
                        echo 'Price';
                    }
                ?>
            </option>
            <option value="500000">under 500.000 vnd</option>
            <option value="1000000">under 1.000.000 vnd</option>
            <option value="1001000">over 1.000.000 vnd</option>
        </select>
        <select id="search-filter-categories" name='filter-categories'>
            <option disabled selected>
                <?php
                if (isset($_GET['filter-categories'])) {
                    echo $_GET['filter-categories'];
                }else {
                    echo 'Categories';
                }
                ?>
            </option>
            <option value="MEN">MEN</option>
            <option value="WOMEN">WOMEN</option>
            <option value="CHILDREN">CHILDREN</option>
        </select>
        <button type="submit" id="search-filter-button">FILTER</button>
    </form>
    <div class="searchProduct-content">
        <?php
        require_once 'views/components/productCards.php' ;
        ?>
    </div>
</div>
<script>
    let form = document.getElementById('form-filter-product');
    form.addEventListener('submit', function(event){
        event.preventDefault();
        let searchValue = document.getElementById('search-focus').value;
        document.getElementById('product-name-filter').value = searchValue ?? '';
        this.submit();
    });
</script>