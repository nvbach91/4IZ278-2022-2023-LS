<?php foreach($people as $person):?>
        <div class="front card-side">
        <img src="<?php echo $person->pic ?>" alt="profPic">
        <div>
            <h1 class="name"><?php echo $person->getFullName()?></h1>
            <div class="age info"><span class="material-symbols-outlined">cake</span><span><?php echo $person->calcAge() ?></span></div>
            <div class="city info"><span class="material-symbols-outlined">home</span><span><?php echo $person->city ?></span></div>
            <div class="phone info"><span class="material-symbols-outlined">call</span><span><?php echo $person->phone ?></span></div>
        </div>

    </div>
    <div class="back card-side">
        <img src="<?php echo $backPic ?>" alt="">
        <div>github.com/<?php echo $person->getFullName()?></div>
    </div>
    <?php endforeach?>