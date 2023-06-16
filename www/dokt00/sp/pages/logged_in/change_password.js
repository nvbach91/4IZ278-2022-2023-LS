$(document).ready(function () {
    $('#change-password-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'change_password.php',
            data: $('#change-password-form').serialize(),
            success: function(response) {
                var res = JSON.parse(response);
                if (res.error) {
                    alert(res.error);
                } else {
                    alert('Password updated successfully');
                    window.location.href = 'logged_in.php'; 
                }
            }
        });
    });
});