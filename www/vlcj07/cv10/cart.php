<!-- oprávnění pro 1+ -->

<?php 
require './db/db.php';
require 'authorization.php';
$ids = @$_SESSION['cart'];
$products = [];

if(is_array($ids) && count($ids)){
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    
    $statement = $pdo->prepare("SELECT * FROM cv09_goods WHERE good_id IN ($question_marks) ORDER BY name");
    $statement->execute(array_values($ids));
    $products = $statement->fetchAll();
    
    
    $statement_sum = $pdo->prepare("SELECT SUM(price) FROM cv09_goods WHERE good_id IN ($question_marks)");
    $statement_sum->execute(array_values($ids));
    $sum = $statement_sum->fetchColumn();
}
?>
<?php include './app/header.php';?>

<main class="max-w-4xl mx-auto">
    <section id="cart" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <?php if (isset($_SESSION['user_id'])) : ?>
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white"><?php echo $_SESSION['user_email']?>'s Cart</h2>
            <?php else : ?>
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Your Cart</h2>  
            <?php endif; ?>

            <?php if(@$products): ?>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <!-- product -->
                <?php include './app/ProductDisplayCart.php' ?>
            </div>
            <?php else: ?>
                <h5>Nothing to see here :(</h5>
            <?php endif; ?>   
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>