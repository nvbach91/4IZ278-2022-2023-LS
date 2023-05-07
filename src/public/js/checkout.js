// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

function validateAndSubmit() {
  const form = document.querySelector(".needs-validation");
  const cartItemCount = parseInt('{{ \App\Http\Controllers\CartController::cartItemCount() }}');

  if (cartItemCount > 0) {
    if (form.checkValidity()) {
      form.submit();
    } else {
      form.classList.add("was-validated");
    }
  } else {
    alert("Your cart is empty. Please add items to your cart before proceeding to checkout.");
  }
}
