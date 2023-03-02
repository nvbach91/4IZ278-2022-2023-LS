<?php
function calculateAge($birthYear) {
    return date_diff(date_create($birthYear), date_create('now'))->y;
}
?>