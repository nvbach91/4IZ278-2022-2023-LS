var searchButton = document.querySelector('.search-button');
var searchInput = document.querySelector('.input-search');

searchButton.addEventListener('click', function(e) {
    e.preventDefault();
    var searchText = searchInput.value;

    $.ajax({
        type: 'POST',
        url: 'search.php',
        data: {
            query: searchText
        },
        success: function(response) {
            var productsContainer = document.querySelector('main');
            productsContainer.innerHTML = response;
        }
    });
});