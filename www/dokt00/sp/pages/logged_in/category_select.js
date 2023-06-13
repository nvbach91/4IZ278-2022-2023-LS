$(document).ready(function() {
    $(".tea-category").click(function(e) {
        e.preventDefault();

        var category = $(this).text();

        $.ajax({
            type: 'POST',
            url: 'category_select.php',
            data: {
                category: category
            },
            success: function(response) {
                $('main').html(response);
            }
        });
    });
});
