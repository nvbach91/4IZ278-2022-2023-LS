const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get("error");

if (error) {
  let errorMessage = "";
  if (error === "user_not_found") {
    errorMessage = "Username not found. Please try again or register.";
  } else if (error === "incorrect_password") {
    errorMessage = "Incorrect password. Please try again.";
  }
  alert(errorMessage);
}

var modal = document.getElementById("register-modal");

var span = document.getElementsByClassName("close")[0];

function openModal() {
  modal.style.display = "block";
}

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

function registerUser() {
  $.ajax({
    type: "POST",
    url: "register.php",
    data: $("#register-form").serialize(),
    success: function (response) {
      $(".error-message").remove();

      if (response.trim() === "success") {
        document.getElementById("register-modal").style.display = "none";
        document.getElementById("register-form").reset();
        alert("Registration successful");
      } else {
        const errorMessages = response.split("<br/>");
        errorMessages.forEach(function (error) {
          let errorMessageElement = document.createElement("div");
          errorMessageElement.textContent = error;
          errorMessageElement.classList.add("error-message");
          document
            .getElementById("register-form")
            .appendChild(errorMessageElement);
        });
      }
    },
  });
}

$('#register-form').on('submit', function(e) {
    e.preventDefault();
    registerUser();
});


document
  .getElementById("register-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    registerUser();
  });

var addToCartButtons = document.querySelectorAll(".add-to-cart");
var viewCartButton = document.querySelector(".cart-button");

function showErrorMessage() {
  event.preventDefault();
  console.log("showing error message");
  var errorMessage = document.createElement("div");
  errorMessage.textContent =
    "You need to be logged in to use this functionality!";
  errorMessage.classList.add("error-message");

  document.body.appendChild(errorMessage);

  setTimeout(function () {
    document.body.removeChild(errorMessage);
  }, 3000);
}

addToCartButtons.forEach((button) =>
  button.addEventListener("click", showErrorMessage)
);
viewCartButton.addEventListener("click", showErrorMessage);

var searchButton = document.querySelector(".search-button");
var searchInput = document.querySelector(".input-search");

searchButton.addEventListener("click", function (e) {
  e.preventDefault();
  var searchText = searchInput.value;

  $.ajax({
    type: "POST",
    url: "search.php",
    data: {
      query: searchText,
    },
    success: function (response) {
      var productsContainer = document.querySelector("main");
      productsContainer.innerHTML = response;
    },
  });
});

//!TODO
// var categoryButtons = document.querySelectorAll('.category');

// categoryButtons.forEach(button => button.addEventListener('click', function(e) {
//     e.preventDefault();

//     $.ajax({
//         type: 'POST',
//         url: 'category.php',
//         data: {
//             query: button.textContent
//         },
//         success: function(response) {
//             var productsContainer = document.querySelector('main');
//             productsContainer.innerHTML = response;
//         }
//     });
// }));
