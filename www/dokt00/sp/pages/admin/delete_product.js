$(document).on('click', '.delete-product', function(e) {
    e.preventDefault();

    var product_id = $(this).data('product-id');

    $.ajax({
        url: 'delete_product.php',
        method: 'POST',
        data: {
            product_id: product_id
        },
        success: function (data) {
            $('div[data-product-id="' + product_id + '"]').remove();
        }
    });
});