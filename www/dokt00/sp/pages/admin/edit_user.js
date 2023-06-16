$(document).ready(function() {
    $('.editable').on('blur', function () {
        var userID = $(this).data('user-id');
        var column = $(this).data('column');
        var value = $(this).text();
    
        console.log(userID, column, value);
    
        $.ajax({
            url: 'edit_user.php',
            method: 'POST',
            data: {
                user_id: userID,
                column: column,
                value: value
            },
            success: function (data) {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); 
            }
        });
    });
});
