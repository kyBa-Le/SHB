// Handle display dropdown profile after click
let userIcon = document.getElementById('header-profile-icon');
let profileContent = document.getElementById('profile-content');
let countClick = 0;
userIcon.addEventListener('click', function() {
    countClick += 1;
    if (countClick % 2 == 1) {
        profileContent.style.display = 'block';
    }else {
        profileContent.style.display = 'none';
    }
})
//
