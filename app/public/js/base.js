bodyLoading = document.getElementById("body_loading");
const app = document.getElementById("app");
const mainApp = document.getElementById("main-app");
const headerApp = document.getElementById("header-app");

addEventListener("load", () => {

    mainApp.style.setProperty("margin-top", headerApp.offsetHeight + "px");
    
    app.classList.remove("hidden");

    setTimeout(() => {
        bodyLoading.remove();
        delete bodyLoading;
    }, 3000);

});

// cart
const btnsUpdateProductInCart = document.querySelectorAll(".update-product-cart");
const orderPrice = document.querySelectorAll(".order_price_value");
const nbProducts = document.querySelector(".nb_products_value");
let requestCartAllowed = true;

btnsUpdateProductInCart.forEach(btn => {

    btn.addEventListener("click", function(event) {

        event.preventDefault();

        if(requestCartAllowed) {

            requestCartAllowed = false;

            const productId = this.getAttribute("data-productid");
            const action = this.getAttribute("data-action");
            const form = new FormData();
            const product = document.getElementById(productId);

            product?.classList.add("loading");

            form.append("productId", productId);
            form.append("action", action);

            fetch("/mon-panier/ajout-produit-panier", {method: "POST", body: form})
                .then(res => res.json())
                .then(res => {

                    requestCartAllowed = true;
                    product?.classList.remove("loading");

                    if (!res.ok) {
                        return;
                    }

                    orderPrice.forEach(el => el.innerHTML = res.orderPrice);

                    if (!location.pathname.startsWith("/mon-panier")) {
                        return;
                    }

                    nbProducts.innerHTML = res.nbProducts;

                    if(res.productQuantity <= 0) {

                        product.remove();

                    } else {

                        const productQuantity = product.querySelector(".product_card-quantity_value");
                        const productPrice = product.querySelector(".product_card-price");

                        if(productQuantity) {
                            productQuantity.innerText = res.productQuantity;
                        }
                        if(productPrice) {
                            productPrice.innerText = res.productPrice;
                        }

                    }

                });

            }

    });

});

const productImagesList = document.querySelectorAll(".product_card-images_list .product_card-image img");

productImagesList.forEach(image => {

    image.addEventListener("click", () => {

        const imageSelected = image.parentElement.parentElement.parentElement.querySelector(".product_card-image--selected");

        imageSelected.setAttribute("src", image.getAttribute("src"));
        image.parentElement.parentElement.querySelector(".product_card-image.selected").classList.remove("selected");
        image.parentElement.classList.add("selected");

    });

});
