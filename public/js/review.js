// <script src='js/review.js' type='module'></script>
import {sendData, sleep, loadWaiting, hideWaiting} from "./components.js";
const inputImages = document.getElementById('images');
const previewContainer = document.getElementById('images-preview');
let uploadedFiles = []; // Array to hold uploaded files

// Event listener for file input
inputImages.addEventListener('change', function (event) {
    const files = Array.from(event.target.files);

    files.forEach((file, index) => {
        const reader = new FileReader();
        const imgContainer = document.createElement('div');
        imgContainer.classList.add('image-container');
        const img = document.createElement('img');
        const removeButton = document.createElement('button');
        removeButton.innerText = '×';
        removeButton.onclick = function () {
            uploadedFiles.splice(index, 1);
            imgContainer.remove();
            if (uploadedFiles.length === 0) {
                inputImages.value = '';
            }
        };
        reader.onload = function (e) {
            img.src = e.target.result;
            imgContainer.appendChild(img);
            imgContainer.appendChild(removeButton);
            previewContainer.appendChild(imgContainer);
        };
        reader.readAsDataURL(file);
        uploadedFiles.push(file);
    });
});
const form = document.getElementById('review-form');

// Xử lý khi submit form
form.addEventListener('submit', async function (event) {
    event.preventDefault();
    let content = document.getElementById('content').value;
    let orderId = document.getElementById('order-id').value;
    let userId = document.getElementById('user-id').value;
    let response = await sendData('/api/reviews', {
        order_id: orderId,
        content: content,
        user_id: userId
    }, false)
    if (response['isSuccess']) {
        const review = response['review'];
        let isSuccess = true;
        loadWaiting();
        for (let i = 0; i < uploadedFiles.length; i++) {
            let form = new FormData();
            form.append('images', uploadedFiles[i]);
            form.append('review_id', review['id']);
            let response = await fetch('/api/review-images', {method: 'POST',
                body: form
            }).then(response => {return response.json()});
            isSuccess = response['isSuccess'];
        }
        hideWaiting();
        if (isSuccess) {
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.readOnly = true;
            });
            document.getElementById('review-form').innerHTML = `<img class="w-50" src="images/successTick.gif"><h1 style="color: green">Review successfully</h1>`;
            await sleep(2000);
            window.location.href = '/cart';
        }
    }
})