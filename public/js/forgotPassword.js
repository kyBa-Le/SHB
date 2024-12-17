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
    if (!emailValue) {
        emailInput.setCustomValidity('Please enter a valid email address.'); 
        emailInput.reportValidity();
        return;
    } else {
        let isSent = await sendData('/api/user/forgot-password', {email: emailValue}); 
        console.log(isSent);
        emailContainer.style.display = 'none';
        otpContainer.style.display = 'block';
    }
});