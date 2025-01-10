import {moneyFormater, getData, sendData, patchData, deleteData} from "../components.js";

let orderItems = [];
orderItems = await getData('/api/admin/order-items');

// lọc sô lượng orders theo payments_id
const filteredOrders = orderItems.filter(item => item['status'] !== 'Pending');
const groupedOrders = filteredOrders.reduce((acc, item) => {
    const paymentId = item['payments_id'];
    if (!acc[paymentId]) {
        acc[paymentId] = [];
    }
    acc[paymentId].push(item);
    return acc;
}, {});
const lengthOfOrder = Object.keys(groupedOrders).length;
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
// Hiển thị order theo status
async function renderOrderByStatus(orderItems, status) {
    let filteredItems = [];
    if (status == 'Shipping') {
        filteredItems = orderItems.filter(item => item['status'] === 'Shipping');
    } else if (status == 'Delivered') {
        filteredItems = orderItems.filter(item => item['status'] === 'Delivered');
    } else {
        filteredItems = orderItems.filter(item => item['status'] !== 'Pending');
    }
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
                    <p class="noOfOrder">Payment ID: ${paymentId}</p>
                    ${products[0]['status'] === 'Delivered' ? 
                        `<div id="delivered-status-container">
                            <p class="delivered-status status-btn" style="background-color: #4cfd7e4c; color: #167E53;">Delivered</p>
                        </div>` :
                        `<div id="shipping-status-container" class="shipping-status-container">
                            <div id="button-container-${paymentId}">
                                <p data-id="${paymentId}" class="shipping-status status-btn" style="background-color: #ff000049; color: #DC3333;">Shipping <i id="down-${paymentId}" class="fa-solid fa-angle-down"></i> <i id="up-${paymentId}" class="fa-solid fa-angle-up d-none"></i></p>
                            </div>
                            <div id="box-status-order-${paymentId}" class="box-status-order d-none">
                                <div class="box-status-content-order">
                                    <span>Confirm delivery completed</span><i class="fa-regular fa-face-smile"></i>
                                </div>
                                <div class="change-button">
                                    <button id="status-change-btn-${paymentId}" data-id="${paymentId}" class="status-change-btn">Confirm</button>
                                </div>
                            </div>
                        </div>`}
                </div>
                <div class="user-infor mb-3" style="font-weight: bold;">
                    <span>User name: ${products[0]['fullName']}</span>
                    <span class="phone-number">Phone number: ${products[0]['phone']}</span>
                    <span class="date-order">Date: ${products[0]['dateTime']}</span>
                    <span class="address">Address: ${products[0]['detailed_address']} - ${products[0]['district']} - ${products[0]['province']}</span>
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
                <div class="contract d-none pb-4" id="contract" style="text-align: center;font-size:18px; cursor:pointer;">Contract <i class="fa-solid fa-angle-up"></i></div>
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
    changeStatus();
}
// Xử lý nút bấm
let buttons = [
    { elementId: 'all-orders', status: 'allOrder' },
    { elementId: 'delivered', status: 'Delivered' },
    { elementId: 'shipping', status: 'Shipping' },
];
// Hiển thị mặc định khi load trang 
changeStatus();
await renderOrderByStatus(orderItems, 'allOrder');
document.getElementById('all-orders').classList.add('active');
buttons.forEach(button => {
    const element = document.getElementById(button.elementId);
    if (element) {
        element.addEventListener('click', async () => {
            await renderOrderByStatus(orderItems, button.status);
            buttons.forEach(btn => {
                const btnElement = document.getElementById(btn.elementId);
                if (btnElement) btnElement.classList.remove('active');
            });
            element.classList.add('active');
        });
    }
});
// Xử lý đổi status
async function changeStatus() {
    let statusBtn = document.querySelectorAll('.shipping-status');
    for (let button of statusBtn) {
        let id = button.dataset.id;
        button.addEventListener('click', function () {
            let boxStatus = document.getElementById(`box-status-order-${id}`);
            let upIcon = document.getElementById(`up-${id}`);
            let downIcon = document.getElementById(`down-${id}`);
            if (boxStatus.classList.contains('d-none')) {
                upIcon.classList.remove('d-none');
                downIcon.classList.add('d-none');
                boxStatus.classList.remove('d-none'); 
            } else {
                downIcon.classList.remove('d-none');
                upIcon.classList.add('d-none');
                boxStatus.classList.add('d-none'); 
            }  
            let changeBtn = document.getElementById(`status-change-btn-${id}`)
            if (changeBtn) {
                changeBtn.addEventListener('click', async function () {
                    let response = await patchData('/api/admin/order-items', {payment_id: id});
                    boxStatus.classList.add('d-none'); 
                    if (response['isUpdate'] == true) {
                        let id = changeBtn.dataset.id;
                        document.getElementById(`button-container-${id}`).innerHTML = `<p class="delivered-status status-btn" style="background-color: #4cfd7e4c; color: #167E53;">Delivered</p>`;
                        orderItems = await getData('/api/admin/order-items');
                    }
                });
            }      
        });
    }
}
// Xử lýbox lọc bằng ngày
let boxFilterOrder = document.getElementById('box-filter-order');
let filterOrderBtn = document.getElementById('order-date-filter-btn');
let upIconFilterDate = document.getElementById('up-icon-date-filter-order');
let downIconFilterDate = document.getElementById('down-icon-date-filter-order');

