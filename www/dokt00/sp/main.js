const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

if (error) {
    let errorMessage = '';
    if (error === 'user_not_found') {
        errorMessage = 'Username not found. Please try again or register.';
    } else if (error === 'incorrect_password') {
        errorMessage = 'Incorrect password. Please try again.';
    }
    alert(errorMessage);
}

var modal = document.getElementById('register-modal');

var span = document.getElementsByClassName('close')[0];

function openModal() {
    modal.style.display = 'block';
}

span.onclick = function () {
    modal.style.display = 'none';
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function registerUser() {
    $.ajax({
        type: 'POST',
        url: 'register.php',
        data: $('#register-form').serialize(),
        success: function(response) {
            if (response.trim() === 'success') {
                document.getElementById("register-modal").style.display = "none";
                document.getElementById("register-form").reset();

                alert('Registration successful');
            } else {
                alert('Registration failed: ' + response);
            }
        }
    });
}

document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();
    registerUser();
});
