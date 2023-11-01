// header
const app = document.getElementById("app");
const mainApp = document.getElementById("main-app");
const headerApp = document.getElementById("header-app");

addEventListener("load", () => {

    mainApp.style.setProperty("margin-top", headerApp.offsetHeight + "px");
    
    app.classList.remove("hidden");

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

            const productId = this.getAttribute("data-product-id");
            const action = this.getAttribute("data-action");
            const form = new FormData();

            form.append("productId", productId);
            form.append("action", action);

            fetch("/mon-panier/ajout-produit-panier", {method: "POST", body: form})
            .then(res => res.json())
            .then(res => {

                requestCartAllowed = true;

                if(res.ok) {

                    const product = document.getElementById(productId);

                    if(res.productQty === 0 && action !== "add") {

                        product.remove();

                    } else if(product) {

                        const productQty = product.querySelector(".product_card-quantity_value");
                        const productPrice = product.querySelector(".product_card-price");

                        productQty.innerText = res.productQty;
                        productPrice.innerText = res.productPrice;

                    }
                    if(nbProducts) {
                        nbProducts.innerHTML = res.nbProducts;
                    }
                    orderPrice.forEach(el => el.innerHTML = res.orderPrice);

                }

            });

        }

    });

});
