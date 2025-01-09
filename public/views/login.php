<?php ?>
<link rel="stylesheet" href="css/login.css">
<div id="container-login">
    <div class="position-absolute top-50 start-50 translate-middle d-flex justify-content-around flex-column" id="login-box">
        <h1 class="text-center">Login to your account</h1>
        <form id="form-login" action="/login" method="post" class="d-flex flex-column justify-content-between">
            <label class="w-100 login-label">
                <p class="m-0">Email</p>
                <input type="email" name="email" placeholder="Enter your email" value="<?php echo $data['email'] ?? '' ?>" required>
            </label>
            <label class="w-100 login-label">
                <p class="m-0">Password</p>
                <input type="password" name="password" placeholder="Enter your password" value="<?php echo $data['password'] ?? '' ?>" required>
            </label>
            <?php
                if (isset($isLoggedIn) && $isLoggedIn == false) {
                    echo "<span class='text-center' style='color:red;'>Email or password is incorrect</span>";
                }
            ?>
            <a class="text-end login-link" href="/forgot-password">Forgot password?</a>
            <button id="login-button">LOGIN</button>
        </form>
        <p class="text-center">Don't have an account? <a class="login-link" href="/sign-up">Create new account</a></p>
    </div>
</div>
