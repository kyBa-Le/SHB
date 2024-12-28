<?php
    $selectValue = ['500000' => 'Under 500.000 đ', '1000000' => 'Under 1.000.000 đ', '1001000' => 'Over 1.000.000 đ'];
?>
<link rel="stylesheet" href="css/search.css">
<div class="searchProduct-container">
    <div class="search-text-result d-flex justify-content-center align-items-center flex-column mt-5">
        <?php
            if (isset($_GET['product-name']) && empty($_GET['product-name'])) {
                echo "<p>This is all of our products</p>";
            } else {
                ?>
                    <p>Your search results for:</p>
                    <p><b>"<?php echo $_GET['product-name'] ?>"</b></p>
                    <p><?php echo count($products) ?> products found</p>
                <?php
            }
        ?>
    </div>
    <form id="form-filter-product" action="/product/filter" method="get" class="d-flex justify-content-center">
        <input type="search" id="product-name-filter" name="product-name" style="display: none;" />
        <select id="search-filter-price" name='filter-price' >
            <option disabled selected>
                <?php
                    if (isset($_GET['filter-price'])) {
                        echo $selectValue[$_GET['filter-price']];
                    }else {
                        echo 'Price';
                    }
                ?>
            </option>
            <option value="500000">Under 500.000 đ</option>
            <option value="1000000">Under 1.000.000 đ</option>
            <option value="1001000">Over 1.000.000 đ</option>
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
<script type="module">
    import {moneyFormater} from "../js/components.js";
    let form = document.getElementById('form-filter-product');
    form.addEventListener('submit', function(event){
        event.preventDefault();
        let searchValue = document.getElementById('search-focus').value;
        document.getElementById('product-name-filter').value = searchValue ?? '';
        this.submit();
    });
    let moneyItems = document.getElementsByClassName('money');
    for (let item of moneyItems) {
        item.innerHTML = moneyFormater(item.innerHTML);
    }
</script>