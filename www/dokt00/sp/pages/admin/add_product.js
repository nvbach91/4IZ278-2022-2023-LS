$(document).ready(function () {
    var formAdded = false;
    $('.add-product').on('click', function () {
        if (formAdded) { 
            return; 
        }

        var form = $('<form class="product-form" method="POST"></form>');
        form.append('<input type="text" name="name" placeholder="Product Name" required>');
        form.append('<input type="text" name="description" placeholder="Product Description" required>');
        form.append('<input type="number" name="price" placeholder="Product Price" required>');
        form.append('<input type="number" name="stock" placeholder="Product Stock" required>');
        form.append('<input type="text" name="image_url" placeholder="Product Image URL" required>');
        form.append('<input type="number" name="category_id" placeholder="Product Category ID" required>');
        form.append('<button type="submit">Create Product</button>');

        $(this).append(form);
        formAdded = true;
    });

    $(document).on('submit', '.product-form', function(e) {
        e.preventDefault();

        var name = $(this).find('input[name="name"]').val();
        var description = $(this).find('input[name="description"]').val();
        var price = $(this).find('input[name="price"]').val();
        var stock = $(this).find('input[name="stock"]').val();
        var image_url = $(this).find('input[name="image_url"]').val();
        var category_id = $(this).find('input[name="category_id"]').val();


        $.ajax({
            url: 'add_product.php',
            method: 'POST',
            data: {
                name: name,
                description: description,
                price: price,
                stock: stock,
                image_url: image_url,
                category_id: category_id
            },
            success: function (data) {
                var productDiv = $('<div class="product"></div>');
                productDiv.append('<img src="../../' + image_url + '" alt="' + name + '">');
                productDiv.append('<h3>' + name + '</h3>');
                productDiv.append('<p>' + description + '</p>');
                productDiv.append('<p>' + price + ' Kč</p>');
                productDiv.append('<p>' + stock + ' Ks</p>');
                productDiv.append('<p>' + image_url + '</p>');
            
                $('section.products').last().append(productDiv);
            
                $('.product-form input').val('');
            }
            
        });
    });
});
