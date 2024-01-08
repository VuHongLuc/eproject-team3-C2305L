const priceProduct = document.getElementById('price-product');
const quantityInput = document.getElementById('quantityInput');
const totalPriceDisplay = document.getElementById('total-price');

function updateTotalPrice() {
    const price = parseFloat(priceProduct.textContent);
    const quantity = parseInt(quantityInput.value);

    const totalPrice = price * quantity;
    totalPriceDisplay.textContent = '$' + totalPrice.toFixed(2);
}

document.getElementById('incrementBtn').addEventListener('click', function() {
    quantityInput.value = parseInt(quantityInput.value) + 1;
    updateTotalPrice();
});

document.getElementById('decrementBtn').addEventListener('click', function() {
    const currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        updateTotalPrice();
    }
});

quantityInput.addEventListener('change', function() {
    updateTotalPrice();
});

updateTotalPrice();