<?php
    if (!$authentication) {
        header('location:/login');
    }
?>
<link rel="stylesheet" href="css/review.css">
<div id="review-container" class="d-flex justify-content-center align-items-center">

    <form enctype="multipart/form-data" id="review-form" class="element-white d-flex justify-content-center align-items-center flex-column">
        <h1 class="fw-bold">We appreciate your feedback</h1>
        <p class="w-75 text-center">We always looking for ways to improve your experience.
            Please take a moment to evaluate and tell us what do you think. </p>
        <hr class="w-100">
        <div class="w-100">
            <p class="fw-bold">Product name: <?php echo $orderItem['product_name'] ?></p>
            <p class="fw-bold">Color: <?php echo $orderItem['product_color'] ?></p>
            <p class="fw-bold">Size: <?php echo $orderItem['size'] ?></p>
        </div>
        <input type="hidden" name="order_items_id" value="<?php echo $orderItem['id'] ?>" id="order-id">
        <input type="hidden" name="user_id" value="<?php echo $orderItem['user_id'] ?>" id="user-id">
        <hr class="w-100">
        <br><br>
        <label for="content" style="color: #777070">How do you feel about our service</label><br>
        <textarea id="content" name="content" rows="5" class="w-100 rounded-3" placeholder="Please enter your feedback here..." required></textarea>
        <br><br>
        <!-- Input for image upload -->
        <div class="w-100">
            <div class="w-100">
                <label for="images" class="upload-button">Upload Images</label>
                <input type="file" id="images" name="images" accept="image/*" class="d-none">
            </div>
            <div id="images-preview">
            </div>
        </div>
        <div style="height: 2vh"></div>
        <button type="submit" id="btn-submit-review">Submit Review</button>
    </form>
</div>
<script src='js/review.js' type='module'></script>