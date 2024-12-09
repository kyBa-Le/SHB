<link rel="stylesheet" href="css/home.css">
<!-- Banner -->
<div class="container-fluid p-0" id="banner-container">
    <div class="box-banner" style="background-image: url('images/home-banner.png')">
        <div class="banner-content">
            <p class="banner-title-logo">SHB</p>
            <p class="banner-slogan">Make your appearance be different</p>
        </div>
    </div>
</div>
<!-- Slogan -->
<div class="container-fluid p-0" id="slogan-container">
    <div class="box-slogan">
        <div class="slogan-content">
            <p class="slogan-text">New here?<br>Get your first- timer discount</p>
        </div>
        <div class="slogan-content">
            <p class="slogan-text">Download our app for exclusive discounts and the latest drops.</p>
        </div>
        <div class="slogan-content">
            <p class="slogan-text">Worldwide delivery</p>
        </div>
        <div class="slogan-content">
            <p class="slogan-text">Easy returns</p>
        </div>
    </div>
</div>
<!-- Top trending products -->
<div class="container-fluid p-0" id="trending-products-container">
    <h1 class="text-center mt-5 mb-5">Top Trending Products</h1>
    <div class="row justify-content-center">
    <?php  
        for ($i = 0; $i < 4; $i++) {
            $product = $outStandingProducts[$i];
            $imageLink = $product["image_link"];
            $name = $product["product_name"];
            $price = $product["price"];
            $purchases = $product["purchases"];
            echo "<div class=\"col-6 col-sm-4 col-md-3\">
                    <div class=\"product-card\" style=\"background-image: url('$imageLink');\">
                        <div class=\"product-card-overlay w-100 h-100\"></div>
                        <div class=\"product-card-hover\">
                            <h3>$name</h3>
                            <p>Purchases: $purchases</p>
                            <p style=\"color: #ED685D\">$price VNĐ</p>
                            <button onclick=\"{window.location.href='#'}\">See more <i class=\"fa-solid fa-arrow-right-long\"></i></button>
                        </div>
                    </div>
                </div>";
        }     
    ?>
    </div>
</div>
<!--Call to action -->
<div class="container-fluid p-0" id="call-to-action-container">
    <h1 class="text-center mt-5 mb-5">Explore out products</h1>
    <div class="container-fluid p-0" id="cards-container">
        <div class="call-to-action-card" style="background-image: url('https://imgcdn.stablediffusionweb.com/2024/9/15/f127ef07-3612-4a88-bdc9-fc3e5671f02a.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Women's products</h1>
                <p class="w-50">Wrap yourself in our products and become a chic, modern woman.</p>
                <button onclick="{window.location.href='/women'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
        <div class="call-to-action-card" style="background-image: url('https://d1fufvy4xao6k9.cloudfront.net/images/blog/posts/2023/09/hockerty_spanish_man_spanish_style_linen_shirt_tailored_shorts__7d3f1677_aafe_4670_b641_e50b33b89334.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Men's products</h1>
                <p class="w-50">Be the polite men by dressing on our products and have the nice experience.</p>
                <button onclick="{window.location.href='/men'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
        <div class="call-to-action-card" style="background-image: url('https://www.kkami.nl/wp-content/uploads/2024/11/Soye-Korean-Children-Fashion-Brand-kidsshorts-4560990BS13tete-large8.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Women's products</h1>
                <p class="w-50">The childhood with full of memorable moment with SHB clothes.</p>
                <button onclick="{window.location.href='/children'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
    </div>
<!--Call to action -->
<div class="container-fluid p-0" id="call-to-action-container">
    <h1 class="text-center mt-5 mb-5">Explore out products</h1>
    <div class="container-fluid p-0" id="cards-container">
        <div class="call-to-action-card" style="background-image: url('https://imgcdn.stablediffusionweb.com/2024/9/15/f127ef07-3612-4a88-bdc9-fc3e5671f02a.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Women's products</h1>
                <p class="w-50">Wrap yourself in our products and become a chic, modern woman.</p>
                <button onclick="{window.location.href='/women'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
        <div class="call-to-action-card" style="background-image: url('https://d1fufvy4xao6k9.cloudfront.net/images/blog/posts/2023/09/hockerty_spanish_man_spanish_style_linen_shirt_tailored_shorts__7d3f1677_aafe_4670_b641_e50b33b89334.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Men's products</h1>
                <p class="w-50">Be the polite men by dressing on our products and have the nice experience.</p>
                <button onclick="{window.location.href='/men'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
        <div class="call-to-action-card" style="background-image: url('https://www.kkami.nl/wp-content/uploads/2024/11/Soye-Korean-Children-Fashion-Brand-kidsshorts-4560990BS13tete-large8.jpg')">
            <div class="w-100 h-100 call-to-action-overlay"></div>
            <div class="call-to-action-hover">
                <h1>Children's products</h1>
                <p class="w-50">The childhood with full of memorable moment with SHB clothes.</p>
                <button onclick="{window.location.href='/children'}">See more <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
        </div>
    </div>
</div>