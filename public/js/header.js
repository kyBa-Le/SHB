// Handle display dropdown profile after click
let userIcon = document.getElementById('header-profile-icon');
let profileContent = document.getElementById('profile-content');
let countClick = 0;
if (userIcon != null) {
    userIcon.addEventListener('click', function() {
        countClick += 1;
        if (countClick % 2 == 1) {
            profileContent.style.display = 'block';
        }else {
            profileContent.style.display = 'none';
        }
    })
}
//

//Responsive behavior
document.getElementById("responsive-header-dropdown-icon").addEventListener('click', function () {
    const nav = document.getElementById('header-navigation');
    if (nav.style.display !== 'flex') {
        nav.style.display = 'flex';
    }else {
        nav.style.display = 'none';
    }
});
//

