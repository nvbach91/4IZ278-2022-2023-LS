let accountBox = document.querySelector(".header .account-box");

document.querySelector("#user-button").onclick = () => {
  accountBox.classList.toggle("active");
};

document.querySelector("#close-update").onclick = () => {
  document.querySelector(".edit-product-form").style.display = "none";
  window.location.href = "../admin_php/admin_products.php";
};
