<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <?php foreach($people as $person): ?>
                <button class="btn btn-outline-success me-2" type="button" onclick="changePerson(<?php echo $person->id ?>)"><?php echo $person->getFullName() ?></button>
            <?php endforeach; ?>
        </div>
    </nav>


    <?php foreach ($people as $person): ?>

        <div id="person<?php echo $person->id ?>">

            <div class="bis-card" id="<?php echo $person->id ?>-1" style="display: block; background-image: url('<?php echo $person->style ?>');">
                <div id="bis-card-content">

                    <div class="row">
                        <div class="col-3">
                            <img id="avatar" src="<?php echo $person->avatar ?>" alt="iiiiiii" srcset="">

                        </div>
                        <div class="col-9" style="border-left: 5px #ffffff solid">
                            <h1><?php echo $person->getFullName() ?></h1>
                            <h5><?php echo $person->position ?> společnosti <?php echo $person->company ?></h5>
                            <ul>
                                <li>Věk: <?php echo $person->getAge() ?></li>
                                <li>Email: <?php echo $person->email ?></li>
                                <li>Telefonní číslo: <?php echo $person->telNumber ?></li>
                                <li>Adresa: <?php echo $person->getAddress() ?></li>
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
            <div class="bis-card" id="<?php echo $person->id ?>-2" style="display: none; background-image: url('<?php echo $person->style ?>');">
                <div id="bis-card-content">
                    <div class="row">
                        <div class="col-12">
                            <img id="logo" src="<?php echo $person->logo ?>" alt="aa" srcset="">
                            <h3 style="text-align: center"><?php echo $person->company ?></h3>
                            <h6 style="padding-top: 10px; text-align: center">
                                <?php echo $person->website ?>
                            </h6>
                            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                                <img id="qr-code" src="https://i.pinimg.com/736x/60/c1/4a/60c14a43fb4745795b3b358868517e79.jpg" alt="aa" srcset="">
                            </a>

                        </div>
                    </div>

                </div>
            </div>

            <button type="button" class="btn btn-light" style="margin: auto; display: block; margin-top: 50px" onclick="turn<?php echo $person->id ?>()">Otočit vizitku</button>
        </div>
    <?php endforeach; ?>