<header class="bg-dark py-5">
    <div class="container-carousel">
        <div class="carousel my-carousel carousel--translate">
            <input class="carousel__activator" type="radio" name="carousel" id="F" checked="checked" />
            <input class="carousel__activator" type="radio" name="carousel" id="G" />
            <div class="carousel__controls">
                <label class="carousel__control carousel__control--backward" for="J"></label>
                <label class="carousel__control carousel__control--forward" for="G"></label>
            </div>
            <div class="carousel__controls">
                <label class="carousel__control carousel__control--backward" for="F"></label>
                <label class="carousel__control carousel__control--forward" for="H"></label>
            </div>
            <div class="carousel__controls">
                <label class="carousel__control carousel__control--backward" for="G"></label>
                <label class="carousel__control carousel__control--forward" for="I"></label>
            </div>
            <div class="carousel__controls">
                <label class="carousel__control carousel__control--backward" for="H"></label>
                <label class="carousel__control carousel__control--forward" for="J"></label>
            </div>
            <div class="carousel__controls">
                <label class="carousel__control carousel__control--backward" for="I"></label>
                <label class="carousel__control carousel__control--forward" for="F"></label>
            </div>
            <div class="carousel__track">
                <?php foreach($withDiscount as $good): ?>
                <li class="carousel__slide">
                    <h1><?php echo $good['name']; ?></h1>
                </li>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>
</header>