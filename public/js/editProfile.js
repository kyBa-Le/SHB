import { getData } from "./components.js";

let editButton = document.getElementById('edit-profile-button');
let submitButton = document.getElementById('edit-profile-submit');
let inputElements = document.getElementsByClassName('edit-profile-input');
let changePassword = document.getElementById('click-change-password');
let containerEditProfile = document.querySelector('.container-edit-profile');
let changeImageBtn = document.getElementById("change-image-button");
let imageUpload = document.getElementById("image-upload");
let profileImage = document.getElementById("profile-image");
let submitImageButton = document.getElementById('submit-image-button');
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
    containerEditProfile.style.display = 'none';

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
