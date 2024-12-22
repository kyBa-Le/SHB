import {moneyFormater, getData, sendData} from "./components.js";
//todo: remove these sample data
let orderItems = [
    {
        id: 1,
        product_name: "Wireless Headphones",
        quantity: 2,
        total_price: 300,
        size: "M",
        product_id: 101,
        image_link: "https://images.asos-media.com/products/topman-belted-car-coat-in-brown/206513615-1-oatmeal?$n_640w$&wid=513&fit=constrain",
        color: "Black",
        payments_id: 501,
        user_id: 1001,
        status: "Shipped",
        unit_price: 100
    },
    {
        id: 2,
        product_name: "Running Shoes",
        quantity: 1,
        total_price: 120,
        size: "L",
        product_id: 102,
        image_link: "https://images.asos-media.com/products/topman-belted-car-coat-in-brown/206513615-1-oatmeal?$n_640w$&wid=513&fit=constrain",
        color: "Blue",
        payments_id: 502,
        user_id: 1002,
        status: "Processing",
        unit_price: 100
    }
];
// todo: declare orderItems above
let cartItemsBody = document.getElementById('cart-items-body');

// render data to screen
if (orderItems.length === 0) {
    cartItemsBody.innerHTML = `
        <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRiP3u0Wiokd_JTbjmrB6P_KcYKjVI2EeA1hGLawYteCYSqB0gO">
                <h2>Your cart is empty</h2>
                <p>Browse the store, shop now</p>
                <button class="w-25 p-2" style="color: white; background: black" onclick="{document.getElementById('search-focus').focus()}">Search products</button>
        </div>`;
}else {
    for (let item of orderItems) {
        cartItemsBody.innerHTML += `
            <div class="cart-item" id="cart-item-${item['id']}">
                <div>
                    <input class="ms-3" type="checkbox">
                    <img class="item-image ms-4" src="${item['image_link']}">
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h5>${item['product_name']}</h5>
                    <div  class="cart-item-detail">
                        <p>${item['color']} / ${item['size']}</p>
                        <p class="money">${moneyFormater(item['unit_price'])} đ</p>
                        <form>
                            <button type="button" class="update-quantity" data-id="${item['id']}">-</button>
                            <input id="input-quantity-${item['id']}" class="text-center" style="width: 30px" value="${item['quantity']}" readonly>
                            <button type="button" class="update-quantity" data-id="${item['id']}">+</button>
                        </form>
                        <p class="money">${moneyFormater(item['total_price'])} đ</p>
                        <i class="fa-regular fa-trash-can icon-remove" data-id="${item['id']}"></i>
                    </div>
                </div>
            </div>
        `
    }
}

async function updateQuantity (updatedQuantity, id) {
     let quantity = parseInt(updatedQuantity);
     let response = await sendData('/api/cart-items/update-quantity', {quantity: quantity, id:id});
     document.getElementById('input-quantity-' + id).value = response['quantity'];
}

// thêm hàm cập nhật số lượng vào 2 nút cộng trừ
let updateButtons = document.getElementsByClassName('update-quantity');
for (let button of updateButtons) {
    button.addEventListener('click', async () => {
        let quantity = button.dataset.quantity;
        let id = button.dataset.id;
        await updateQuantity(quantity, id);
    });
}

// xóa phần tử trong
for (let icon of document.getElementsByClassName('icon-remove')) {
    icon.addEventListener('click', async function() {
        await sendData('/api/cart-items/delete?id=' + icon.dataset.id);
        document.getElementById(`cart-item-${icon.dataset.id}`).remove();
    });
}