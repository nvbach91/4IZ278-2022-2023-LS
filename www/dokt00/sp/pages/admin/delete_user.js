$(document).on('click', '.delete-user', function () {
    var userID = $(this).data('user-id');

    var confirmed = confirm("Are you sure you want to delete this user?");
    if (!confirmed) {
        return;
    }

    $.ajax({
        url: 'delete_user.php',
        method: 'POST',
        data: {
            user_id: userID
        },
        success: function (data) {
            console.log(data);
            var userBox = document.querySelector(`.user-box[data-user-id='${userID}']`);
            if (userBox) {
                userBox.remove();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});