filterOrderBtn.addEventListener('click', function () {
    if (boxFilterOrder.classList.contains('d-none')) {
        upIconFilterDate.classList.remove('d-none');
        downIconFilterDate.classList.add('d-none');
        boxFilterOrder.classList.remove('d-none'); 
    } else {
        downIconFilterDate.classList.remove('d-none');
        upIconFilterDate.classList.add('d-none');
        boxFilterOrder.classList.add('d-none'); 
    } 
});

// Xử lý lọc bằng ngày và hiển thị dữ liệu

let selectedDateFilter = null;
document.getElementById('filter-order-btn').addEventListener('click', async function () {
    const dateInput = document.querySelector('#date-filter input').value;
    
    selectedDateFilter = new Date(dateInput).toISOString().split('T')[0];
    const filterOrderBtnText = document.getElementById('order-date-filter-btn');
    filterOrderBtnText.innerHTML = `<i class="fa-regular fa-calendar-days"></i> ${selectedDateFilter} <i id="down-icon-date-filter-order" class="fa-solid fa-angle-down"></i><i id="up-icon-date-filter-order" class="fa-solid fa-angle-up d-none"></i>`;

    await filterAndRenderOrders();

    boxFilterOrder.classList.add('d-none');
    downIconFilterDate.classList.remove('d-none');
    upIconFilterDate.classList.add('d-none');
});


document.getElementById('cancel-filter-btn').addEventListener('click', async function () {
    selectedDateFilter = null;
    const filterOrderBtnText = document.getElementById('order-date-filter-btn');
    filterOrderBtnText.innerHTML = `<i class="fa-regular fa-calendar-days"></i> Filter orders by date <i id="down-icon-date-filter-order" class="fa-solid fa-angle-down"></i><i id="up-icon-date-filter-order" class="fa-solid fa-angle-up d-none"></i>`;
    document.querySelector('#date-filter input').value = '';

    await filterAndRenderOrders();

    boxFilterOrder.classList.add('d-none');
    downIconFilterDate.classList.remove('d-none');
    upIconFilterDate.classList.add('d-none');
});

async function filterAndRenderOrders(status = 'allOrder') {
    let filteredOrders = orderItems;

    if (selectedDateFilter) {
        filteredOrders = filteredOrders.filter(item => {
            const itemDate = new Date(item.dateTime).toISOString().split('T')[0];
            return itemDate === selectedDateFilter;
        });
    }

    if (status !== 'allOrder') {
        filteredOrders = filteredOrders.filter(item => item.status === status);
    }

    if (filteredOrders.length > 0) {
        await renderOrderByStatus(filteredOrders, status);
    } else {
        allOfOrder.innerHTML = `<p>No orders found.</p>`;
    }
}

buttons.forEach(button => {
    const element = document.getElementById(button.elementId);
    if (element) {
        element.addEventListener('click', async () => {
            await filterAndRenderOrders(button.status);

            buttons.forEach(btn => {
                const btnElement = document.getElementById(btn.elementId);
                if (btnElement) btnElement.classList.remove('active');
            });
            element.classList.add('active');
        });
    }
});

await filterAndRenderOrders('allOrder');
document.getElementById('all-orders').classList.add('active');
