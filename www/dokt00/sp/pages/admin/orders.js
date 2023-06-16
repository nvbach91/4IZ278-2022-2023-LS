$(document).ready(function() {
    var ordersButton = document.querySelector('.orders-button');

    ordersButton.addEventListener('click', function(e) {
        e.preventDefault();
        displayOrders();
    });

    function displayOrders() {

        $.ajax({
            type: 'GET',
            url: 'orders.php',
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
