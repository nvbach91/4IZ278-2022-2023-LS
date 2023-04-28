<?php

$htmlTitle = 'HW Shop | Logout';

$_SESSION['cart'] = [];
unsetCustomCookie('access_token');
unsetCustomCookie('id_token');
