<div class="col-4">
  <div class="card mx-auto mb-5 p-0 shadow-sm" style="width: 18rem; height: 372px">
    <div class="card-img-top" style="height: 215px; overflow: hidden; width= 286px"><img class="w-100" src="<?php echo $product['image']; ?>"></div>

    <div class="card-body">
      <h4 class="card-title text-center"><?php echo $product['name']; ?></h4>
      <hr class="my-2">
      <div class="row mb-3">
        <div class="col-6 pe-0 m-0">
          <p class="card-text"><?php echo $product['price']; ?> Kč</p>
        </div>
        <div class="col-6 ps-0 m-0">
          <p class="card-text text-end" style="border-left: 1px #c7c7c7 solid; height: 22px"><?php echo $categoriesDatabase->getCategoryName($product['category']); ?></p>
        </div>
      </div>

      <div class="w-100 text-center">
      <a href="#" class="btn btn-dark mx-auto ">Přidat do košíku</a>
      </div>


    </div>
  </div>
</div>