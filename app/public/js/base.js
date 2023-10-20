const headerAppNavLinks = document.querySelectorAll(".header-app__nav a");
const headerAppArrow = document.getElementById("header-app__indicator-link");

const headerAppNavLink = document.querySelector(".header-app__nav a.on");

const updatePositionHeaderAppIndicator = element => {

    left = element.offsetLeft + element.offsetWidth / 2;

    headerAppArrow.style.setProperty("left", left + "px");

}

addEventListener("load", () => {

    if(headerAppNavLink) {

        updatePositionHeaderAppIndicator(headerAppNavLink);

        headerAppArrow.style.setProperty("visibility", "visible");
        headerAppArrow.style.setProperty("transition", "left .2s ease");

    }

});

headerAppNavLinks.forEach(link => {

    link.addEventListener("mouseenter", function() {
        updatePositionHeaderAppIndicator(this);
    });

    link.addEventListener("mouseleave", function() {
        updatePositionHeaderAppIndicator(headerAppNavLink);
    });

});

// Add product in cart
const btnsUpdateProductInCart = document.querySelectorAll(".update-product-cart");

btnsUpdateProductInCart.forEach(btn => {

    btn.addEventListener("click", function(event) {

        event.preventDefault();
        // console.log(this)
        const productUuid = this.getAttribute("data-productUuid");
        const action = this.getAttribute("data-action");
        // console.log(productUuid)
        const form = new FormData();

        form.append("productUuid", productUuid);
        form.append("action", action);

        // console.log(form);
        fetch("http://" + window.location.host + "/ajout-produit-panier", {method: "POST", body: form});
        // window.location.reload();    
        // est en commentaire psk si je le met ici il va appliquer ça à toutes les pages (ex: home) et va recharger la page pour rien
        // donc j'ai mis onclick="history.go(0)" dans le twig directement pour appliquer ça que à la page panier
    });

});
