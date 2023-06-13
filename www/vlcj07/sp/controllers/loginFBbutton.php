<?php 
require_once '../vendor/autoload.php';

require '../config/fb-config.php';

$fb = new \JanuSoftware\Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/smp/controllers/loginFBController.php', $permissions);
