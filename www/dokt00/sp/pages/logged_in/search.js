var searchForm = document.querySelector('.search-form');
var searchInput = document.querySelector('.input-search');

searchForm.addEventListener('submit', function(e) {
    e.preventDefault();
    performSearch();
});

function performSearch() {
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
}
