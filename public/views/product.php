<?php ?>
<link rel="stylesheet" href="css/product.css">
<h1 class="text-center mt-5"><?php echo $category ?>'s fashion</h1>
<div id="category-products-container">
    <?php require_once 'views/components/productCards.php'?>
</div>
<form class="mt-2 mb-3 d-flex justify-content-center">
    <input class="d-none" name="pageNo" id="category-products-page-number" value="2">
    <input class="d-none" name="pageSize" value="6">
    <button id="category-products-see-more" name="category" value="<?php echo $category ?>" type="button">See more</button>
</form>
<script type="module" src="js/product.js"></script>
