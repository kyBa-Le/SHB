<link rel="stylesheet" href="css/forgotPassword.css">
<div id="container-forgotPassword">
    <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-around flex-column" id="forgotPassword-box" style="background-color: white;">
        <h1 class="text-center">Forgot Password</h1>
        <span style="text-align: center;"><i>Please note: Your OTP code is only valid for 60 seconds !!!</i></span>
        
        <!-- Form nhập email -->
        <div id="email-container">
            <form id="form-forgotPassword" class="d-flex flex-column justify-content-between">
                <label class="w-100 forgotPassword-label">
                    <p class="m-0">Email</p>
                    <input type="email" name="email"  id="forgot-password-email" placeholder="Enter your email" required>
                </label>
                <p>You want to log in ? <a href="/login">Click here</a></p>
                <button type="button" id="forgotPassword-button">Send Code</button>
            </form>
        </div>

        <!-- Form nhập OTP -->
        <div id="otp-container" style="display: none;">
            <form id="form-otp"  action="/user/forgot-password" method="post"  class="d-flex flex-column justify-content-between">
                <label class="w-100 otp-label">
                    <p class="m-0">OTP Code</p>
                    <input type="text" name="otp" placeholder="Enter the OTP code" required>
                </label>
                <p>You want to change email ?<span><u style="color:blue; cursor: pointer;"> Click here</u></span></p>
                <button type="submit" id="otp-button">Verify</button>
            </form>
        </div>
    </div>
</div>
<script type="module" src="js/forgotPassword.js"></script>
