const priceProduct = document.querySelectorAll('.price-product');
const quantityInput = document.querySelectorAll('.quantityInput');
const totalPriceDisplay = document.querySelectorAll('.total-price');
const btnIncre = document.querySelectorAll('.incrementBtn');
const btnDecre = document.querySelectorAll('.decrementBtn');
const totalCart = document.getElementById('totalCart');


function updateTotalPrice(index) {
    const price = parseFloat(priceProduct[index].textContent);
    const quantity = parseInt(quantityInput[index].value);
    const totalPrice = price * quantity;
    totalPriceDisplay[index].textContent = "$" + totalPrice.toFixed(2);
}

for (let i = 0; i < btnIncre.length; i++) {
    btnIncre[i].addEventListener('click', function() {
        quantityInput[i].value = parseInt(quantityInput[i].value) + 1;  
        updateTotalPrice(i);
        updateTotalCart()
    })
};

for (let i = 0; i < btnDecre.length; i++) {
    btnDecre[i].addEventListener('click', function() {
        if(quantityInput[i].value >1)
        quantityInput[i].value = parseInt(quantityInput[i].value) - 1;  
        updateTotalPrice(i);
        updateTotalCart()
    })
};
function updateTotalCart() {
    let sum = 0;
    for (let i = 0; i < totalPriceDisplay.length; i++) {
        sum += parseFloat(totalPriceDisplay[i].textContent.replace("$", ""));
    }
    totalCart.textContent = "$" + sum.toFixed(2);
}
for (let i = 0; i < totalPriceDisplay.length; i++) {
    updateTotalPrice(i);
    updateTotalCart()
}

// Xử lý : xư lý tổng tiền khi sản phảm được add to cart
//          Nếu chưa có sản phẩm trong giỏ hàng thì hiển thị No Item in cart
//          cử lý lỗi bị trùng sản phẩm 
//         thêm button Check out và xem Thêm, khi click button check out thì insert tất cả vào trong bảng order.
//          Làm giao diện check out

