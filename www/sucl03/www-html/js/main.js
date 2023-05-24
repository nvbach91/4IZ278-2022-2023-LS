// crossmile @ LXSX file:www-html/js/main.js

var tr_warning;

var app_acl = {
	login: 1,
	register: 2,
	admin: 4,
	users_r: 8,
	users_w: 16,
	races_r: 32,
	races_w: 64,
	registrations_r: 128,
	registrations_w: 256
}

// universal confirmation
function confirmAction(msg)
{
	let message = 'Jste si jistí?';
	if (msg)
		message += '\n' + msg;
	if (confirm(message) === true)
		return (true);
	return (false);
}

// create cookie
function createCookie(name, value, days)
{
	let expires;
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = '; expires=' + date.toGMTString();
	} else
		expires = '';
	document.cookie = encodeURIComponent('crossmile_' + name) + '=' + encodeURIComponent(value) + expires + ';' + ' SameSite=None; Secure';
}

// read cookie
function readCookie(name)
{
	const name_eq = encodeURIComponent('crossmile_' + name) + '=';
	let ca = document.cookie.split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) === ' ')
			c = c.substring(1, c.length);
		if (c.indexOf(name_eq) === 0)
			return (decodeURIComponent(c.substring(name_eq.length, c.length)));
	}
	return (null);
}

// race management
function fillRaceForm(target, type)
{
	target.disabled = true;
	document.querySelector('#race_id').value = target.getAttribute('data-id');
	document.querySelector('#race_name').value = target.getAttribute('data-name');
	document.querySelector('#race_date').value = target.getAttribute('data-date');
}

// unregister
function unregisterUser(el, e)
{
	e.preventDefault();
	e.target.disabled = true;
	if (!confirmAction('Opravdu se chcete odhlásit?')) {
		e.target.disabled = false;
		return (false);
	}
	document.querySelector('#user_id').value = el.getAttribute('data-user');
	document.querySelector('#reg_id').value = el.getAttribute('data-reg');
	document.querySelector('#reg_type').value = 'unregister';
	document.querySelector('#register-form').requestSubmit();
}

// load registrations list
async function loadRegistrationsList()
{
	const payload = {
		'race': document.querySelector('#race').value,
		'discipline': document.querySelector('#discipline').value,
		'search': document.querySelector('#search').value
	};
	let data = new URLSearchParams(payload);
	let response_text;
	const response = await fetch('/registrations-list', { method: 'POST', cache: 'no-cache', body: data });
	if (!response.ok) {
		console.log(response);
		response_text = "Objevila se chyba. Zkuste to za cvhíli znovu";
	} else
		response_text = await response.text();
	document.querySelector('#registrations-list-output').innerHTML = response_text;
	document.querySelectorAll('.unregister').forEach((el) => el.addEventListener('click', (e) => {
		unregisterUser(el, e);
	}));
	document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
		new bootstrap.Popover(el);
	});
}

// load users list
async function loadUsersList()
{
	const payload = {
		'gender': document.querySelector('#gender_search').value,
		'year': document.querySelector('#year_search').value,
		'search': document.querySelector('#text_search').value
	};
	const data = new URLSearchParams(payload);
	let response_text;
	const response = await fetch('/users-list', { method: 'POST', cache: 'no-cache', body: data });
	if (!response.ok) {
		console.log(response);
		response_text = "Objevila se chyba. Zkuste to za cvhíli znovu";
	} else
		response_text = await response.text();
	document.querySelector('#users-list-output').innerHTML = response_text;
	// edit user
	document.querySelectorAll('.edit-user').forEach((el) => el.addEventListener('click', async (e) => {
		e.preventDefault();
		tr_warning = el.closest('tr');
		tr_warning.classList.add('table-warning');
		await loadUser(el.getAttribute('data-user'));
		const modal = new bootstrap.Modal(document.querySelector('#modal-user-admin'), {});
		modal.show();
	}));
	// delete user
	document.querySelectorAll('.delete-user').forEach((el) => el.addEventListener('click', async (e) => {
		e.preventDefault();
		el.disabled = true;
		if (!confirmAction('Opravdu chcete uživatele smazat?')) {
			e.target.disabled = false;
			return (false);
		}
		document.querySelector('#user_form').value = 'delete';
		document.querySelector('#user_id').value = el.getAttribute('data-user');
		document.querySelector('#user-form').submit();
	}));
	
	document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
		new bootstrap.Popover(el);
	});
}

