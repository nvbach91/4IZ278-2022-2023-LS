window.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.product').forEach(product => {
        var quantity = parseInt(product.getAttribute('data-quantity'));
        if (quantity === 0) {
            product.classList.add('out-of-stock');
        }
    });
});