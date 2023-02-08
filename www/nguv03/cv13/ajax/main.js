$(document).ready(() => {
    $.post({
        url: './users',
        dataType: 'json',
    }).done((resp) => {
        const users = resp.map((user) => $(`<li class="user">${user.name}: ${user.age}</li>`));
        $('#users').empty().append(users);
    });
});