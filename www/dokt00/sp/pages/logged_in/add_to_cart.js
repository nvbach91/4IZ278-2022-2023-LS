$(document).ready(function () {
  $(".add-to-cart").click(function () {
    var button = $(this);
    var productId = button.data("product-id"); 
    $.ajax({
      url: "add_to_cart.php", 
      type: "post", 
      data: { product_id: productId },
      success: function (response) {
        var data = JSON.parse(response);
        if (data.success) {
          button.css("background-color", "green"); 
          button.text("Added to Cart"); 
        } else {
          alert(data.message); 
        }
      },
    });
  });
});
