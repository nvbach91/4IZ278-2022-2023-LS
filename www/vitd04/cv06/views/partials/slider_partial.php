<?php

namespace Views\Partials;

require_once __DIR__ . '/../../repositories/slides_repository.php';
use Repositories\SlidesRepository;

class SliderPartial
{
    public static function render()
    {
        $slidesRepository = new SlidesRepository();
        $slides = $slidesRepository->fetchAll();
        ?>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="background-color: black">
            <div class="carousel-inner">
                <?php
                foreach ($slides as $key => $value) {
                    ?>
                    <div class="carousel-item <?php if ($key == 0) {
                        echo 'active';
                    } ?>">
                        <img class="d-block h-100" style="max-height: 300px" src="<?php echo $value['image'] ?>"
                            alt="<?php echo $value['title'] ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>
                                <?php echo $value['title'] ?>
                            </h5>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <?php
    }
}
?>