<!-- oprávnění pro 1+ -->

<?php 
require_once './db/db.php';
require 'authorization.php';

$limit = 4;

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

$query = "SELECT COUNT(*) AS count FROM cv09_goods";
$count = $pdo->prepare($query);
$count->execute();

$recordCount = $count->fetchAll()[0]['count'];
$paginationCount = ceil($recordCount / $limit);

$query2 = "SELECT * FROM cv09_goods  ORDER BY good_id LIMIT $limit OFFSET ?;";
$statement = $pdo->prepare($query2);
$statement->bindParam(1, $offset, PDO::PARAM_INT);
$statement->execute();
$products = $statement->fetchAll();

?>

<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Products</h2>
            <div class="flex flex-row justify-between">
                <a class="bg-amber-50 mt-4 rounded-xl text-gray-700 dark:text-white text-xl p-5 m-5 dark:bg-gray-900" href="create-item.php">Create New Product</a>
                <a class="bg-amber-50 mt-4 rounded-xl text-gray-700 dark:text-white text-xl p-5 m-5 dark:bg-gray-900" href="users.php">Users</a>
            </div>

            <div class="text-center mt-4 text-gray-700 dark:text-white text-xl p-5 m-5 gap-1">
                <?php for($i = 0; $i < $paginationCount; $i++) {?>
                    <a class="p-0.5" href="<?php echo './index.php?limit='.$limit.'&offset=' . $i * 4; ?>"><?php echo $i + 1?></a>
                <?php } ?>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <!-- product -->
                <?php include './app/ProductDisplayIndex.php' ?>
            </div>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>