// load user data
async function loadUser(id)
{
	const payload = {
		'id': id
	};
	let response_json
	const data = new URLSearchParams(payload);
	const response = await fetch('/user-get', { method: 'POST', cache: 'no-cache', body: data });
	if (!response.ok) {
		console.log(response);
		let response_text = await response.text();
		alert(response_text);
		//response_text = "Objevila se chyba. Zkuste to za cvhíli znovu";
	} else
		response_json = await response.json();
	if (response_json) {
		document.querySelector('#user_form').value = 'save';
		document.querySelector('#user_id').value = response_json.id;
		document.querySelector('#email').value = response_json.email;
		document.querySelector('#last_name').value = response_json.last_name;
		document.querySelector('#first_name').value = response_json.first_name;
		document.querySelector('#password').value = response_json.password;
		document.querySelector('#confirm_password').value = response_json.password;
		document.querySelector('#gender').value = response_json.gender;
		document.querySelector('#birthday').value = response_json.birthday;
		document.querySelector('#club').value = response_json.club;
		
		for (const key of Object.keys(app_acl)) {
			if (app_acl[key] & response_json.acl)
				document.querySelector("#acl_" + key).checked = true;
			else
				document.querySelector("#acl_" + key).checked = false;
		}
	}
}

// toggle old races
const old_races_toggle = document.querySelector('#old-races-toggle');
if (old_races_toggle) {
	old_races_toggle.addEventListener('click', (e) => {
		createCookie('show_old_races', old_races_toggle.getAttribute('data-id'));
		if (window.history.replaceState)
			window.history.replaceState(null, null, window.location.href);
		window.location = window.location.href;
	});
}

// show duplicate race modal
document.querySelectorAll('.race-duplicate').forEach((el) => el.addEventListener('click', (e) => {
	e.preventDefault();
	fillRaceForm(e.target, 'duplicate');
	const modal = new bootstrap.Modal(document.querySelector('#modal-races'), {});
	modal.show();
	e.target.disabled = false;
}));

// delete race
document.querySelectorAll('.race-delete').forEach((el) => el.addEventListener('click', (e) => {
	e.preventDefault();
	fillRaceForm(e.target, 'delete');
	if (!confirmAction('Opravdu chcete závod smazat?')) {
		e.target.disabled = false;
		return (false);
	}
	document.querySelector('#race-form').requestSubmit();
}));

// register to discipline
document.querySelectorAll('.register').forEach((el) => el.addEventListener('click', (e) => {
	e.preventDefault();
	e.target.disabled = true;
	document.querySelector('#user_id').value = el.getAttribute('data-user');
	document.querySelector('#reg_id').value = el.getAttribute('data-reg');
	document.querySelector('#reg_type').value = 'register';
	const modal = new bootstrap.Modal(document.querySelector('#modal-register'), {});
	modal.show();
	e.target.disabled = false;
}));

// unregister from discipline
document.querySelectorAll('.unregister').forEach((el) => el.addEventListener('click', (e) => {
	unregisterUser(el, e);
}));

// filter registrations
// input on change list submit
document.querySelectorAll('.registrations-input-change').forEach((el) => el.addEventListener('input', (e) => {
	e.preventDefault();
	document.querySelector('#registrations-filter-form').requestSubmit();
}));
// select on change list submit
document.querySelectorAll('.registrations-select-change').forEach((el) => el.addEventListener('change', (e) => {
	e.preventDefault();
	document.querySelector('#registrations-filter-form').requestSubmit();
}));

const registrations_filter_form = document.querySelector('#registrations-filter-form');
if (registrations_filter_form) {
	loadRegistrationsList();
	registrations_filter_form.addEventListener('submit', async (e) => {
		e.preventDefault();
		await loadRegistrationsList();
	});
}

