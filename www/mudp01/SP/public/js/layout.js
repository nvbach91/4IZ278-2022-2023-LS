const account = $('#account');
const orders = $('<a>');
orders.attr('href','/myOrders/');
orders.text('My orders');
const logout = $('<a>');
logout.text('Logout');
logout.attr('href','/logout/');

account.on('mouseenter', () =>{
const accountDiv = $('<div>');
accountDiv.attr('id','account-holder')
accountDiv.attr('class','account-hover')
const accountLabel = $('<label>');
accountLabel.text('Account');
accountDiv.append(accountLabel);
accountDiv.append(orders);
accountDiv.append(logout);
accountDiv.on('mouseleave', () => {
    $('#account-holder').remove();
});
$('body').append(accountDiv);
});

const message = document.getElementById('message');
const main = document.querySelector('main');
setTimeout(() => { message.remove(); }, 3000);

