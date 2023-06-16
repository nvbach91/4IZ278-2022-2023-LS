$(document).ready(function() {
    var accountsButton = document.querySelector('.user-accounts');

    accountsButton.addEventListener('click', function(e) {
        e.preventDefault();
        displayUsers();
    });

    function displayUsers() {

        $.ajax({
            type: 'GET',
            url: 'users.php',
            success: function(response) {
                var productsContainer = document.querySelector('main');
                productsContainer.innerHTML = response;
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }
});
