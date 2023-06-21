<?php
function set_user_cookie($user_id) {
    setcookie('user_id', $user_id, [
        'expires' => time() + 86400, 
        'path' => '/',
        'secure' => true, 
        'httponly' => true, 
        'samesite' => 'Strict', 
    ]);
}
?>