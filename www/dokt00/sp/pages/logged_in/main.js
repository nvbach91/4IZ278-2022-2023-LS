$(document).ready(function () {
  // update quantity
  $(".quantity").on("change", function () {
    var product_id = $(this).data("product-id");
    var quantity = $(this).val();

    $.ajax({
      url: "update_cart.php",
      type: "POST",
      data: {
        product_id: product_id,
        quantity: quantity,
      },
      success: function (result) {
        location.reload();
      },
    });
  });

  // delete item
  $(".delete-item").on("click", function () {
    let productId = $(this).data("product-id");
    $.ajax({
      url: "delete_from_cart.php",
      type: "POST",
      data: {
        product_id: productId,
      },
      success: function (response) {
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      },
    });
  });
});