// users
const users_filter_form = document.querySelector('#users-filter-form');
if (users_filter_form) {
	loadUsersList();
	users_filter_form.addEventListener('submit', async (e) => {
		e.preventDefault();
		await loadUsersList();
	});
}
document.querySelectorAll('.users-input-change').forEach((el) => el.addEventListener('input', (e) => {
	e.preventDefault();
	document.querySelector('#users-filter-form').requestSubmit();
}));
// select on change list submit
document.querySelectorAll('.users-select-change').forEach((el) => el.addEventListener('change', (e) => {
	e.preventDefault();
	document.querySelector('#users-filter-form').requestSubmit();
}));

const modal_user = document.querySelector('#modal-user-admin');
if (modal_user) {
	modal_user.addEventListener('hidden.bs.modal', () => {
		tr_warning.classList.remove('table-warning');
	});

	// user form submit
	document.querySelector('#user-form').addEventListener('submit', async (e) => {
		e.preventDefault();
		let acl = 0;
		for (const key of Object.keys(app_acl)) {
			if (document.querySelector("#acl_" + key).checked === true)
				acl += parseInt(app_acl[key]);
		}
		const acl_input = document.createElement('input');
		acl_input.setAttribute('type', 'hidden');
		acl_input.setAttribute('id', 'acl');
		acl_input.setAttribute('name', 'acl');
		acl_input.setAttribute('value', acl);
		document.querySelector('#user-form').appendChild(acl_input);
		document.querySelector('#user-form').submit();
	});
}

// password toggler
const passwd_toggle = document.querySelector('#passwd-toggle');
if (passwd_toggle) {
	passwd_toggle.addEventListener('click', (e) => {
		const passwd = document.querySelector('#password');
		if (passwd.type == 'password') {
			passwd.type = 'text';
			passwd_toggle.innerHTML = '<i class="far fa-eye-slash"></i>';
		} else {
			passwd.type = 'password';
			passwd_toggle.innerHTML = '<i class="far fa-eye"></i>';
		}
	});
}

// profile OAuth2 pairing confirmation
document.querySelectorAll('.oauth2-pairing').forEach((el) => el.addEventListener('click', (e) => {
	if (!confirmAction('')) {
		e.preventDefault();
		return (false);
	} else
		return (true);
}));

// show logins
const show_logins = document.querySelector('#show-logins');
if (show_logins) {
	show_logins.addEventListener('click', async (e) => {
		e.preventDefault();
		const response = await fetch('/logins-list?id=' + e.target.getAttribute('data-id') +
			'&logins=' + e.target.getAttribute('data-type'), { method: 'GET', cache: 'no-cache' });
		if (!response.ok) {
			let err_msg = '';
			console.log(response.status);
			if (response.status == 401 || response.status == 403) {
				window.location.href = '/';
			} else if (response.status > 499 && response.status < 600) {
				err_msg = 'Server error ' + response.status;
				alert(err_msg);
			} else  {
				err_msg = 'Unknown error ' + response.status;
				alert(err_msg);
			}
		} else {
			const logins_ok = await response.json();
			document.querySelector('#modal-logins-table-body').innerHTML = logins_ok.output;
			document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
				new bootstrap.Popover(el);
			});
			const modal = new bootstrap.Modal(document.querySelector('#modal-logins'), {});
			modal.show();
		}
	});
}

// popovers
document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
	new bootstrap.Popover(el);
});

// back to top
const back_to_top_button = document.querySelector('#back-to-top');
if (back_to_top_button) {
	const scroll_container = () => {
		return (document.documentElement || document.body);
	};
	const go_to_top = () => {
		document.body.scrollIntoView({
			behavior: 'smooth'
		});
	};
	document.addEventListener('scroll', () => {
		if (scroll_container().scrollTop > 100)
			back_to_top_button.classList.remove('d-none');
		else
			back_to_top_button.classList.add('d-none');
	});
	back_to_top_button.addEventListener('click', go_to_top);
	const tooltip = new bootstrap.Tooltip(back_to_top_button);
}