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
        width: 5%;
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
        font-size: 1.75vw;
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
</style>
<div class="container-fluid p-0" id="container-header">
    <div class="header-content">
        <img id="header-logo" src="images/logo.png" onclick="{window.location.href='/'}">
        <div class="header-nav">
            <ul class="nav">
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
                if(isset($_SESSION['user'])) {
                    echo '<div class="header-profile">
                            <i class="fa-solid fa-circle-user"></i>
                          </div>
                          <div class="header-cart" onclick="{window.location.href=\'/cart\'}">
                            <i class="fa-solid fa-cart-shopping"></i>
                          </div>';
                }else {
                    echo '<a href="/login">Log In</a>
                            <span>/</span>
                          <a href="/sign-up">Sign Up</a>';
                }
            ?>
        </div>
    </div>
</div>
