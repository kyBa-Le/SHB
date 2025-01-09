import {getData, patchData, sendData, redirectToPost, sleep, moneyFormater} from "./components.js";

const urlParams = new URLSearchParams(window.location.search);
const paymentId = urlParams.get('paymentId');
if (paymentId) {
    const paymentData = JSON.parse(localStorage.getItem('paymentData'));
    if (paymentData && paymentData.items) {
        for (let item of paymentData.items) {
            const data = {
                product_name: item.productName,
                quantity: item.quantity,
                unit_price: item.unitPrice,
                size: item.size,
                product_id: item.productId,
                product_image_link: item.imageLink,
                product_color: item.color,
                payment_id: paymentId,
            };
            let response;
            if (item.isNew === 'false') {
                response = await patchData('/api/order-items/' + item.id, data);
            } else {
                response = await sendData('/api/order-items', data);
            }
            if (!response || !response.success) {
                console.error(`Failed to update item: ${item.productName}`);
            }
        }
        document.getElementById('full-container').innerHTML = `
                <div class="d-flex text-center align-items-center justify-content-center flex-column w-100 h-100" style="min-height: 60vh">
                    <img class="w-25" src="images/successTick.gif" alt="Success">
                    <h1 style="color: green">Payment successfully</h1>
                </div>`;
        await sleep(2000);
        localStorage.removeItem('paymentData');
        window.location.href = '/cart';
    }
} else if (urlParams.get('error') === 'payment_failed') {
    alert('Payment failed. Please try again.');
}

let proviceData = await getData('https://provinces.open-api.vn/api/?depth=2');
let provinceSelect = document.getElementById('province');
let districtSelect = document.getElementById('district');
for (let i = 0; i <proviceData.length; i++) {
    let address = proviceData[i];
    provinceSelect.innerHTML += `<option value="${address.name}">${address.name}</option>`;
}
provinceSelect.addEventListener('change', function () {
        let selectedProvince = proviceData.find(p => p.name == provinceSelect.value);
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
        return;
    } else {
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
            let paymentData = {
                items: Array.from(document.querySelectorAll('.item')).map(item => ({
                    productName: item.dataset.productName,
                    quantity: item.dataset.quantity,
                    unitPrice: item.dataset.unitPrice,
                    size: item.dataset.size,
                    productId: item.dataset.productId,
                    imageLink: item.dataset.imageLink,
                    color: item.dataset.productColor,
                    isNew: item.dataset.isNew,
                    id: item.dataset.id,
                })),
                totalPrice: document.getElementById('total-price').dataset.value,
                customerInfo: {
                    fullName: document.getElementById('full-name').value,
                    phone: document.getElementById('phone-number').value,
                    province: document.getElementById('province').value,
                    district: document.getElementById('district').value,
                    detailedAddress: document.getElementById('detailed-address').value,
                    description: document.getElementById('description').value,
                }
            };
            localStorage.setItem('paymentData', JSON.stringify(paymentData));
            data.payUrl = '/payment';
            await redirectToPost('/payment/momo', data);
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
                if (dataSet.isNew  == 'false') {
                    response = await patchData('/api/order-items/' + dataSet.id, data);
                } else {
                    response = await sendData('/api/order-items', data);
                }
            }
        }
        document.getElementById('full-container').innerHTML = `<div class="d-flex text-center align-items-center justify-content-center flex-column w-100 h-100" style="min-height: 60vh"><img class="w-25" src="images/successTick.gif"><h1 style="color: green">Payment successfully</h1></div>`;
        await sleep(2000);
        window.location.href = '/cart';
    }
})

const moneyElements = document.getElementsByClassName('money');
for (const element of moneyElements) {
    element.innerHTML = moneyFormater(element.innerHTML);
}