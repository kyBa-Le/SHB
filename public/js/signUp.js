const form = document.getElementById('myForm');
form.addEventListener('submit', function (event) {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    if (confirmInput.value != passwordInput.value) {
        event.preventDefault(); 
        confirmInput.setCustomValidity('Confirm password does not match'); 
        confirmInput.reportValidity(); 
    } else {
        confirmInput.setCustomValidity(''); 
        alert("Successful registration!");
    }
});