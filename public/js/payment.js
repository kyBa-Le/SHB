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
    const form = this.closest('form');
    if (!form.checkValidity()) {
        form.reportValidity();
    }
    let method = document.querySelector('input[name="payment"]:checked').value;    let fullName = document.getElementById('full-name').value;
    let phone = document.getElementById('phone-number').value;
    let province = document.getElementById('province').value;
    let district = document.getElementById('district').value;
    let description = document.getElementById('description').value;
    let totalPrice = document.getElementById('total-price').dataset.value;
    let detailedAddress = document.getElementById('detailed-address').value;
    let data =
            {   total_cost: totalPrice,
                description:description,
                method:method,
                province:province,
                district:district,
                detailed_address:detailedAddress,
                full_name: fullName,
                phone: phone
            };
    let response;
    if (method === 'Momo') {
        // payment with momo
    } else if(method === 'COD') {
        response = await sendData('/api/payments', data);
    }
    if (response['isPaid'] !== false) {
        let orderItems = document.querySelectorAll('.item');
        let paymentId = response['payment']['id'];
        for (let item of orderItems) {
            let dataSet = item.dataset;
            let data = {
                product_name: dataSet.productName,
                quantity: dataSet.quantity,
                unit_price: dataSet.unitPrice,
                size: dataSet.size,
                product_id: dataSet.productId,
                product_image_link: dataSet.imageLink,
                product_color: dataSet.productColor,
                payment_id : paymentId
            }
            console.log(dataSet.isNew);
            if (dataSet.isNew  == false) {
                console.log(dataSet.id);
                response = await patchData('/api/order-items/' + dataSet.id, data);
            } else {
                response = await sendData('/api/order-items', data);
            }
        }
    }
})