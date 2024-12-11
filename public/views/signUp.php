<link rel="stylesheet" href="css/signUp.css">
<div class="signup">
    <h1>Sign up</h1>
    <p>Enjoy a more personalised shopping experience with a SHB Store account</p>
    <ul>
        <li>Manage wishlist</li>
        <li>Follow orders & returns</li>
        <li>Exclusive early access to collections and events</li>
        <li>Faster Checkout</li>
    </ul>
    <form id="myForm" action="/sign-up" method="POST">
        <div class="form-group">
            <input type="text" name="fullName" placeholder="Full name*" required value="<?php echo $data['fullName'] ?? '' ?>">
        </div>
        <div class="form-group">
            <input type="text" name="username" placeholder="User name*" required value="<?php echo $data['username'] ?? '' ?>">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email*" required value="<?php echo $data['email'] ?? '' ?>">
            <?php
                if(isset($isValid) && $isValid === false && isset($errors['email'])) {
                    echo ("<span class='error-message'>" . $errors['email'] . "</span>");
                }
            ?>
        </div>
        <div class="form-group">
            <input type="text" name="phone" placeholder="Phone number" minlength="10" maxlength="10" value="<?php echo $data['phone'] ?? '' ?>">
            <?php
            if(isset($isValid) && $isValid === false && isset($errors['phone'])) {
                echo ("<span class='error-message'>" . $errors['phone'] . "</span>");
            }
            ?>
        </div>
        <div class="form-group">
            <select name="province" id="province">
                <option value="" disabled selected>Province</option>
            </select>
            <select name="district" id="district">
                <option value="" disabled selected>District</option>
            </select>
            <input type="text" name="detailed_address" placeholder="Detail address">
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password*" required minlength="6">
        </div>
        <div class="form-group">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password*" required minlength="6">
        </div>
        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" name="privacy_policy" required>
                Required Field I have read and understood the <a href="#">Privacy Policy</a> regarding the processing of my personal information by SHB Store
            </label>
        </div>
        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" name="newsletter">
                Yes, I would like to receive SHB Store updates
            </label>
        </div>
        <button type="submit" class="signup-button" id="sign-up-button">SIGN UP</button>
        <p class="footer-note">
            By proceeding, you confirm you have read and understood the SHB Store <a href="#">Privacy Policy</a>
        </p>
    </form>
</div>
<script src="js/signUp.js"></script>
