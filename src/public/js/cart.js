document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartCountElement = document.getElementById('cart-count');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    updateCartCount();

    function addToCart(event) {
        // ... existing addToCart function ...

        updateCartCount();
    }

    function updateCartCount() {
        const cart = getCartFromCookie();
        let totalItems = 0;

        cart.forEach(item => {
            totalItems += item.quantity;
        });

        cartCountElement.textContent = totalItems;
    }

    // ... other functions ...
});
