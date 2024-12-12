import {loadWaiting} from "./components.js";

const form = document.getElementById('myForm');
form.addEventListener('submit', function (event) {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    if (confirmInput.value.trim() != passwordInput.value.trim()) {
        event.preventDefault(); 
        confirmInput.setCustomValidity('Confirm password does not match'); 
        confirmInput.reportValidity(); 
    } else {
        confirmInput.setCustomValidity(''); 
    }
    loadWaiting();
});
// Handle API to show select address
async function getProvince() {
    let response = await fetch('https://provinces.open-api.vn/api/?depth=2');
    let data = await response.json();
    return data;
}
let data = await getProvince();
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
            districtSelect.innerHTML += `<option value="${district.code}">${district.name}</option>`;
        }); 
    }
}

