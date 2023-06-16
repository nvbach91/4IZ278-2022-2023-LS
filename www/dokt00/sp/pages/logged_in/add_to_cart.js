$(document).ready(function () {
  console.log("Category select script loaded");

  $(".tea-category").on("click", function (e) {
    e.preventDefault();

    console.log("Category clicked");

    var category = $(this).text();
    var button = $(this);

    $.ajax({
      type: "POST",
      url: "category_select.php",
      data: {
        category: category,
      },
      dataType: "json",
      success: function (products) {
        console.log(products);
        button.addClass("added");
        button.text("Added to Cart");
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + status + ": " + error);
      },
    });
  });

  $("body").on("click", ".add-to-cart", function (e) {
    e.preventDefault();

    var product_id = $(this).prev("input").val();
    var button = $(this);

    $.ajax({
      type: "POST",
      url: "add_to_cart.php",
      data: {
        product_id: product_id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response.message);
        button.addClass("added");
        button.text("Added to Cart");
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + status + ": " + error);
      },
    });
  });
});
