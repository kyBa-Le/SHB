<style>
    .category-product-card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
        max-width: 100%;
        padding:2vh 2vw;
        box-sizing: border-box;
        background-color: white;
        > * {
            margin-bottom: 5px;
        }
    }
    .product-add-cart-and-order {
        button {
            width: 48%;
            padding: 5px 0;
        }
        button:hover {
            background-color: #0F0E0E;
            color: white;
        }
    }
    .category-product-name {
        min-height: 3em;
        max-height: 3em;
        overflow: clip;
        cursor: pointer;
    }
    .category-product-card .product-image {
        width: 100%;
        aspect-ratio: 0.9;
        background-position: 50% 20%;
        background-size: cover;
        cursor: pointer;
    }
    @media (max-width: 1100px) {
        .product-price-and-sold {
            flex-direction: column;
            align-items: start !important;
        }
        .product-price-and-sold * {
            margin: 0;
        }
    }
</style>
<?php
foreach ($products as $product) {
    $id = $product['id'];
    $image_link = $product['image_link'];
    $name = $product['product_name'];
    $price = $product['price'];
    $sale_price = 1.2 * (int)$price;
    $purchases = $product['purchases'];
    echo "
                 <div class='category-product-card'>
                    <div class='product-image' style='background-image: url($image_link)' onclick=\"{window.location.href='/detailed-product?product-id=$id'}\"></div>
                    <div class='product-contents'>
                        <p class='fw-bold fs-5 category-product-name' onclick=\"{window.location.href='/detailed-product?product-id=$id'}\">$name</p>
                        <div class='product-price-and-sold d-flex justify-content-between align-items-center mb-2'>
                            <div>
                                <p class='m-0'><span class='money'>$price</span> vnd</p>
                                <p class='text-decoration-line-through m-0 fst-italic'><span class='money'>$sale_price</span> vnd</p>
                            </div>
                            <p class='text-end'>Sold: $purchases</p>
                        </div>
                        <div class='product-add-cart-and-order d-flex justify-content-between align-items-center w-100'>
                            <button>Add to cart</button>
                            <button>Order</button>
                        </div>
                    </div>
                </div>
            ";
}
?>
