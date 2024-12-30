import {moneyFormater, getData, sendData, patchData, deleteData} from "../components.js";
let orderItems = [];

orderItems = await getData('/api/admin/order-items');
let lengthOfOrder = orderItems.length;
console.log(lengthOfOrder);
document.getElementById('order-quantity').innerHTML = lengthOfOrder + ' orders found';
let allOfOrder = document.getElementById('products-infor-orders');
// render orders
function groupByPaymentId(orderItems) {
    return orderItems.reduce((acc, item) => {
        const paymentId = item['payments_id'];
        if (!acc[paymentId]) {
            acc[paymentId] = [];
        }
        acc[paymentId].push(item);
        return acc;
    }, {});
}
async function renderOrderByStatus(orderItems) {
    const filteredItems = orderItems.filter(item => item['status'] === 'Shipping' || item['status'] === 'Delivered');
    if (filteredItems.length === 0) {
        allOfOrder.innerHTML = `<p>No orders found.</p>`;
        return;
    }
    const groupedOrders = groupByPaymentId(filteredItems);
    let allOrdersHtml = '';

    for (const [paymentId, products] of Object.entries(groupedOrders)) {
        let totalOrderPrice = 0;
        let orderHtml = `
            <div class="product-infor-content">
                <div class="noOfOrder-status-btn d-flex justify-content-between">
                    <p class="noOfOrder">Order ${paymentId}</p>
                    ${products[0]['status'] === 'Delivered' ? 
                        `<p class="delivered status-btn" style="background-color: #4cfd7e4c; color: #167E53;">Delivered</p>` :
                        `<p class="shipping status-btn" style="background-color: #ff000049; color: #DC3333;">Shipping <i class="fa-solid fa-angle-down"></i></p>`
                    }
                </div>
                <div class="user-infor d-flex justify-content-between mb-3" style="font-weight: bold;">
                    <span>User name: Kim Sa</span>
                    <span class="phone-number">Phone number: 0123456789</span>
                    <span class="address">Address: Quảng Trị</span>
                </div>
                <div class="product-item" style="max-height: 0px; overflow: hidden; transition: max-height 0.5s ease;">
        `;

        for (const product of products) {
            const itemTotalPrice = product['quantity'] * product['unit_price'];
            totalOrderPrice += itemTotalPrice;
            orderHtml += `
                <div class="product-item-infor mb-3">
                    <span class="product-name-color-size d-flex flex-column">
                        <span class="product-name" style="font-size:18px;">${product['product_name']}</span>
                        <span class="product-color-size">
                            <span class="product-color" style="font-size: 16px; color: #777070;">${product['product_color']}</span>
                            <span style="font-size: 16px; color: #777070;">/</span>
                            <span class="product-size" style="font-size: 16px; color: #777070;">${product['size']}</span>
                        </span>
                    </span>
                    <span class="product-quantity" style="font-size:18px;">x ${product['quantity']}</span>
                    <span class="product-total-price" style="font-size:18px;">Total price: ${itemTotalPrice.toLocaleString()}đ</span>
                </div>
            `;
        }
        orderHtml += ` 
                </div>
                <p class="product-total-order mt-2" style="font-weight:bold; text-align:end; font-size:18px;">
                    Total order price: ${totalOrderPrice.toLocaleString()}đ
                </p>
                <hr>
                <div class="view-detail pb-4" id="view-detail" style="text-align: center;font-size:18px; cursor:pointer;">View detail <i class="fa-solid fa-angle-down"></i></div>
                <div class="contract d-none pb-4" id="contract" style="text-align: center;font-size:18px; cursor:pointer;">Contract <i class="fa-solid fa-chevron-up"></i></div>
            </div>
        `;
        allOrdersHtml += orderHtml;
    }
    allOfOrder.innerHTML = allOrdersHtml;
    const viewDetails = document.querySelectorAll('.view-detail');
    const contracts = document.querySelectorAll('.contract');

    viewDetails.forEach(viewDetail => {
        viewDetail.addEventListener('click', () => {
            const container = viewDetail.closest('.product-infor-content');
            const productItems = container.querySelector('.product-item');
            const contractButton = container.querySelector('.contract');

            productItems.classList.remove('d-none'); 
            setTimeout(() => {
                productItems.style.maxHeight = productItems.scrollHeight + 'px';
            }, 0);

            setTimeout(() => {
                viewDetail.classList.add('d-none'); 
                if (contractButton) contractButton.classList.remove('d-none');  
            }, 500); 
        });
    });

    contracts.forEach(contract => {
        contract.addEventListener('click', () => {
            const container = contract.closest('.product-infor-content');
            const productItems = container.querySelector('.product-item');
            const viewDetailButton = container.querySelector('.view-detail'); 

            productItems.style.maxHeight = productItems.scrollHeight + 'px'; 
            setTimeout(() => {
                productItems.style.maxHeight = '0px';
            }, 0);

            setTimeout(() => {
                productItems.classList.add('d-none'); 
                contract.classList.add('d-none');  
                if (viewDetailButton) viewDetailButton.classList.remove('d-none');
            }, 500);
        });
    });
}

await renderOrderByStatus(orderItems);
