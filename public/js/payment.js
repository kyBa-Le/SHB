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

// xử lý khi ấn nút mua hàng
document.getElementById('order-btn').addEventListener('click',async function() {
    let method = this.querySelector('.payment-check:checked').value;
    let fullName = document.getElementById('full-name').value;
    let phone = document.getElementById('phone-number').value;
    let province = document.getElementById('province').value;
    let district = document.getElementById('district').value;
    let description = document.getElementById('description').value;
    let totalPrice = document.getElementById('total-price').dataset.value;
    let detailedAddress = document.getElementById('detailed-address').value;
    let data = {total_cost: totalPrice, description:description, method:method, province:province, district:district, detailed_address:detailedAddress};
    if (method === 'Momo') {

    } else if(method === 'COD') {
        let response = await sendData('/api/payments', data);
    }

})