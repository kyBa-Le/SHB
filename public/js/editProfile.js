let editButton = document.getElementById('edit-profile-button');
let submitButton = document.getElementById('edit-profile-submit');
let inputElements = document.getElementsByClassName('edit-profile-input');
let changePassword = document.getElementById('click-change-password');
let containerEditProfile = document.querySelector('.container-edit-profile');
let changeImageBtn = document.getElementById("change-image-button");
let imageUpload = document.getElementById("image-upload");
let profileImage = document.getElementById("profile-image");
let submitImageButton = document.getElementById('submit-image-button');
editButton.addEventListener('click', function(){
    submitButton.style.display = 'inline-block';
    changeImageBtn.style.display = 'inline-block';
    editButton.style.display = 'none';
    for (let i = 0; i < inputElements.length; i++){
        let input = inputElements[i];
        input.readOnly = false;
    }
})

changePassword.addEventListener('click', function(){ 
    containerEditProfile.style.display = 'none';

});

changeImageBtn.addEventListener("click", function () {
    imageUpload.click(); 
    changeImageBtn.style.display = 'none';
    submitImageButton.style.display = 'inline-block';
});

imageUpload.addEventListener("change", function () {
    const file = imageUpload.files[0]; 
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profileImage.src = e.target.result; 
        };
        reader.readAsDataURL(file);
    }
});
