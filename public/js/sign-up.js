function validateForm(event) {
    event.preventDefault();
    const fullName = document.querySelector('input[name="fullname"]');
    const userName = document.querySelector('input[name="username"]');
    const email = document.querySelector('input[name="email"]');
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="confirm_password"]');
    const province = document.querySelector('select[name="province"]');
    const district = document.querySelector('select[name="district"]');
    const privacyPolicy = document.querySelector('input[name="privacy_policy"]');
    if (!fullName.value.trim()) {
        alert("Please enter your full name.");
        fullName.focus();
        return;
    }
    if (!userName.value.trim()) {
        alert("Please enter your user name.");
        userName.focus();
        return;
    }
    if (!email.value.trim()) {
        alert("Please enter a valid email address.");
        email.focus();
        return;
    }
    if (!province.value) {
        alert("Please select your province.");
        province.focus();
        return;
    }
    if (!district.value) {
        alert("Please select your district.");
        district.focus();
        return;
    }
    if (!password.value.trim()) {
        alert("Please enter a password.");
        password.focus();
        return;
    }
    if (password.value !== confirmPassword.value) {
        alert("Passwords do not match.");
        confirmPassword.focus();
        return;
    }
    if (!privacyPolicy.checked) {
        alert("You must agree to the Privacy Policy.");
        return;
    }
    alert("Form submitted successfully!");
    event.target.submit();
}