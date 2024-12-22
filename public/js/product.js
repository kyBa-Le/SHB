import {getData, moneyFormater} from "./components.js";

//format money
const moneyElements = document.getElementsByClassName('money');
for (const element of moneyElements) {
    element.innerHTML = moneyFormater(element.innerHTML);
}

//Implement pagination after click see more
let seeMoreButton = document.getElementById('category-products-see-more');
let pageNo = document.getElementById('category-products-page-number');
document.getElementById('category-products-see-more').addEventListener('click', async function () {
    let path = '/api/products?category=' + seeMoreButton.value  + '&pageNo=' + pageNo.value + '&pageSize=6';
    let products = await getData(path);
    if (products.length !== 0) {
        pageNo.value =  parseInt(pageNo.value) + 1 ;
    }
    renderProducts(products);
})

function renderProducts(products) {
    for (let i = 0; i < products.length; i++) {
        let product = products[i];
        let image_link = product['image_link'];
        let name = product['product_name'];
        let price = moneyFormater(product['price']);
        let purchases = product['purchases'];
        let detailedLink = '/detailed-product?product-id=' + product['id'];
        document.getElementById('category-products-container').innerHTML += `<div class="category-product-card">
            <div class="product-image" style="background-image: url(${image_link})" onclick="{window.location.href='${detailedLink}'}"></div>
            <div class="product-contents">
                <p class="fw-bold fs-5 category-product-name" onclick="{window.location.href=${detailedLink}}">${name}</p>
                <div class="product-price-and-sold d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <p class="m-0"><span class="money">${price}</span> vnd</p>
                    </div>
                    <p class="text-end mb-0">Sold: ${purchases}</p>
                </div>
                <div class='product-detail' onclick="{window.location.href='${detailedLink}'}">
                    <button>Discover the details</button>
                </div>
            </div>
        </div>
        `;
    }
}