<?php 
    function totalPrice($cart) {
        $total = 0;
        foreach ($cart as $data) {
            $total += $data['price'] * $data["amount"];
        }
        return $total;
    };    

    function checkToken($sentToken, $redirect, $async = false) {
        if ($sentToken != $_SESSION["token"]) {
            header("Location: ".$redirect);
            $_SESSION["error"] = "Error: Invalid token";
            die;
        }
    }
    function checkTokenAsync($sentToken) {
        if ($sentToken != $_SESSION["token"]) {
            http_response_code(400);
            die(json_encode("Error: Invalid token"));
        }

    }
?>