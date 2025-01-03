import {moneyFormater, getData, sendData, patchData, deleteData} from "../components.js";
async function searchProducts() {
    let keyword = document.getElementById('search-input').value;
    let path = '/api/admin/products/search?keyword=' + keyword;
    let products = await getData(path);
    updateProductTable(products);
}

document.getElementById('submit-btn').addEventListener('click', await searchProducts);

function updateProductTable(products) {
    const tbody = document.getElementById('products-list');
    tbody.innerHTML = ''; 
    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.product_name}</td>
            <td><img src="${product.image_link}" alt="${product.product_name}"></td>
            <td>${product.price}</td>
            <td>${product.quantity}</td>
            <td>${product.category}</td>
            <td>${product.description}</td>
            <td>
                <button class="btn btn-edit"><i class="fa fa-edit" data-id="${product.id}"></i></button>
                <button class="btn btn-delete"><i class="fa fa-trash" data-id="${product.id}"></i></button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

async function sortPrice(selectedSort) {
    const params = new URLSearchParams(window.location.search);
    let products = await getData('/api/admin/products?' + params);
    if (selectedSort === 'increase') {
        products.sort((a, b) => a.price - b.price);

    } else if (selectedSort === 'decrease') {
        products.sort((a, b) => b.price - a.price);
    }
    updateProductTable(products);
}

const sortButton = document.getElementById('sort-btn');
sortButton.addEventListener('click', async (event) => {
    event.preventDefault();
    const selectedSort = document.querySelector('input[name="sort"]:checked').value;
    await sortPrice(selectedSort);
});
