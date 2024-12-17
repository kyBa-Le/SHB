import {sendData} from "./components.js";

// Lấy các phần tử DOM
let forgotPasswordBtn = document.getElementById('forgotPassword-button');
let emailContainer = document.getElementById('email-container');
let otpContainer = document.getElementById('otp-container');

// Xử lý sự kiện khi nhấn nút Send Code
forgotPasswordBtn.addEventListener('click', async function (event) {
    event.preventDefault();
    let emailInput = document.getElementById('forgot-password-email'); 
    let emailValue = emailInput.value; 
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailValue || !emailRegex.test(emailValue)) {
        emailInput.setCustomValidity('Please enter a valid email address.'); 
        emailInput.reportValidity();
        return;
    } else {
        let response = await sendData('/api/user/forgot-password', {email: emailValue}); 
        if (response['isSent'] == false) {
            emailContainer.style.display = 'block';
            otpContainer.style.display = 'none';
            document.getElementById('error-isSent').innerHTML += `<p style="color: red;">${response['error']}</p>`;
        } else {
            emailContainer.style.display = 'none';
            otpContainer.style.display = 'block';
        }
    }
});