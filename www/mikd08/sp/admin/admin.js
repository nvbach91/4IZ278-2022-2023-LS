import { diplayErrors, noTokenErr } from "../funcs.js";

let xhr = new XMLHttpRequest();

let overlays = document.querySelectorAll(".overlay");
let addCategoryOverlayStyle = document.querySelector("#addCategory").style;
let addProductOverlayStyle = document.querySelector("#addProduct").style;
let editProductOverlayStyle = document.querySelector("#editProduct").style;
let bodyOverflowStyle = document.querySelector("body").style;

window.addEventListener("scroll", () => {
   overlays.forEach((overlay) => {
      overlay.style.top = window.pageYOffset + "px";
   });
});

overlays.forEach((overlay) =>
   overlay.addEventListener("click", (e) => {
      if (e.target.className == "overlay") {
         addCategoryOverlayStyle.display = "none";
         addProductOverlayStyle.display = "none";
         editProductOverlayStyle.display = "none";
         bodyOverflowStyle.overflow = "auto";
      }
   })
);
document.querySelector("#addCategory-btn").addEventListener("click", () => {
   addCategoryOverlayStyle.display = "flex";
   bodyOverflowStyle.overflow = "hidden";
});
document.querySelector("#addProduct-btn").addEventListener("click", () => {
   addProductOverlayStyle.display = "flex";
   bodyOverflowStyle.overflow = "hidden";
});

document.querySelectorAll(".editProduct-btn").forEach((editProductBtn) => {
   editProductBtn.addEventListener("click", (e) => {
      // xhr.open("GET", "editProduct.php?edit=" + editProductBtn.getAttribute("name"), true);
      // xhr.send();

      // xhr.onload = () => {
      //     if(xhr.status == 200){
      //         console.log(xhr.response);
      //         let product = JSON.parse(xhr.responseText);
      //         document.querySelector("#editProductForm input[name='product_id']").value = product.product_id;
      //         document.querySelector("#editProductForm input[name='name']").value = product.name;
      //         document.querySelector("#editProductForm input[name='price']").value = product.price;
      //         document.querySelector("#editProductForm textarea[name='img']").textContent = product.img;
      //         document.querySelector("#editProductForm input[name='category']").value = product.category_name;
      //     }
      // }

      // editProductOverlayStyle.display = "flex";
      // bodyOverflowStyle.overflow = "hidden";

      fetch("/www/mikd08/sp/admin/editProduct.php?edit=" + editProductBtn.getAttribute("name"))
         .then((res) => {
            if (res.ok) {
               return res.json();
            } else {
               throw Error("Refresh and try again");
            }
         })
         .then((data) => {
            document.querySelector("#editProductForm input[name='product_id']").value = data.product_id;
            document.querySelector("#editProductForm input[name='name']").value = data.name;
            document.querySelector("#editProductForm input[name='price']").value = data.price;
            document.querySelector("#editProductForm img").src = data.img;
            document.querySelector("#editProductForm textarea[name='img']").textContent = data.img;
            document.querySelector("#editProductForm input[name='category']").value = data.category_name;
            editProductOverlayStyle.display = "flex";
            bodyOverflowStyle.overflow = "hidden";
         })
         .catch((err) => {
            document
               .querySelector("nav")
               .insertAdjacentHTML("afterend", `<p style='color:red; font-size: 1.6em;'>${err}</p>`);
         });
   });
});

document.querySelector("#editProductForm").addEventListener("submit", (e) => {
   e.preventDefault();

   xhr.open("POST", "/www/mikd08/sp/admin/editProduct.php", true);
   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhr.send(
      `product_id=${document.querySelector("#editProductForm input[name='product_id']").value}&name=${
         document.querySelector("#editProductForm input[name='name']").value
      }&price=${document.querySelector("#editProductForm input[name='price']").value}&img=${encodeURIComponent(
         document.querySelector("#editProductForm textarea[name='img']").value
      )}&category=${document.querySelector("#editProductForm input[name='category']").value}&token=${
         document.querySelector("#editProductForm input[name='token']").value
      }`
   );

   xhr.onload = () => {
      if (xhr.status == 200) {
         location.replace("/www/mikd08/sp/index.php");
      } else if (xhr.status == 400) {
         let errors = JSON.parse(xhr.response);
         diplayErrors("#editProductForm p", "#editProductForm", errors);
      }
   };
});

document.querySelector("#addCategoryForm").addEventListener("submit", (e) => {
   e.preventDefault();
   xhr.open("POST", "/www/mikd08/sp/admin/addCategory.php", true);
   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhr.send(
      "category_name=" +
         document.querySelector("#addCategoryForm input[name='category_name']").value +
         "&token=" +
         document.querySelector("#addCategoryForm input[name='token']").value
   );

   xhr.onload = () => {
      if (xhr.status == 200) {
         location.replace("/www/mikd08/sp/index.php");
      } else if (xhr.status == 400) {
         diplayErrors("#addCategoryForm p", "#addCategoryForm", xhr.responseText);
      }
   };

   //     fetch("addCategory.php", {
   //         method: "POST",
   //         body: JSON.stringify({
   //             category_name : document.querySelector("#addCategoryForm input[name='category_name']").value
   //         }),
   //         headers: {
   //             "Content-Type": "application/x-www-form-urlencoded"
   //         }
   //     }).then(response => {
   //         console.log(response.formData());
   //         console.log(response);
   //     })
   //     .then(data => console.log(data))
   //     .catch(err => console.log(err));
});

document.querySelector("#addProductForm").addEventListener("submit", (e) => {
   e.preventDefault();
   xhr.open("POST", "/www/mikd08/sp/admin/addProduct.php", true);
   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   xhr.send(
      `name=${document.querySelector("#addProductForm input[name='name']").value}&price=${
         document.querySelector("#addProductForm input[name='price']").value
      }&img=${document.querySelector("#addProductForm input[name='img']").value}&category=${
         document.querySelector("#addProductForm input[name='category']").value
      }&token=${document.querySelector("#addProductForm input[name='token']").value}`
   );

   xhr.onload = () => {
      if (xhr.status == 200) {
         location.replace("/www/mikd08/sp/index.php");
      } else if (xhr.status == 400) {
         let errors = JSON.parse(xhr.response);
         diplayErrors("#addProductForm p", "#addProductForm", errors);
      }
   };
});
