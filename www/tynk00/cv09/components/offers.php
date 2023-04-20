<?php




?>

<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
        <h3 class="card-title">Produkty <?php if (isset($_GET['category_id']))  echo " / " . $categoriesDatabase->getCategoryName($_GET['category_id']) ?></h3>
    </div>
    <div class="card-body text-dark">
        <div class="row">
            <div class="col-lg-1 col-sm-4">
                <label class="col-form-label">Řazení: </label>
            </div>
            <div class="col-lg-2 col-sm-4">
                <select class="form-select" id="orderedAtt" aria-label="Default select example" disabled>
                    <option value="name" selected>Podle názvu</option>
                    <option value="price">Podle ceny</option>
                </select>
            </div>
        </div>


        <div class="row m-4">

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                </ul>
            </nav>

            <?php require_once('pagination.php') ?>

            <?php if (!empty($products)) : ?>

                <?php foreach ($products as $product) : ?>
                    <?php include('productCard.php') ?>
                <?php endforeach; ?>

                
            <?php else : ?>
                <div class="text-center">
                    <img class="w-25 mb-3" src="<?php img('error.png')?>" alt="" srcset="">
                    <h3>Žádné produkty :/</h3>
                </div>


            <?php endif ?>
        </div>
        <?php echo paginate($page, $total_pages); ?>
    </div>

</div>