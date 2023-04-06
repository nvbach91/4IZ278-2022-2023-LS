<?php
session_start();

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \JanuSoftware\Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
try {
    $me = $fb->get('/me')->getGraphNode();
    $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphNode();
} catch(\JanuSoftware\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\JanuSoftware\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="mangomaniac, mango, mango, mango">
    <meta name="author" content="Nguyen Viet Bach">
    <title>Mango Shop | Mangomaniac Inc.</title>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/mango-fruit-vitamin-healthy-summer-food-31184.png">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        body { padding-top:30px; }
        .glyphicon { margin-bottom: 10px; margin-right: 10px; }
        small { display: block; line-height: 1.428571429; color: #999; }
    </style>
</head>

<body>
    <header></header>
    <pre><?php var_dump($me); ?></pre>
    <pre><?php var_dump($picture); ?></pre>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <img src="<?php echo $picture->getField('url'); ?>" alt="" class="img-rounded img-responsive" />
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <h4><?php echo $me->getField('name'); ?></h4>
                            <small>
                                <cite title="San Francisco, USA">San Francisco, USA <i class="glyphicon glyphicon-map-marker"></i></cite>
                            </small>
                            <p>
                                <i class="glyphicon glyphicon-envelope"></i>
                                email@example.com
                                <br>
                                <i class="glyphicon glyphicon-globe"></i>
                                <a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                                <br>
                                <i class="glyphicon glyphicon-gift"></i>
                                June 02, 1988
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>