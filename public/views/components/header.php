<?php ?>
<style>
    #container-header {
        background-color: #0F0E0E;
        box-sizing: border-box;
        padding: 1vh 2vw;
    }

    .header-content {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px;
    }

    #header-logo {
        width: 10vh;
        cursor: pointer;
    }

    .nav {
        display: flex;
        justify-content: space-around;
        align-items: center;
        gap: 100px;
        list-style-type: none;
    }

    .nav-item a, .logIn-signUp a, .logIn-signUp span {
        color: white;
        text-decoration: none;
    }

    .nav-item a:hover, .logIn-signUp a:hover {
        color: white; 
    }

    .logIn-signUp {
        width: 15vw;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        color: white;
    }
    .logIn-signUp i {
        font-size: 30px;
    }
    .nav-item a:focus{
        color: white; 
    }

    .search-header {
        border-radius: 20px;
        background-color: white;
        border: none;
    }

    .search-header #search-focus {
        border: none;
        border-radius: 20px;
    }

    .search-header button:focus, .search-header #search-focus:focus {
        outline: none;
        box-shadow: none; 
    }
    /* Profile */
    .header-profile {
        position: relative;
    }
    .profile-content {
        position: absolute;
        display: none;
        background-color: white;
        width: 300px;
        height: auto;
        box-sizing: border-box;
        padding: 20px 0px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        color: #0F0E0E;
        right: 12%;
        top: 150%;
    }
    .infor-profile {
        padding: 0px 20px 0px 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid lightgray;
    }
    .username-profile {
        margin: 0px;
        font-size: 18px;
        font-weight: bold;
    }
    .image-profile {
        background-position: center;
        background-size: cover;
        width: 3vw;
        height: 3vw;
        border-radius: 50%;
    }
    .profile-icon {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0px 20px 0px 20px;
        cursor: pointer;
    }
    .profile-icon i, .profile-icon p {
        font-size: 18px;
        margin: 10px 0px;
    }
    .profile-icon:hover {
        background-color: lightgray;
    }
    .edit-profile-left, .infor-profile {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    #responsive-header-dropdown-icon {
        display: none;
    }
    /*Responsive CSS for header*/
    @media (max-width: 1160px) {
        .image-profile {
            width: 3rem;
            height: 3rem;
        }
        .header-content {
            justify-content: space-between;
        }
        .logIn-signUp {
            width: 30vw;
        }
        .search-header {
            width: 30%;
        }
        * {
            font-size: small;
        }
        .header-nav .nav{
            width: 30vw;
            display: none;
            position: absolute;
            top: 11vh;
            right: 0;
            flex-direction: column;
            justify-content: center;
            gap: 2vh;
            background-color: #0F0E0E;
            margin: 0;
            padding: 0;
            li {
                width: 100%;
            }
        }
        .header-nav .nav li:hover {
            background-color: #F0F0F0;
            a {
                color: #0F0E0E;
            }
        }
        #responsive-header-dropdown-icon {
            font-size: 30px;
            color: white;
            display: inline;
        }
        .profile-content {
            width: 250px;
        }
    }
</style>
<div class="container-fluid p-0" id="container-header">
    <div class="header-content">
        <img id="header-logo" src="images/logo.png" onclick="{window.location.href='/'}">
        <div class="header-nav">
            <ul class="nav" id="header-navigation">
                <li class="nav-item">
                    <a class="nav-link active" href="/">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/men">MEN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/women">WOMEN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/children">CHILDREN</a>
                </li>
            </ul>
        </div>
        <div class="search-header d-flex">
            <input id="search-focus" type="search" class="form-control" placeholder="Search"/> 
            <button type="button" class="btn" data-mdb-ripple-init>
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="logIn-signUp">
        <?php
            if ($authentication === true) {
                $avatar_link = $_SESSION['user']['avatar_link'] ?? 'images/avatarDefault.png';
                echo '<div class="header-profile">
                        <i class="fa-solid fa-circle-user" id="header-profile-icon" style="cursor: pointer;"></i>
                        <div class="profile-content" id="profile-content">
                            <div class="infor-profile">
                                <div class="image-profile" style="background-image: url(\'' . $avatar_link . '\');"></div>
                                <p class="username-profile">' . $_SESSION["user"]["username"] . '</p>
                            </div>
                            <div class="edit-profile profile-icon" onclick="window.location.href=\'/user/edit\'">
                                <div class="edit-profile-left">
                                    <i class="fa-solid fa-circle-user"></i>
                                    <p>Edit profile</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                            <div class="logout-profile profile-icon" onclick="window.location.href=\'/logout\'">
                                <div class="edit-profile-left">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <p>Logout</p>
                                </div>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="header-cart" onclick="window.location.href=\'/cart\'">
                        <i class="fa-solid fa-cart-shopping" style="cursor: pointer;"></i>
                    </div>';
            } else {
                echo '<a href="/login">Log In</a>
                    <span>/</span>
                    <a href="/sign-up">Sign Up</a>';
            }
            ?>
        </div>
        <i class="fa-solid fa-bars" id="responsive-header-dropdown-icon"></i>
    </div>
</div>
<script type="module" src="js/header.js"></script>
