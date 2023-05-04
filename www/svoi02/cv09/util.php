<?php

function checkInputValidity($name, $price, $image, $category)
{
    $errors = [];

    if (strlen($name) == 0) {
        $message = 'Name is empty';
        array_push($errors, $message);
    }
    if (strlen($price) == 0) {
        $message = 'Price not set';
        array_push($errors, $message);
    }
    if ((float) $price < 0) {
        $message = 'Cannot enter a negative price';
        array_push($errors, $message);
    }
    if (strlen($image) == 0) {
        $message = 'Image url is empty';
        array_push($errors, $message);
    }

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        $message = 'Image url is invalid';
        array_push($errors, $message);
    }

    //preg_match validuje hopdnut pomoci regularnich vyrazu
    if (!preg_match('/^[123]$/', $category)) {
        $message = 'Invalid category';
        array_push($errors, $message);
    }

    return $errors;
}

