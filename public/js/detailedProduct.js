import {getData, moneyFormater, sendData} from "./components.js";

// This place is to get product and show to the screen
let productPath = '/api' + window.location.pathname;
let detailedProduct = await getData(productPath);
let data = document.getElementById('product-details-data');
let productName = document.getElementById('product-name-detail')
let productPrice = document.getElementById('product-detail-price');
let productQuantity = document.getElementById('product-detail-quantity');

document.getElementById('container-product-detail-image').innerHTML += `<img data-color-${detailedProduct['color']} id="detailed-product-image-link" src="${detailedProduct['image_link']}" alt="Product Image" data-image-link="${detailedProduct['image_link']}">`;
productName.innerHTML += detailedProduct['product_name'];
productPrice.innerHTML += moneyFormater(detailedProduct['price']) + 'đ';
productQuantity.innerHTML += detailedProduct['quantity'];
document.getElementById('sub-product-image').innerHTML += `<img src="${detailedProduct['image_link']}" data-color="${detailedProduct['color']}" class="change-color-item selecting-item" data-image-link="${detailedProduct['image_link']}">`;
document.getElementById('button-color-detail').innerHTML += `<button data-color="${detailedProduct['color']}" data-image-link="${detailedProduct['image_link']}" class="change-color-item selecting-item">${detailedProduct['color']}</button>`;
document.getElementById('product-detail-description').innerHTML += detailedProduct['description'];
data.dataset.color = detailedProduct['color'];
data.dataset.imageLink = detailedProduct['image_link'];

function changeColoredItem (color) {
    let items = document.getElementsByClassName('detailed-product-' + color);
    for (let item of items) {
        item.styles.border = '2px solid black';
    }
}

function changeData(color , image_link, size) {
    color = color ?? data.dataset.color;
    image_link = image_link ?? data.dataset.imageLink;
    size = size ?? data.dataset.size;
    data.dataset.color = color;
    data.dataset.size = size;
    data.dataset.imageLink = image_link;
}

// This place is to get product colors to show to the small image under the
let productId = detailedProduct['id'];
let productColorPath = '/api/product-colors?product-id=' + productId;
let productColors = await getData(productColorPath);

let subproduct = document.getElementById('sub-product-image');
for (let i = 0; i < productColors.length; i++) {
    let product = productColors[i];
    let link = product['image_link'];
    subproduct.innerHTML += `<img src="${link}" class="change-color-item" data-color="${product['color']}" data-image-link="${product['image_link']}">`;
}

let buttonColorDetail = document.getElementById('button-color-detail');
for (let i = 0; i < productColors.length; i++){
    let product = productColors[i];
    let link = product['image_link'];
    buttonColorDetail.innerHTML += `<button class="change-color-item" data-color="${product['color']}" data-image-link="${link}">${product['color']}</button>`;
}
function changeBorder (color) {
    let changeColorItems = document.getElementsByClassName('change-color-item');
    for (let item of changeColorItems) {
        if (item.dataset.color !== color) {
            item.classList.remove('selecting-item')
        } else {
            item.classList.add('selecting-item');
        }
    }
}

let changeColorItems = document.getElementsByClassName('change-color-item');
for (let element of changeColorItems) {
    element.addEventListener('click', function () {
        let color = this.dataset.color;
        let imageLink = this.dataset.imageLink;
        document.getElementById('detailed-product-image-link').src = imageLink;
        changeColoredItem(color);
        changeBorder(color);
        changeData(color, imageLink);
    });
}

// Chose size
let size = ''; 
let selectedButton = null; 
document.querySelectorAll('.size-btn').forEach(button => {
    button.addEventListener('click', function () {
        if (selectedButton) {
            selectedButton.style.backgroundColor = ''; 
            selectedButton.style.border = '';
            selectedButton.style.color = '';
        }
        selectedButton = this;
        this.style.backgroundColor = '#0F0E0E';
        this.style.border = '#0F0E0E';
        this.style.color = 'white';
        size = this.getAttribute('data-size'); 
        changeData(null, null, size);
    });
    const defaultButton = document.querySelector('.size-btn[data-size="S"]');
    if (defaultButton) {
        defaultButton.click(); 
    }
});

