$(document).ready(function () {
  $(".tea-category").click(function (e) {
    e.preventDefault();

    var category = $(this).text();

    $.ajax({
      type: "POST",
      url: "category_select.php",
      data: {
        category: category,
      },
      dataType: "json",
      success: function (products) {
        var productsContainer = document.querySelector("main");
        productsContainer.innerHTML = "";

        var productSection = document.createElement("section");
        productSection.className = "products";

        products.forEach(function (product, index) {
          var productDiv = document.createElement("div");
          productDiv.className = "product";

          var img = document.createElement("img");
          img.src = "../../" + product["image_url"];
          img.alt = product["name"];
          productDiv.appendChild(img);

          var h3 = document.createElement("h3");
          h3.textContent = product["name"];
          productDiv.appendChild(h3);

          var p = document.createElement("p");
          p.textContent = product["price"] + " Kč";
          productDiv.appendChild(p);

          var form = document.createElement("form");
          form.method = "POST";

          var hiddenInput = document.createElement("input");
          hiddenInput.type = "hidden";
          hiddenInput.name = "product_id";
          hiddenInput.value = product["product_id"];
          form.appendChild(hiddenInput);

          var button = document.createElement("button");
          button.className = "add-to-cart";
          button.type = "submit";
          button.textContent = "Add to Cart";
          form.appendChild(button);

          console.log(productDiv);
          productDiv.appendChild(form);
          productSection.appendChild(productDiv);

          if ((index + 1) % 3 == 0 && index > 0) {
            productsContainer.appendChild(productSection);
            productSection = document.createElement("section");
            productSection.className = "products";
          }
        });

        if (products.length % 3 != 0) {
          productsContainer.appendChild(productSection);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + status + ": " + error);
        console.log(products.length);
        console.log(productsContainer);
      },
    });
  });
});