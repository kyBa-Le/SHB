let editButton = document.getElementById('edit-profile-button');
let submitButton = document.getElementById('edit-profile-submit');
let inputElements = document.getElementsByClassName('edit-profile-input');
let changePassword = document.getElementById('click-change-password');
let containerEditProfile = document.querySelector('.container-edit-profile');
editButton.addEventListener('click', function(){
    submitButton.style.display = 'inline-block';
    editButton.style.display = 'none';
    for (let i = 0; i < inputElements.length; i++){
        let input = inputElements[i];
        input.readOnly = false;
    }
})

changePassword.addEventListener('click', function(){ 
    containerEditProfile.style.display = 'none';

});