import { getData, sendData } from "./components.js";

let editButton = document.getElementById('edit-profile-button');
let submitButton = document.getElementById('edit-profile-submit');
let inputElements = document.getElementsByClassName('edit-profile-input');
let changePassword = document.getElementById('click-change-password');
let containerEditProfileContent = document.querySelector('.container-edit-profile-content');
let changeImageBtn = document.getElementById("change-image-button");
let imageUpload = document.getElementById("image-upload");
let profileImage = document.getElementById("profile-image");
let submitImageButton = document.getElementById('submit-image-button');
let containerEditPassword = document.getElementById('container-edit-password');
let clickChangePersonalInfor = document.getElementById('click-change-personalInfor');
let clickSaveNewPassword = document.getElementById('edit-password-input');
editButton.addEventListener('click', async function(){
    submitButton.style.display = 'inline-block';
    changeImageBtn.style.display = 'inline-block';
    editButton.style.display = 'none';
    for (let i = 0; i < inputElements.length; i++){
        let input = inputElements[i];
        input.readOnly = false;
    }
    let data = await getData('https://provinces.open-api.vn/api/?depth=2');
    let provinceSelect = document.getElementById('province');
    let districtSelect = document.getElementById('district');
    for (let i = 0; i <data.length; i++) {
        let address = data[i];
        provinceSelect.innerHTML += `<option value="${address.name}">${address.name}</option>`;
    }
    provinceSelect.addEventListener('change', function () {
            let selectedProvince = data.find(p => p.name == provinceSelect.value);
            renderDistrict(selectedProvince);
    });
    function renderDistrict(province) {
        if (province && province.districts) {
            districtSelect.innerHTML = '';
            province.districts.forEach((district) => {
                districtSelect.innerHTML += `<option value="${district.name}">${district.name}</option>`;
            }); 
        }
    }

})

changePassword.addEventListener('click', function(){ 
    containerEditProfileContent.style.display = 'none';
    containerEditPassword.style.display = 'block';
});

changeImageBtn.addEventListener("click", function () {
    imageUpload.click(); 
    changeImageBtn.style.display = 'none';
    submitImageButton.style.display = 'inline-block';
});

imageUpload.addEventListener("change", function () {
    const file = imageUpload.files[0]; 
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profileImage.src = e.target.result; 
        };
        reader.readAsDataURL(file);
    }
});

clickChangePersonalInfor.addEventListener('click', function(){ 
    containerEditProfileContent.style.display = 'block';
    containerEditPassword.style.display = 'none';
});

// confirm password before update new password
const form = document.getElementById('change-new-password-form');
clickSaveNewPassword.addEventListener('click', async function () {
    let currentPasswordError = document.getElementById('current-password-error');
    if(currentPasswordError != null) {
        currentPasswordError.remove();
    }
    const passwordInput = document.getElementById('newPassword');
    const confirmInput = document.getElementById('confirmNewPassword');
    const currentPasswordInput = document.getElementById('currentPassword');
    let data = {newPassword : passwordInput.value, confirmNewPassword: confirmInput.value, currentPassword: currentPasswordInput.value};
    let inputs = document.getElementsByClassName('edit-password-input');
    console.log('input is:' + inputs);
    for (let i = 0; i < inputs.length; i++ ) {
        if (inputs[i].value.length < 6) {
            inputs[i].setCustomValidity('Password must be at least 6 characters!'); 
            inputs[i].reportValidity(); 
        }
    }
    if (confirmInput.value.trim() != passwordInput.value.trim()) {
        confirmInput.setCustomValidity('Confirm password does not match'); 
        confirmInput.reportValidity(); 
    } else {
        confirmInput.setCustomValidity('');
        let response = await sendData('/api/user/edit/password', data);
        console.log(response);
        if (response['isUpdate'] == false) {
            document.getElementById('current-password-group').innerHTML += `<span style='color: red' id='current-password-error'> ${response['error']} </span>`
        } else {
            window.location.href = '/user/edit';
        }
    }
});

