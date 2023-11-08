const radioInputs = document.querySelectorAll("input[type='radio']");
const deliveryChoiceHomeValue = document.getElementById("delivery-choice-home-value");
const orderPriceHTValue = document.getElementById("order-price-ht-value");
const orderPriceTTCValue = document.getElementById("order-price-ttc-value");

const formatPrice = price => {

    const formatEuro = new Intl.NumberFormat("fr-FR", {style: 'currency', currency: 'EUR'});

    return formatEuro.format(price);

}

radioInputs.forEach(radio => {

    radio.addEventListener("change", function() {

        if(this.id === "delivery-choice-home") {

            const newOrderPriceHT = orderPriceHT + shippingCost;

            orderPriceHTValue.innerHTML = formatPrice(newOrderPriceHT);
            orderPriceTTCValue.innerHTML = formatPrice((newOrderPriceHT) + (newOrderPriceHT * tax / 100));
            deliveryChoiceHomeValue.hidden = false;

        } else {

            orderPriceHTValue.innerHTML = formatPrice(orderPriceHT);
            orderPriceTTCValue.innerHTML = formatPrice(orderPriceHT + (orderPriceHT * tax / 100));
            deliveryChoiceHomeValue.hidden = true;

        }

    });

});
