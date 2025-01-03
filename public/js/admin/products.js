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
    let products = await getData('/api/admin/products');
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

const addProductBtn = document.querySelector('.btn-add');
const overlay = document.getElementById('overlay');
const formContainer = document.getElementById('form-container');

addProductBtn.addEventListener('click', () => {
    overlay.style.display = 'block'; 
    formContainer.style.display = 'block';
});

overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
        overlay.style.display = 'none';
        formContainer.style.display = 'none';
    }
});

document.getElementById("add-product-btn").addEventListener("click", async function() {
    const productName = document.getElementById("product_name").value;
    const imageLink = document.getElementById("image_link").value;
    const category = document.getElementById("category").value;
    const color = document.getElementById("color").value;
    const price = document.getElementById("price").value;
    const quantity = document.getElementById("quantity").value;
    const description = document.getElementById("description").value;

    if (!productName || !imageLink || !category || !color || !price || !quantity || !description) {
        alert("Please fill all required fields.");
        return;
    }

    const productData = {
        product_name: productName,
        image_link: imageLink,
        category: category,
        color: color,
        price: parseFloat(price),
        quantity: parseInt(quantity),
        description: description
    };

    await sendData('/api/admin/products', productData);
    overlay.style.display = 'none';
    formContainer.style.display = 'none';
});
