$(document).ready(function () {
    $("#login-form").on("submit", function (event) {
      event.preventDefault();
  
      $.ajax({
        url: "login.php",
        method: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function (data) {
          if (data.success) {
            if (data.isAdmin) {  
              window.location.href = "pages/admin/index.php";
            } else {
              window.location.href = "pages/logged_in/logged_in.php";
            }
          } else {
            $("#login-error").text("Incorrect username or password").show();
            $('input[name="password"]').css("border", "1px solid red");
          }
        },
      });
    });
  });
  