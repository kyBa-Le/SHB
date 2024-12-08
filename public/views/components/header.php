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
        <img id="header-logo" src="./images/logo.png">
        <div class="header-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">MEN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">WOMEN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">KIDS & BABY</a>
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
        <a href="">Log In</a>
        <span>/</span>
        <a href="">Sign Up</a>
    </div>
</div>
