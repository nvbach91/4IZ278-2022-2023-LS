/* Google login */
function loginWithToken(tokenId){
    const token = $('<input>');
    token.attr('type','password');
    token.attr('name', 'token');
    token.attr('hidden','');
    token.attr('value',tokenId);
    $('#login-form').append(token);
    $('#login-form').submit();
}

function handleCredentialResponse(response) {
    //console.log("Encoded JWT ID token: " + response.credential);
    loginWithToken(response.credential);
}
window.onload = function () {
    google.accounts.id.initialize({
        client_id: "710979517533-docr9ekb3jhfrntcus0n62okjrcvmlgm.apps.googleusercontent.com",
        callback: handleCredentialResponse,
        api_key: 'AIzaSyDTK7LhjNLed8ETlsHFAU2X_i48bBO-8GY'
    });
    google.accounts.id.renderButton(
        document.getElementById("buttonDiv"),
        { theme: "outline", size: "large" }  // customization attributes
    );
    google.accounts.id.prompt(); // also display the One Tap dialog
}

/* Error display */
const error = $('#login-error').val();
const errorDiv = $('<div>');
errorDiv.attr('class', 'register-errorMessageDiv');
const errorMessage = $('<label>');
errorMessage.attr('class', 'register-errorMessage');
errorDiv.append(errorMessage);

const emailInput = $('#login-emailInput');
const passwordInput = $('#login-passwordInput');

function displayError(status){
    if(status==1){
        $(passwordInput).css('border', '2px #ff3333 inset');
    }
    if(status==2){
        $(emailInput).css('border', '2px #ff3333 inset');
        $(passwordInput).css('border', '2px #ff3333 inset');
    }
}

if(error=='OAuth error'){
    errorMessage.text('Error occurred while logging-in with Google, please try different method.')
}

if(error=='Wrong credentials'){
    displayError(2);
    errorMessage.text('Wrong credentials inputed, try it again.');
}

if(error=='Missing input value'){
    displayError(1);
    errorMessage.text('Please fill all login fields.');
}
if(errorMessage.text()!=''){
    $('body').append(errorDiv);
}
