import {getData, patchData, sendData, updateData} from "./components.js";

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