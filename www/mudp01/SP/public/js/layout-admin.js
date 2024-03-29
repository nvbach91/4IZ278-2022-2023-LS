const account = $('#account');
const orders = $('<a>');
orders.attr('href', './myOrders/');
orders.text('My orders');
const logout = $('<a>');
logout.text('Logout');
logout.attr('href', './logout/');
const adminPanel = $('<a>');
adminPanel.attr('href', './adminPanel/');
adminPanel.text('Admin panel');


account.on('mouseenter', () => {
    const accountDiv = $('<div>');
    accountDiv.attr('id', 'account-holder')
    accountDiv.attr('class', 'account-admin-hover')
    const accountLabel = $('<label>');
    accountLabel.text('Account');
    accountDiv.append(accountLabel);
    accountDiv.append(orders);
    accountDiv.append(adminPanel);
    accountDiv.append(logout);
    accountDiv.on('mouseleave', () => {
        $('#account-holder').remove();
    });
    $('body').append(accountDiv);
});

const message = document.getElementById('message');
const main = document.querySelector('main');
try {
    setTimeout(() => { message.remove(); }, 3000);
} catch { }

