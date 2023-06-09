let userBox = document.querySelector(".header .header-2 .user-box");

document.querySelector("#user-button").onclick = () => {
  userBox.classList.toggle("active");
};

let filter = document.querySelector("#filter");
let heading = document.querySelector(".dynamic-header h3");
let wrapper = document.querySelector(".product_wrapper");

// naslouchání události "change" na elementu filter
if (filter) {
  console.log("Filter element found.");

  filter.addEventListener("change", function () {
    console.log("Change event triggered.");
    let genreName = this.value;

    //Získává se hodnota vybraného filtru a textový obsah vybrané možnosti se nastaví do elementu heading
    heading.innerHTML = this.options[this.selectedIndex].text;

    //asynchronní požadavek na server
    let http = new XMLHttpRequest();

    //Po obdržení odpovědi od serveru
    http.onreadystatechange = function () {
      // stav požadavku 4 (dokončen) a stav odpovědi je 200 (OK).
      if (this.readyState === 4 && this.status === 200) {
        console.log(this.responseText);

        // výsledek je parsován z JSON řetězce do objektu response
        let response = JSON.parse(this.responseText);

        let out = "";

        // vytváří se HTML obsah pro každý záznam
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

        //aktualizace zobrazených dat na stránce
        wrapper.innerHTML = out;
      }
    };

    //otevírá spojení s pomocí metody POST na URL (cílový skript na serveru, ke kterému se odesílá požadavek)
    http.open("POST", "../customer_php/script.php", true);

    //data jsou kódována ve formátu URL-encodovaném.
    http.setRequestHeader("content-type", "application/x-www-form-urlencoded");

    //Odeslání požadavku na server s daty obsahujícími hodnotu vybraného filtru
    http.send("genre=" + genreName);
  });
} else {
  console.log("Filter element not found.");
}
