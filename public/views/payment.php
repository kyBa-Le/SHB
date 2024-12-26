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
      <label><input type="radio" name="payment" value="cod" checked> COD</label>
      <label><input type="radio" name="payment" value="momo"> Momo</label>
      <form>
        <input type="text" placeholder="Full Name" value="<?php echo $data['fullName'] ?? '' ?>">
        <input type="text" placeholder="Phone Number" minlength="10" maxlength="10" required value="<?php echo $data['phone'] ?? '' ?>">
        <div class="form-group form-group-select">
            <select name="province" id="province">
                <option value="<?php echo $data['province'] ?? '' ?>"><?php echo $data['province'] ?? '' ?></option>
            </select>
            <select name="district" id="district">
                <option value="<?php echo $data['district'] ?? '' ?>"><?php echo $data['district'] ?? '' ?></option>
            </select>
            <input type="text" name="detailed_address" placeholder="Detail address">
        </div>
        <input type="text" placeholder="Note">
        <div>
          <h3>Order Summary</h3>
          <p>Order Total: <span class="money"><?php echo $totalPrice ?>₫</span></p>
        </div>
        <button class="btn-buy">Order</button>
      </form>
    </div>
  </div>
  <div class="order-summary-container">
    <h4>Product</h4>
    <div class="order-summary">
        <?php
            if ($isArray === false) {
                $imageLink = $orderItems['productImageLink'];
                $price = (int) $orderItems['unitPrice'];
                $quantity = (int) $orderItems['quantity'];
                $name = $orderItems['productName'];
                $color = $orderItems['productColor'];
                $total = $quantity * $price;
                echo "<div class='item'>
                        <img src='$imageLink' alt='Product'>
                        <div class='details'>
                            <span class='money'>$price đ</span>
                            <p>$name</p>
                            <p>$color / M</p>
                            <p>x $quantity</p> 
                        </div>
                        <p>Total: <span> $total  đ</span></p>
                    </div>";    
            } else {
                foreach ($orderItems as $value) {
                    $imageLink = $value['productImageLink'];
                    $price = (int) $value['unitPrice'];
                    $quantity = (int) $value['quantity'];
                    $name = $value['productName'];
                    $color = $value['productColor'];
                    $total = $quantity * $price;
                    echo "<div class='item'>
                            <img src='$imageLink' alt='Product'>
                            <div class='details'>
                                <span class='money'>$price đ</span>
                                <p>$name</p>
                                <p>$color / M</p>
                                <p>x $quantity</p> 
                            </div>
                            <p>Total: <span> $total  đ</span></p>
                        </div>";    
                }
            }
        ?>
    </div>
  </div>
</div>
<script src="js/payment.js" type="module"></script>