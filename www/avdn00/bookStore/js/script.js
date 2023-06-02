let userBox = document.querySelector(".header .header-2 .user-box");

document.querySelector("#user-button").onclick = () => {
  userBox.classList.toggle("active");
};

let filter = document.querySelector("#filter");
let heading = document.querySelector(".dynamic-header h3");
let wrapper = document.querySelector(".product_wrapper");

if (filter) {
  console.log("Filter element found.");

  filter.addEventListener("change", function () {
    console.log("Change event triggered.");
    let genreName = this.value;
    heading.innerHTML = this.options[this.selectedIndex].text;

    let http = new XMLHttpRequest();

    http.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        console.log(this.responseText);
        let response = JSON.parse(this.responseText);

        let out = "";
        for (let item of response) {
          out += `
            <form action="" method="post" class="box">
              <img src="../uploaded_img/${item.image}">
              <div class="name">${item.name}</div>
              <div class="author">${item.author}</div>
              <div class="genre">${item.genre}</div>
              <div class="price">$${item.price}/-</div>
              <input type="number" min="1" name="product_quantity" value="1" class="quantity">
              <input type="hidden" name="product_name" value="${item.name}">
              <input type="hidden" name="product_author" value="${item.author}">
              <input type="hidden" name="product_price" value="${item.price}">
              <input type="hidden" name="product_image" value="${item.image}">
              <input type="submit" value="add to cart" name="add_to_cart" class="button">
            </form>
          `;
        }
        wrapper.innerHTML = out;
      }
    };

    http.open("POST", "../customer_php/script.php", true);
    http.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    http.send("genre=" + genreName);
  });
} else {
  console.log("Filter element not found.");
}
