<?php require __DIR__ . '/vendor/autoload.php' ?>

<?php 


use \Facebook\Facebook;
use \Facebook\Exceptions\FacebookResponseException;



// http://localhost/cv11b/fb-login-callback.php?
// code=AQDnH8FiuFGSWoArG-BEs7Pi0FUTt5HElTH3pEIlP3cdaJq5FC7ah02E5HPcLVDymGs5SvnUPPOXG-muJ_iYTbiwoPk-TwUX63OsN92EdmqBKnXpiEZ11xQJDleMfGLBo6gAtS_pXmyf-Qdzx2vRYmvrfmCxSrBol6gcAS4gXepxSAC_5lYBRlUUxoraPB9CW-fg8g-Au70YX_QxLqLX2GnMOXFjiQbMIx-Wt7IVbLbGz-x_Acl1pcM56XkDiC4SgnZ0M4w5M5hsrnEyQ10FkUWSiWyXPGyehj29UwI_cZo3SfWUT13jQ8H6rRRDKR56FyqRVdQkJA3xhQyb3ic3NKDkwgttmb0WPD2UjuEnlw0xeqbvn97j3hEgod0EZgmbOk8PLMa0JZsfNKK1eCkElDTI
// &state=e1d7fbe0ea1cd180338da2b3019c808a#_=_

if (!empty($_GET) && isset($_GET['code'])) {

    $code = $_GET['code'];


    $fb = new Facebook([
        'app_id' => '7702675183075984',
        'app_secret' => '6cf2bf121fb5a5660fe9282bf783a7bc',
        'default-graph_version' => 'v2.10',
    ]);



    $helper = $fb->getRedirectLoginHelper();

    $helper->getPersistentDataHandler()->set('state', $_GET['state']);

    try {
        $accessToken = $helper->getAccessToken();
    } catch (FacebookResponseException $e) {
        exit;
    }

    if ($accessToken->getValue()) {
        session_start();
        $_SESSION['fb_access_token'] = $accessToken->getValue();
        header('Location: profile.php');
    }
}

?>
