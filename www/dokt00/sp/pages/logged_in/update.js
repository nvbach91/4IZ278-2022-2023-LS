$(document).on('change', '.quantity-input', function() {
    var productId = $(this).data('product-id');
    var newQuantity = $(this).val();

    $.post('update_cart.php', { product_id: productId, quantity: newQuantity }, function(data) {
        if (data.success) {
            $('#total-price').text('Cena celkem: ' + data.totalPrice + ' Kč');
        }
    });
});