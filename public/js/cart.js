import {moneyFormater, getData, sendData, patchData, deleteData} from "./components.js";
let orderItems = [];

orderItems = await getData('/api/order-items')
console.log(orderItems);
const cartItemsBody = document.getElementById('cart-items-body');
const orderDeliveryBody = document.getElementById('order-delivered-infor-content');
const orderShippingBody = document.getElementById('order-shipping-infor-content');
// render data to screen
async function renderPendingOrder(orderItems) {
    const pendingItems = orderItems.filter(item => item['status'] === 'Pending');
    console.log(pendingItems.length)
    if (pendingItems.length === 0) {
        await renderEmptyCart(pendingItems);
    }else {
        for (let item of pendingItems) {
            let totalPrice = parseFloat(item['quantity']) * parseFloat(item['unit_price']);
            cartItemsBody.innerHTML += `
            <div id="product-id" class="d-none" data-id="${item['product_id']}"></div>
                <div class="cart-item" id="cart-item-${item['id']}">
                    <div class='cart-item-select'>
                        <input class="ms-3 item-checkbox" type="checkbox" data-id="${item['id']}">
                        <img class="item-image ms-4" src="${item['product_image_link']}">
                    </div>
                    <div class="d-flex flex-column justify-content-between">
                        <h5 onclick="{window.location.href='/detailed-product?product-id=' + ${item['product_id']}}">${item['product_name']}</h5>
                        <div  class="cart-item-detail">
                            <p>${item['product_color']} / ${item['size']}</p>
                            <p class="money" data-value="${item['unit_price']}" id="unit-price-${item['id']}">${moneyFormater(item['unit_price'])} đ</p>
                            <form>
                                <button data-quantity=${-1} type="button" class="update-quantity rounded-2" data-id="${item['id']}">-</button>
                                <input id="input-quantity-${item['id']}" class="text-center rounded-2 border-0" style="width: 30px" value="${item['quantity']}" readonly>
                                <button data-quantity=${1} type="button" class="update-quantity rounded-2" data-id="${item['id']}">+</button>
                            </form>
                            <p class="money" id="total-price-${item['id']}" data-value=${totalPrice}>${moneyFormater(totalPrice)} đ</p>
                            <i class="fa-regular fa-trash-can icon-remove" data-id="${item['id']}"></i>
                        </div>
                    </div>
                </div>
            `
        }
    }
}
 await renderPendingOrder(orderItems);

// render track order
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
function renderOrderByStatus(orderItems, status, orderBodyElement) {
    const filteredItems = orderItems.filter(item => item['status'] === status);
    if (filteredItems.length === 0) {
        orderBodyElement.innerHTML = `<p>No ${status.toLowerCase()} orders found.</p>`;
        return;
    }
    const groupedOrders = groupByPaymentId(filteredItems);
    for (const [paymentId, products] of Object.entries(groupedOrders)) {
        let totalOrderPrice = 0;
        orderBodyElement.innerHTML += `
            <div class="product-infor-content">
                <p class="noOfOrder">Order ID: ${paymentId}</p>
        `;
        products.forEach(product => {
            const itemTotalPrice = product['quantity'] * product['unit_price'];
            totalOrderPrice += itemTotalPrice;
            orderBodyElement.innerHTML += `
                    <div class="product-item-infor mb-3">
                        <span class="product-name-color-size d-flex flex-column">
                            <span class="product-name">${product['product_name']}</span>
                            <span class="product-color-size">
                                <span class="product-color" style="font-size: 16px; color: #777070;">${product['product_color']}</span>
                                <span style="font-size: 16px; color: #777070;">/</span>
                                <span class="product-size" style="font-size: 16px; color: #777070;">${product['size']}</span>
                            </span>
                        </span>
                        <span class="produc-quantity">x ${product['quantity']}</span>
                        <span class="produc-total-prie">Total price: ${itemTotalPrice.toLocaleString()}đ</span>
                        ${status === 'Delivered' ? '<button class="review-product">Review</button>' : ''}
                    </div>
            `;
        });
        orderBodyElement.innerHTML += `
                <hr>
                <p class="produc-total-order" style="font-weight:bold; text-align:end;">Total order price: ${totalOrderPrice.toLocaleString()}đ</p>
            </div>
        `;
    }
}
await renderOrderByStatus(orderItems, 'Delivered', orderDeliveryBody);
await renderOrderByStatus(orderItems, 'Shipping', orderShippingBody);

async function updateQuantity (updatedQuantity, id) {
     let quantity = parseInt(updatedQuantity);
     let orderItem = await patchData(`/api/order-items/${id}`, {quantity: quantity}, false);
     let totalPrice = orderItem['quantity'] * orderItem['unit_price'];
     document.getElementById('input-quantity-' + id).value = orderItem['quantity'];
     document.getElementById('total-price-' + id).dataset.value = totalPrice;
     document.getElementById('total-price-' + id).innerHTML = moneyFormater(totalPrice) + ' đ';
}

