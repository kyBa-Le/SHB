<?php 
    if(!$authentication) {
        header('Location: /login');
        exit;
    }
    $data = $_SESSION['user'];  
?>
<link rel="stylesheet" href="css/payment.css">

<div class="wrapper">
  <div class="payment-method-container">
    <div class="payment-method">
      <h4>Payment Method</h4>
      <label><input type="radio" name="payment" value="COD" checked class="payment-check"> COD</label>
      <label><input type="radio" name="payment" value="Momo" class="payment-check"> Momo</label>
      <form>
        <input id="full-name" type="text" placeholder="Full Name"  required value="<?php echo $data['fullName'] ?? '' ?>">
        <input id="phone-number" type="text" placeholder="Phone Number" minlength="10" maxlength="10" required value="<?php echo $data['phone'] ?? '' ?>">
        <div class="form-group form-group-select">
            <select name="province" id="province" required>
                <option disabled value="<?php echo $data['province'] ?? '' ?>"><?php echo $data['province'] ?? '' ?></option>
            </select>
            <select name="district" id="district" required>
                <option disabled value="<?php echo $data['district'] ?? '' ?>"><?php echo $data['district'] ?? '' ?></option>
            </select>
            <input type="text" name="detailed_address" placeholder="Detail address" id="detailed-address"  required>
        </div>
        <input type="text" placeholder="Note" id="description">
        <div>
          <h3>Order Summary</h3>
          <p>Order Total: <span class="money" data-value="<?php echo $totalPrice ?>" id="total-price"><?php echo $totalPrice ?>₫</span></p>
        </div>
        <button type="button" class="btn-buy" id="order-btn">Order</button>
      </form>
    </div>
  </div>
  <div class="order-summary-container">
    <h4>Product</h4>
    <div class="order-summary">
        <?php
        
        if (is_array($orderItems) && !empty($orderItems)) {
            // Kiểm tra nếu $orderItems là một mảng
            // Nếu phần tử đầu tiên là một mảng associative
            if (isset($orderItems[0]) && is_array($orderItems[0]) && array_keys($orderItems[0]) !== range(0, count($orderItems[0]) - 1)) {
                // Nếu phần tử đầu tiên là mảng associative
                // Điều này nghĩa là $orderItems là một mảng chứa các mảng associative
                foreach ($orderItems as $value) {
                    $imageLink = $value['product_image_link'];
                    $price = (int) $value['unit_price'];
                    $quantity = (int) $value['quantity'];
                    $name = $value['product_name'];
                    $color = $value['product_color'];
                    $total = $quantity * $price;
                    echo "<div class='item' data-isNew='false'>
                            <img src='$imageLink' alt='Product'>
                            <div class='details'>
                                <span class='money'>$price đ</span>
                                <p>$name</p>
                                <p>$color / M</p>
                                <p>x $quantity</p> 
                            </div>
                            <p>Total: <span> $total đ</span></p>
                        </div>";
                }
            } else {
                // Nếu $orderItems chỉ là một mảng associative (không phải mảng của các mảng)
                $imageLink = $orderItems['product_image_link'];
                $price = (int) $orderItems['unit_price'];
                $quantity = (int) $orderItems['quantity'];
                $name = $orderItems['product_name'];
                $color = $orderItems['product_color'];
                $total = $quantity * $price;
                $size = $orderItems['size'];
                $product_id = $orderItems['product_id'];
                echo "<div class='item' data-isNew='true' data-product-name=$name data-quantit=$quantity, data-unit-price=$price, data-size=$size, data-product-id=$product_id, data-image-link=$imageLink, data-product-color=$color>
                        <img src='$imageLink' alt='Product'>
                        <div class='details'>
                            <span class='money'>$price đ</span>
                            <p>$name</p>
                            <p>$color / $size</p>
                            <p>x $quantity</p> 
                        </div>
                        <p>Total: <span> $total đ</span></p>
                    </div>";
            }
        } else {
            echo "Không có dữ liệu sản phẩm.";
        }
        ?>
    </div>
  </div>
</div>
<script src="js/payment.js" type="module"></script>