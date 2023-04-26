<?php

function getCurrentUrlWithoutOrder() {
    // Get the current URL
    $url = getCurrentUrlWithoutParams();

    // Remove the 'page' parameter from the query string
    $query_params = array();
    if (isset($_GET)) {
        foreach ($_GET as $key => $val) {
            if ($key != 'order') {
                $query_params[] = urlencode($key) . '=' . urlencode($val);
            }
        }

    }    
    // Rebuild the URL with the updated query string
    if (count($query_params) > 0) {
        $url .= '?' . implode('&', $query_params);
        $url .= '&';
    }
    else {
        $url .= '?';
    }
    
    return $url;
}


?>

<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
        <h3 class="card-title mb-0 text-center">Produkty <?php if (isset($_GET['category_id']))  echo " / " . $categoriesDatabase->getCategoryName($_GET['category_id']) ?></h3>
    </div>
    <div class="card-body text-dark">
        <form action="reorder.php" method="get">
            <div class="row mb-3">
                <input type="hidden" name="url" value="<?php echo getCurrentUrlWithoutOrder(); ?>">
                <label class="col-sm-1 col-form-label pe-0">Řazení: </label>
                <div class="col-sm-2 px-0">
                    <select class="w-100 form-select form-control" id="orderedAt" name="order" aria-label="Default select example">
                        <option value="name" selected>Podle názvu</option>
                        <option value="price">Podle ceny</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-dark" type="submit">Seřadit</button>
                </div>


            </div>

        </form>


        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">


        <div class="row m-4">

            <?php require_once('pagination.php') ?>

            <?php if (!empty($products)) : ?>

                <?php foreach ($products as $product) : ?>
                    <?php include('productCard.php') ?>
                <?php endforeach; ?>


            <?php else : ?>
                <div class="text-center">
                    <img class="w-25 mb-3" src="<?php img('error.png') ?>" alt="" srcset="">
                    <h3>Žádné produkty :/</h3>
                </div>


            <?php endif ?>
        </div>
        <?php echo paginate($page, $total_pages); ?>
    </div>

</div>