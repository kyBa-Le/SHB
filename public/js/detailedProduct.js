import {getData} from "./components.js";

let param = new URLSearchParams(window.location.search);
let productColorPath = '/api/products/colors?' + param;
let productColors = await getData(productColorPath);

let subproduct = document.getElementById('sub-product-image');
for (let i = 0; i < productColors.length; i++){
    let product = productColors[i];
    let link = product['image_link'];
    subproduct.innerHTML += `<img src="${link}" data-color="${product['color']}" data-image-link="${product['image_link']}">`;
}
let buttonColorDetail = document.getElementById('button-color-detail');
for (let i = 0; i < productColors.length; i++){
    let product = productColors[i];
    let link = product['image_link'];
    buttonColorDetail.innerHTML += `<button data-color="${product['color']}" data-image-link="${product['image_link']}">${product['color']}</button>`;
}