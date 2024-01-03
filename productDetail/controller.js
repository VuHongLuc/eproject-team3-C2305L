// Button tăng giảm số lượng
     document.addEventListener('DOMContentLoaded', function() {
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const quantityInput = document.getElementById('quantityInput');

            decrementBtn.addEventListener('click', function() {
                decreaseQuantity();
            });

            incrementBtn.addEventListener('click', function() {
                increaseQuantity();
            });

            function decreaseQuantity() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                currentValue--;
                quantityInput.value = currentValue;
                }
            }

            function increaseQuantity() {
                let currentValue = parseInt(quantityInput.value);
                currentValue++;
                quantityInput.value = currentValue;
            }
        });
