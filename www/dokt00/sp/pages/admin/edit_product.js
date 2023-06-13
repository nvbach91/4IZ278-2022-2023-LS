$(document).ready(function () {
    $('.editable').on('blur', function () {
        var productID = $(this).data('product-id');
        var column = $(this).data('column');
        var value = $(this).text();

        $.ajax({
            url: 'edit_product.php',
            method: 'POST',
            data: {
                product_id: productID,
                column: column,
                value: value
            },
            success: function (data) {
                console.log(data);
            }
        });
    });
});
