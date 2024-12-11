<style>
    #container-signUpSuccess {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #F0F0F0;
    }
    .signUpSuccess-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        width: 30vw;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
    }
    .image {
        width: 20vw;
    }
    .text-signUpSuccess {
        color:green;
        font-weight:bold;
    }
    .signUpSuccess-button {
        width: 100%;
        margin-top: 16px;
        display: flex;
        justify-content: space-around;
    }
    .nav-button {
        border: none;
        width: 10vw;
        height: 5vh;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        background-color: #0F0E0E;
    }
</style>
<div id="container-signUpSuccess">
    <div class="signUpSuccess-content">
        <img class="image" src="images/successTick.gif" alt="">
        <p class="text-signUpSuccess">Sign up successfully</p>
        <div class="signUpSuccess-button">
            <button class="nav-button" id="nav-home" onclick="{window.location.href='/'}">Home</button>
            <button class="nav-button" id="nav-logIn" onclick="{window.location.href='/login'}">Log in</button>
        </div>
    </div>
</div>