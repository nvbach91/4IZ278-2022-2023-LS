<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forms</title>
</head>
<style>

form {
    text-align: center;
    font-size: 1.1em;
}

input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.inputSection {
    margin-top: 10px;
}

#avatar {
    width: 300px;
    margin: auto;
    font-size: 1.2em;
}
#imgContainer {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border: dotted black 2px;
    border-radius: 50%;
    text-align: center;
    display: grid;
    justify-items: center;
    align-items: center;
    overflow: hidden;
}

img {
    width: 100px;
    object-fit: cover;
}

input, #genderSelection {
    padding: 10px;
    border-radius: 5px;
    width: 50%;
    height: 40px;
    border: solid 2px black;
    box-sizing: border-box;
}

h2 {
    margin: 20px auto;
    background-color: greenyellow;
    width: fit-content;
}

button {
    background-color: rgba(0, 0, 196, 0.712);
    padding: 10px;
    border-radius: 5px;
    color: white;
    font-weight: 600;
}
</style>
<body>
    <?php include "registrationForm.php"?>
</body>
</html>