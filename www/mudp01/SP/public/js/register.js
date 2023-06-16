/* Error display */
const error = $('#register-error').val();
const errorDiv = $('<div>');
errorDiv.attr('class', 'register-errorMessageDiv');
const errorMessage = $('<label>');
errorMessage.attr('class', 'register-errorMessage');
errorDiv.append(errorMessage);

const emailInput = $('#register-emailInput');
const passwordInput1 = $('#register-passwordInput1');
const passwordInput2 = $('#register-passwordInput2');
const firstName = $('#register-firstNameInput');
const lastName = $('#register-lastNameInput');

function displayError(inputElement){
    $(inputElement).css('border', '2px #ff3333 inset');
}

if(error=='used email'){
    errorMessage.text('This email is already used.');
    displayError(emailInput);
}
if(error=='invalid email'){
    errorMessage.text('Please enter valid email.');
    displayError(emailInput);
}
if(error=='unmatching password'){
    errorMessage.text('Passwords do not match.');
    displayError(passwordInput1);
    displayError(passwordInput2);
}
if(error=='inserting error'){
    errorMessage.text('An error occurred while creating new user, please try it later.');
}
if(error=='invalid password'){
    errorMessage.text('Please enter valid password (8-16 characters and atlest 1 uppercase letter, 1 lowercase letter and 1 number).');
    displayError(passwordInput1);
    displayError(passwordInput2);
}
if(error=='unfilled name'){
    errorMessage.text('Please enter your whole name.');
    displayError(firstName);
    displayError(lastName);
}

if(errorMessage.text()!=''){
    $('body').append(errorDiv);
}