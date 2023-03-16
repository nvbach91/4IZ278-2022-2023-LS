<?php
function fetchUsers(){
    $sep = ";";
    $file = "users.db";
    $array = array();
    foreach( explode( PHP_EOL, file_get_contents($file) ) as $line ){
        if( !empty($line) ){
            $array += array( explode( $sep, $line )[1] => $line );
        }
    }
    return $array;
}

function fetchUser( $email ){
    $sep = ";";
    $file = "users.db";
    foreach( explode( PHP_EOL, file_get_contents($file) ) as $line ){
        if( !empty($line) ){
            $userData = array_pad( explode( $sep, $line ), 3, "" );
            if( $email == $userData[1] ){
                return $userData;
            }
        }
    }
    return null;
}

function registerNewUser( $userData ){
    $sep = ";";
    $file = "users.db";
    $email = explode( $sep, $userData )[1];
    if( fetchUser( $email ) == null ){
        file_put_contents( $file, $userData . PHP_EOL, FILE_APPEND );
        mail( $email, "Registration", "Thank you for your registration!" );
        return TRUE;
    }
    return FALSE;
}

function authenticate( $email, $password ){
    if( !empty($email) && !empty($password) ){
        $userData = fetchUser($email);
        if( $userData == null ){
            return FALSE;
        }
        if( $userData[1] == $email && $userData[2] == $password ){
            return TRUE;
        }
    }
    return FALSE;
}
?>