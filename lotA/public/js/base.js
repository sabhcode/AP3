// header
const headerApp = document.getElementById("header-app");
const mainApp = document.getElementById("main-app");

addEventListener("load", () => {

    mainApp.style.setProperty("margin-top", headerApp.offsetHeight + "px");

});

// cart
const btnsUpdateProductInCart = document.querySelectorAll(".update-product-cart");
const nbProductsInCart = document.getElementById("nb-products-in-cart");

btnsUpdateProductInCart.forEach(btn => {

    btn.addEventListener("click", function(event) {

        event.preventDefault();

        const productUuid = this.getAttribute("data-productUuid");
        const action = this.getAttribute("data-action");
        const form = new FormData();

        form.append("productUuid", productUuid);
        form.append("action", action);

        fetch("/ajout-produit-panier", {method: "POST", body: form})
        .then(res => res.json())
        .then(res => {

            if(res.ok) {

                nbProductsInCart.innerText = res.qty;

            }

        });

    });

});
