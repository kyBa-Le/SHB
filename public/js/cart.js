import {moneyFormater, getData, sendData, patchData, deleteData} from "./components.js";
let orderItems = [];

orderItems = await getData('/api/order-items')

let cartItemsBody = document.getElementById('cart-items-body');
// render data to screen
async function renderOrderItems(orderItems) {
    if (orderItems.length === 0) {
        await renderEmptyCart(orderItems);
    }else {
        for (let item of orderItems) {
            let totalPrice = parseFloat(item['quantity']) * parseFloat(item['unit_price']);
            cartItemsBody.innerHTML += `
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
                            <input id="input-quantity-${item['id']}" class="text-center rounded-2" style="width: 30px" value="${item['quantity']}" readonly>
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
renderOrderItems(orderItems);

async function updateQuantity (updatedQuantity, id) {
     let quantity = parseInt(updatedQuantity);
     let orderItem = await patchData(`/api/order-items/${id}`, {quantity: quantity}, false);
     let totalPrice = orderItem['quantity'] * orderItem['unit_price'];
     document.getElementById('input-quantity-' + id).value = orderItem['quantity'];
     document.getElementById('total-price-' + id).dataset.value = totalPrice;
     document.getElementById('total-price-' + id).innerHTML = moneyFormater(totalPrice) + ' VND';
}

// thêm hàm cập nhật số lượng vào 2 nút cộng trừ
let updateButtons = document.getElementsByClassName('update-quantity');
for (let button of updateButtons) {
    button.addEventListener('click', async () => {
        let quantity = parseInt(button.dataset.quantity);
        let id = button.dataset.id;
        let oldQuantity = document.getElementById('input-quantity-' + id).value;
        quantity = parseInt(oldQuantity) + quantity;
        if (quantity > 0) {
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
    document.getElementById('total-price-purchase').innerHTML = moneyFormater(totalPricePurchase) + ' VND';
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
    if (orderItems == null) {
        orderItems = await getData('/api/order-items');
    }
    if (orderItems.length === 0) {
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