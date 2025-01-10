import {patchData, sendData} from "./components.js";

// Lấy các phần tử DOM
let forgotPasswordBtn = document.getElementById('forgotPassword-button');
let emailContainer = document.getElementById('email-container');
let otpContainer = document.getElementById('otp-container');
let emailPageClick = document.getElementById('display-email-input');
let otpBtn = document.getElementById('otp-button');
let forgotPasswordBox = document.getElementById('forgotPassword-box');
let newPasswordBox = document.getElementById('newPassword-box');
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
        let response = await sendData('/api/forgot-password', {email: emailValue});
        if (response['isSent'] == false) {
            emailContainer.style.display = 'block';
            otpContainer.style.display = 'none';
            document.getElementById('error-isSent').innerHTML += `<p style="color: red;">${response['error']}</p>`;
        } else {
            emailContainer.style.display = 'none';
            otpContainer.style.display = 'block';
            countDown();
        }
    }
});

// xử lý nút ẩn hiện khi bấm click here ở trang OTP
emailPageClick.addEventListener('click', function () {
    let error = document.getElementById("error-incorrectOtp");
    if (error !== null) {
        error.remove();
    }
    emailContainer.style.display = 'block';
    otpContainer.style.display = 'none';
});

// Xử lý dữ liệu và ẩn hiện form khi nhấn nút xác nhận mã OTP
otpBtn.addEventListener('click', async function () {
    let error = document.getElementById("error-incorrectOtp");
    if (error !== null) {
        error.remove();
    }
    let otpInput = document.getElementById('otpCode').value; 
    let response = await sendData('/api/forgot-password/otp', {otp: otpInput});
    if (response['isCorrectOtp'] == true) {
        newPasswordBox.style.display = 'flex';
        forgotPasswordBox.style.display = 'none';
    } else {
        document.getElementById('error-isIncorrectOtp').innerHTML += `<p id="error-incorrectOtp" style="color: red;">${response['error']}</p>`;
    }
});

function countDown() {
    let countdownValue = 60;
    const countdownElement = document.getElementById('countdown');
    const countdown = setInterval(() => {
        countdownValue--;
        countdownElement.innerHTML = `Your OTP code will be expired after <i class='fw-bold' style="color: red">${countdownValue}</i> seconds !!!`;
        if (countdownValue <= 0) {
            clearInterval(countdown);
            countdownElement.textContent = `Your OTP code is expired !!!`
        }
    }, 1000);
}