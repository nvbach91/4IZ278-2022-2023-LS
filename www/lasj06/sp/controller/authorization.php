<?php

function authorize($level)
{
    if (@$_SESSION['account_level'] < $level || @$_SESSION['account_level'] < 0 || @$_SESSION['account_level'] > 3) {
        header('HTTP/1.1 401 Unauthorized');
        echo $level;
        echo $_SESSION['account_level']; 
        exit('Invalid login');
    } else {
        return true;
    }
}
