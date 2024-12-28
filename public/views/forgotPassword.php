<link rel="stylesheet" href="css/forgotPassword.css">
<div id="container-forgotPassword">
    <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-around flex-column" id="forgotPassword-box" style="background-color: white;">
        <h1 class="text-center">Forgot Password</h1>
        <span style="text-align: center;"><i id="countdown">Please note: Your OTP code is only valid for 60 seconds !!!</i></span>
        
        <!-- Form nhập email -->
        <div id="email-container">
            <form id="form-forgotPassword" class="d-flex flex-column justify-content-between">
                <label class="w-100 forgotPassword-label">
                    <p class="m-0">Email</p>
                    <input type="email" name="email"  id="forgot-password-email" placeholder="Enter your email" required>
                </label>
                <span id="error-isSent" style="color: red;"></span>
                <p>You want to log in ? <a href="/login">Click here</a></p>
                <button type="button" id="forgotPassword-button">Send Code</button>
            </form>
        </div>

        <!-- Form nhập OTP -->
        <div id="otp-container" style="display: none;">
            <form id="form-otp" class="d-flex flex-column justify-content-between">
                <label class="w-100 otp-label">
                    <p class="m-0">OTP Code</p>
                    <input type="text" name="otp" id="otpCode" placeholder="Enter the OTP code" required>
                </label>
                <span id="error-isIncorrectOtp" style="color: red;"></span>
                <p>You want to change email ?<span id="display-email-input"><u style="color:blue; cursor: pointer;"> Click here</u></span></p>
                <button type="button" id="otp-button">Verify</button>
            </form>
        </div>

        <!-- Form nhập mật khẩu mới -->
        <div class="position-absolute top-50 start-50 translate-middle justify-content-around flex-column" id="newPassword-box" style="background-color: white; display: none;">
            <h1 class="text-center">New Password</h1>
            <span style="text-align: center;"><i>Please enter your new password!!!</i></span>
            <div id="newPassword-container">
                <form id="form-newPassword"  action="/user/forgot-password" method="post"  class="d-flex flex-column justify-content-between">
                    <label class="w-100 newPassword-label">
                        <p class="m-0">New password</p>
                        <input type="password" name="newPassword" placeholder="Enter your new password" required minlength="6">
                    </label>
                    <p>You want to log in ? <a href="/login">Click here</a></p>
                    <button type="submit" id="newPassword-button">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="module" src="js/forgotPassword.js"></script>
