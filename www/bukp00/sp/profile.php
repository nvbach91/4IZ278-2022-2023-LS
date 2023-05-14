<?php include './components/header.php'; ?>

<?php
session_start();

if (!isset($_SESSION['access_token'])) {
  header('Location: index.php');
  exit();
}

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \JanuSoftware\Facebook\Facebook(array_merge(FB_CONFIG, ['default_access_token' => $_SESSION['access_token']]));

try {
  $me = $fb->get('/me')->getGraphNode();
  $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphNode();
} catch (\JanuSoftware\Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (\JanuSoftware\Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
?>

<main>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include './components/footer.php'; ?>