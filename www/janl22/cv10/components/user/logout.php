<?php

$htmlTitle = 'HW Shop | Logout';

unset($_SESSION['cart']);
unsetCustomCookie('access_token');
unsetCustomCookie('id_token');