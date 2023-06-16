<!DOCTYPE html>
<html>

<head>
    <script src="https://connect.facebook.net/en_US/sdk.js"></script>
    <title>Facebook Login JavaScript Example</title>
    <meta charset="UTF-8">
</head>

<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '974726830618341',
                cookie: true,
                xfbml: true,
                version: 'v2.8'
            });

            //FB.AppEvents.logPageView();
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function statusChangeCallback(response) {
            if (response.status === 'connected') {
                console.log("Logged in.");
            } else {
                console.log("Not logged in");
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        function loginWithFacebook() {
            FB.login(function(response) {
                if (response.authResponse) {
                    // Get user information
                    FB.api('/me', {
                        fields: 'name'
                    }, function(userResponse) {
                        const userName = userResponse.name;
                        console.log('Logged in as: ' + userName);

                        // Create a new XMLHttpRequest object
                        const xhr = new XMLHttpRequest();

                        // Prepare the HTTP request
                        xhr.open("POST", "callback.php", true);

                        // Set the request header if you need to send additional data
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        // Define the callback function to handle the server response
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    // Request was successful, do something with the response
                                    console.log(xhr.responseText);
                                } else {
                                    // Request failed, handle the error
                                    console.error("Request failed with status: " + xhr.status);
                                }
                            }
                        };

                        // Encode the variable value to be included in the request
                        const encodedUserName = encodeURIComponent(userName);

                        // Send the request with the variable as part of the data
                        xhr.send("userName=" + encodedUserName);
                    });
                } else {
                    console.log('Facebook login failed.');
                }
            }, {
                scope: 'public_profile,email'
            });
        }
    </script>
    <div id="fb-root"></div>
    <button onclick="loginWithFacebook()">Log in with Facebook</button>

    <fb:login-button scope="public_profile,name" onlogin="checkLoginState();">
    </fb:login-button>
</body>

</html>