// thêm hàm cập nhật số lượng vào 2 nút cộng trừ
let updateButtons = document.getElementsByClassName('update-quantity');
for (let button of updateButtons) {
    button.addEventListener('click', async () => {
        let quantity = parseInt(button.dataset.quantity);
        let id = button.dataset.id;
        let oldQuantity = document.getElementById('input-quantity-' + id).value;
        quantity = parseInt(oldQuantity) + quantity;
        let productId = document.getElementById('product-id').dataset.id;
        let product = await getData('/api/products/' + productId);
        if (quantity > 0 && quantity<= product['quantity']) {
            await updateQuantity(quantity , id);
        }
        updatePurchaseButton();
    });
}

// xóa phần tử trong
for (let icon of document.getElementsByClassName('icon-remove')) {
    icon.addEventListener('click', async function() {
        await deleteData(`/api/order-items/${icon.dataset.id}`, null, false);
        document.getElementById(`cart-item-${icon.dataset.id}`).remove();
        updatePurchaseButton();
        await renderEmptyCart();
    });
}

// Xử lý sự kiện cho các ô checkbox
let masterCheckbox = document.getElementById('choose-all');
// Đồng bộ chọn tất cả hoặc không
masterCheckbox.addEventListener('change', function (event) {
    let checkboxes = document.getElementsByClassName('item-checkbox');
    let isChecked = event.target.checked;
    for (let box of checkboxes) {
        box.checked = isChecked;
    }
    updatePurchaseButton();
})

// Thay đổi nội dung của nút mua hàng
function updatePurchaseButton() {
    const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
    let totalQuantity = 0;
    let totalPricePurchase = 0;
    checkedCheckboxes.forEach((checkbox) => {
        let id = checkbox.dataset.id;
        let quantity = parseFloat(document.getElementById('input-quantity-' + id).value);
        let totalPrice = parseFloat(document.getElementById('total-price-' + id).dataset.value);
        totalQuantity += quantity;
        totalPricePurchase += totalPrice ;
    })
    document.getElementById('total-price-purchase').innerHTML = moneyFormater(totalPricePurchase) + ' ';
    document.getElementById('quantity-purchase').innerHTML = `Purchases (${totalQuantity})`;
}

let checkboxes = document.getElementsByClassName('item-checkbox');
for (let box of checkboxes) {
    box.addEventListener('change', updatePurchaseButton);
}
document.getElementById('remove-all').addEventListener('click', async function () {
    let items = document.querySelectorAll('.item-checkbox:checked');
    for (let item of items) {
        let id = item.dataset.id;
        await deleteData('/api/order-items/' + id, null, false);
        document.getElementById(`cart-item-${id}`).remove();
        updatePurchaseButton();
        await renderEmptyCart();
    }
})

async function renderEmptyCart(orderItems = null) {
    let pendingItems = [];
    if (orderItems == null) {
        orderItems = await getData('/api/order-items');
        pendingItems = orderItems.filter(item => item['status'] === 'Pending');
    }
    if (pendingItems.length === 0) {
        cartItemsBody = document.getElementById('cart-items-body');
        cartItemsBody.innerHTML = `
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRiP3u0Wiokd_JTbjmrB6P_KcYKjVI2EeA1hGLawYteCYSqB0gO">
                            <h2>Your cart is empty</h2>
                            <p>Browse the store, shop now</p>
                            <button class="w-25 p-2" style="color: white; background: black" onclick="{document.getElementById('search-focus').focus()}">Search products</button>
                    </div>`;
    }
}

// Track order Delivered Order
let orderPaid = document.getElementById('order-delivered-infor-content');
let orderShipping = document.getElementById('order-shipping-infor-content');
let orderPaidBtn = document.getElementById('btn-order-delivered');
let orderShippingBtn = document.getElementById('btn-order-shipping');

orderPaidBtn.addEventListener('click', function () {
    orderPaid.style.display = 'block';
    orderShipping.style.display = 'none';
    orderPaidBtn.style.backgroundColor = '#0F0E0E';
    orderPaidBtn.style.color = 'white';
    orderShippingBtn.style.backgroundColor = 'white';
    orderShippingBtn.style.color = 'black';
});

orderShippingBtn.addEventListener('click', function () {
    orderPaid.style.display = 'none';
    orderShipping.style.display = 'block';
    orderShippingBtn.style.backgroundColor = '#0F0E0E';
    orderShippingBtn.style.color = 'white';
    orderPaidBtn.style.backgroundColor = 'white';
    orderPaidBtn.style.color = 'black';
});