// Quantity
let quantityBuyValue = parseInt(document.getElementById('quantity-buy').value, 10);
let quantityLimit = parseInt(detailedProduct['quantity']); 
minusBtn.addEventListener('click', function () {
    document.getElementById('quantity-error').innerHTML = '';
    document.getElementById('addToCartMessage').innerHTML = '';
    if (quantityBuyValue > 1) {
        quantityBuyValue -= 1;
        document.getElementById('quantity-buy').value = quantityBuyValue;
    } else {
        document.getElementById('quantity-error').innerHTML = 'Quantity less than 1';
    }
});
plusBtn.addEventListener('click', function () {
    document.getElementById('quantity-error').innerHTML = '';
    document.getElementById('addToCartMessage').innerHTML = '';
    if (quantityBuyValue < quantityLimit) {
        quantityBuyValue += 1;
        document.getElementById('quantity-buy').value = quantityBuyValue;
    } else {
        document.getElementById('quantity-error').innerHTML = 'Quantity exceeds stock';
    }
});

// handle API to add to cart
let addToCartBtn = document.getElementById('addToCartBtn');
addToCartBtn.addEventListener('click', async function () {
    let response
    if (quantityBuyValue > detailedProduct['quantity']) {
        response = {
            message : 'sorry, the quantity in stock is not enough',
            isAddToCartSuccess: false
        };
    }else {
        response = await sendData('/api/order-items', {
            product_name: detailedProduct['product_name'],
            quantity: quantityBuyValue,
            unit_price: detailedProduct['price'],
            size: data.dataset.size,
            product_id: detailedProduct['id'],
            product_image_link: data.dataset.imageLink,
            product_color: data.dataset.color
        }, false);
    }

    let messageColor = response['isAddToCartSuccess'] ? 'green' : 'red';
    document.getElementById('addToCartMessage').innerHTML = '';
    document.getElementById('addToCartMessage').innerHTML += `<span style="color: ${messageColor};">${response['message']}</span>`;
    setTimeout(() => {
        document.getElementById('addToCartMessage').innerHTML = '';
    }, 1500);
});

// handle order button
document.getElementById('orderBtn').addEventListener('click', function(event) {
    event.preventDefault();
    let response;
    if (quantityBuyValue > detailedProduct['quantity']) {
        response = {
            message: 'sorry, the quantity in stock is not enough',
            isAddToCartSuccess: false
        };
        let messageColor = response['isAddToCartSuccess'] ? 'green' : 'red';
        document.getElementById('addToCartMessage').innerHTML = '';
        document.getElementById('addToCartMessage').innerHTML += `<span style="color: ${messageColor};">${response['message']}</span>`;
        setTimeout(() => {
            document.getElementById('addToCartMessage').innerHTML = '';
        }, 1500);
    } else {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '/payment';
        const productData = [{
            product_name: detailedProduct['product_name'],
            quantity: quantityBuyValue,
            unit_price: detailedProduct['price'],
            size: data.dataset.size,
            product_id: detailedProduct['id'],
            product_image_link: data.dataset.imageLink,
            product_color: data.dataset.color
        }];
        productData.forEach(item => {
            Object.keys(item).forEach(key => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = item[key];
                form.appendChild(input);
            });
        });
        document.body.appendChild(form);
        form.submit();
    }

});

// Xử lý hiển thị
let reviews = await getData('/api/reviews?product-id=' + detailedProduct['id']);
for (let review of reviews) {
    document.getElementById('review-container').innerHTML += `
    <div class="review-detail">
            <img src="${review['avatar_link']}" class="user-avatar"  alt="User">
            <div class="review-content-detail">
                <h5>${review['username']}</h5>
                <p>Classify: ${review['product_color']} - ${review['size']}</p>
                <p style="color: black">${review['content']}</p>
                <div class="image-review-container mt-2" id='image-review-container-${review['id']}'></div>
            </div>
            <div></div>
        </div>
`
    let imageReviews = await getData('/api/review-images?review-id=' + review['id']);
    for (let image of imageReviews) {
        document.getElementById("image-review-container-" + review['id']).innerHTML += `
            <img class="image-review" src="${image['image_link']}">
        `
    }
}


