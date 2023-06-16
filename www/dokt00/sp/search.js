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
        dataType: 'json',
        success: function(products) {
            var productsContainer = document.querySelector('main');
            productsContainer.innerHTML = ''; 

            products.forEach(function(product) {
                var productDiv = document.createElement('div');
                productDiv.className = 'product';

                var img = document.createElement('img');
                img.src = product['image_url'];
                img.alt = product['name'];
                productDiv.appendChild(img);

                var h3 = document.createElement('h3');
                h3.textContent = product['name'];
                productDiv.appendChild(h3);

                var p = document.createElement('p');
                p.textContent = '$' + product['price'];
                productDiv.appendChild(p);

                var form = document.createElement('form');
                form.method = 'POST';

                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'product_id';
                hiddenInput.value = product['product_id'];
                form.appendChild(hiddenInput);

                var button = document.createElement('button');
                button.className = 'add-to-cart';
                button.type = 'submit';
                button.textContent = 'Add to Cart';
                form.appendChild(button);

                productDiv.appendChild(form);

                productsContainer.appendChild(productDiv);
            });
        }
    });
}
