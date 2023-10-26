// header
const headerApp = document.getElementById("header-app");
const mainApp = document.getElementById("main-app");

addEventListener("load", () => {

    mainApp.style.setProperty("margin-top", headerApp.offsetHeight + "px");

});

// cart
const btnsUpdateProductInCart = document.querySelectorAll(".update-product-cart");
const orderPrice = document.querySelectorAll(".order_price_value");
let requestCartAllowed = true;

btnsUpdateProductInCart.forEach(btn => {

    btn.addEventListener("click", function(event) {

        event.preventDefault();

        if(requestCartAllowed) {

            requestCartAllowed = false;

            const productUuid = this.getAttribute("data-productUuid");
            const action = this.getAttribute("data-action");
            const form = new FormData();

            form.append("productUuid", productUuid);
            form.append("action", action);

            fetch("/ajout-produit-panier", {method: "POST", body: form})
            .then(res => res.json())
            .then(res => {

                requestCartAllowed = true;

                if(res.ok) {

                    const product = document.getElementById(productUuid);

                    if(res.productQty === 0 && action !== "add") {

                        product.remove();

                    } else if(product) {

                        const productQty = product.querySelector(".product_card-quantity_value");
                        const productPrice = product.querySelector(".product_card-price");

                        productQty.innerText = res.productQty;
                        productPrice.innerText = res.productPrice;

                    }
                    orderPrice.forEach(el => el.innerHTML = res.orderPrice);

                }

            });

        }

    });

});
