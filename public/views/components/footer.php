<?php ?>
<style>
    #container-footer {
        background-color: #0F0E0E;
        box-sizing: border-box;
        padding: 20px;
    }
    #container-footer * {
        color: white;
    }
    #footer-logo {
        width: 10vh;
        height: auto;
    }
    .footer-title {
        font-size: 25px;
    }
    @media (max-width: 1200px) {
        #footer-icons {
            display: none !important;
        }
    }

    @media (max-width: 600px) {
        #container-footer > .row{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        #container-footer > .row > .col > *:not(.footer-title) {
            display: none;
        }
        #container-footer > .row > .col:hover > *:not(.footer-title) {
            display: block;
            background-color: #333333;
            padding: 2px;
        }
        #container-footer > .row > .col:hover {
            .footer-title {
                background-color: white;
                color: #0F0E0E ;
                div > h4 {
                    color: #0F0E0E;
                }
            }
        }
        .footer-title {
            border-bottom: 1px solid #333333;
            padding: 5px;
            box-sizing: border-box;
        }
        #footer-icons {
            display: none !important;
        }
    }
</style>
<div class="container-fluid" id="container-footer">
    <div class="row">
        <div class="col">
            <div class="row  footer-title">
                <div class="col d-flex justify-content-start align-items-center" style="gap:5px;" onclick="{window.location.href='/'}" style="cursor: pointer">
                    <img id="footer-logo" src="images/logo.png">
                    <h4 class="fw-bold m-0">SHB STORE</h4>
                </div>
            </div>
            <div class="row">
                <p>We always appreciate and look forward to receiving</p>
                <p>all feedback from customers to be able to upgrade</p>
                <p>our service and product experience even better.</p>
            </div>
            <div class="row d-flex justify-content-around" style="max-width: 80%" id="footer-icons">
                <i class="fa-brands fa-facebook-f col text-center fs-3"></i>
                <i class="fa-brands fa-square-instagram col text-center fs-3"></i>
                <i class="fa-brands fa-twitter col text-center fs-3"></i>
                <i class="fa-brands fa-linkedin-in col text-center fs-3"></i>
            </div>
        </div>
        <div class="col">
            <p class="footer-title">About SHB Store</p>
            <p>Introduction</p>
            <p>News</p>
            <p>Store system</p>
            <p>Promotional news</p>
        </div>
        <div class="col">
            <p class="footer-title">Customer Services</p>
            <p>Loyalty policy</p>
            <p>Return policy</p>
            <p>Privacy policy</p>
            <p>Payment and delivery policy</p>
        </div>
        <div class="col">
            <p class="footer-title">Contact</p>
            <p>Contact to order</p>
            <p>0244 222 890</p>
            <p>Email</p>
            <p>shbstore@gmail.com</p>
        </div>
    </div>
</div>