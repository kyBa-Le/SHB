import {moneyFormater, getData, sendData, patchData, deleteData} from "../components.js";
async function searchProducts() {
    let keyword = document.getElementById('search-input').value;
    let path = '/api/admin/products/search?keyword=' + keyword;
    let products = await getData(path);
    updateProductTable(products);
}

document.getElementById('submit-btn').addEventListener('click', await searchProducts);

async function updateProductTable(products) {
    const tbody = document.getElementById('products-list');
    tbody.innerHTML = ''; 
    products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.product_name}</td>
            <td><img src="${product.image_link}" alt="${product.product_name}"></td>
            <td class='money'>${product.price}</td>
            <td>${product.quantity}</td>
            <td>${product.category}</td>
            <td>${product.description}</td>
            <td>
                <button id="${product.id}" class="btn btn-edit" data-id="${product.id}"><i class="fa fa-edit"></i></button>
            </td>
        `;
        tbody.appendChild(row);
    });
    await addUpdateAction();
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


const overlay = document.getElementById('overlay');
const addForm = document.getElementById('form-container-add-product');
const updateForm = document.getElementById('form-container-update-product');

function hideForm() {
    overlay.classList.add('d-none');
    addForm.classList.add('d-none');
    updateForm.classList.add('d-none');
}

overlay.addEventListener("click", (event) => {
    if (event.target === overlay) {
        hideForm();
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
    hideForm();
    window.location.reload();
});

async function addUpdateAction() {
    const overlay = document.getElementById("overlay");
    const updateForm = document.getElementById("form-container-update-product");
    let editBtn = document.querySelectorAll(".btn-edit");
    for (let button of editBtn) {
        let id = button.dataset.id;
        button.addEventListener('click', async function(){
            let product = await getData('/api/products/' + id);
            if (product != null) {
                document.getElementById("update-product_name").value = product.product_name;
                document.getElementById("update-price").value = product.price;
                document.getElementById("update-quantity").value = product.quantity;
                document.getElementById("update-image_link").value = product.image_link;
                document.getElementById("update-category").value = product.category;
                document.getElementById("update-description").value = product.description;
                document.getElementById("update-product-btn").dataset.id = product.id;
            }
            if (overlay.classList.contains('d-none') && updateForm.classList.contains('d-none')) {
                overlay.classList.remove('d-none');
                updateForm.classList.remove('d-none');
            }
        })
    }
    let moneys = document.querySelectorAll('.money');
    for (let money of moneys) {
        money.innerHTML = moneyFormater(money.innerHTML);
    }
}

document.addEventListener("DOMContentLoaded", await addUpdateAction);

document.getElementById("update-product-btn").addEventListener("click", async (event) => {
    const productId = event.target.dataset.id;
    const updatedProduct = {
        product_name: document.getElementById("update-product_name").value,
        price: document.getElementById("update-price").value,
        quantity: document.getElementById("update-quantity").value,
        image_link: document.getElementById("update-image_link").value,
        category: document.getElementById("update-category").value,
        description: document.getElementById("update-description").value,
    };
    await patchData('/api/admin/products/' + productId, updatedProduct);
    window.location.reload();
});

document.getElementById('btn-add-product').addEventListener('click', function() {
    addForm.classList.remove('d-none');
    overlay.classList.remove('d-none');
});

let moneys = document.querySelectorAll('.money');
for (let money of moneys) {
    money.innerHTML = moneyFormater(money.innerHTML);
}