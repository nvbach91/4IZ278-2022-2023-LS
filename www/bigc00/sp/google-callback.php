<?php 

    if (!isset($_SESSION)) {
	session_start();
}

require_once 'vendor/autoload.php';
require_once 'db.php';

$client = new Google_Client();

$client->setClientId('291292520234-d0upuk3en3uottgtufojqtbcirqrlt7j.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://esotemp.vse.cz/~bigc00/sp/google-callback.php');
$client->addScope('email');
$client->addScope('profile');
$client->addScope('phone');

if (isset($_GET['code'])) {
    try {
        $client->fetchAccessTokenWithAuthCode($_GET['code']);

        $token = $client->getAccessToken();
        $id_token = $client->verifyIdToken($token['id_token']);

        $name = $id_token['name'];
        $email = $id_token['email'];
        $phone = isset($id_token['phone_number']) ? $id_token['phone_number'] : null;

      
        $_SESSION['username'] = $email;
        $_SESSION['userData']['name'] = $name;
        $_SESSION['userData']['phoneNumber'] = $phone;
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
            // Insert user data into the database
            $insertQuery = "INSERT INTO users (`name`, email, phoneNumber) VALUES ('$name', '$email', '$phone')";
            mysqli_query($connection, $insertQuery); // Execute the insert query
        }
        
        header('Location: profile.php');
        exit;
    } catch (Exception $e) {
        echo 'Error exchanging authorization code: ' . $e->getMessage();
        exit;
    }
}
?>
