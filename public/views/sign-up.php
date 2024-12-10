<link rel="stylesheet" href="../css/sign-up.css">
<link rel="stylesheet" href="../js/sign-up.js">
<div class="signup">
    <h1>Sign up</h1>
    <p>Enjoy a more personalised shopping experience with a Jimmy Choo account</p>
    <ul>
        <li>Manage wishlist</li>
        <li>Follow orders & returns</li>
        <li>Exclusive early access to collections and events</li>
        <li>Faster Checkout</li>
    </ul>
    <form action="/signup" method="POST">
        <div class="form-group">
            <input type="text" name="fullname" placeholder="Full name*" required>
        </div>
        <div class="form-group">
            <input type="text" name="username" placeholder="User name*" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email*" required>
        </div>
        <div class="form-group">
            <input type="tel" name="phone" placeholder="Phone number">
        </div>
        <div class="form-group">
            <select name="province" id="province" required>
                <option value="" disabled selected>Province*</option>
            </select>
            <select name="district" id="district" required>
                <option value="" disabled selected>District*</option>
            </select>
            <input type="text" name="address" placeholder="Detail address">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password*" required>
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" placeholder="Confirm password*" required>
        </div>
        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" name="privacy_policy" required>
                Required Field I have read and understood the <a href="#">Privacy Policy</a> regarding the processing of my personal information by Jimmy Choo
            </label>
        </div>
        <div class="form-group checkbox-group">
            <label>
                <input type="checkbox" name="newsletter">
                Yes, I would like to receive Jimmy Choo updates
            </label>
        </div>
        <button type="submit" class="signup-button">SIGN UP</button>
        <p class="footer-note">
            By proceeding, you confirm you have read and understood the Jimmy Choo <a href="#">Privacy Policy</a>
        </p>
    </form>
</div>
