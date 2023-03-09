<?php
    require_once "./Student.php";

    $pank09 = new Student(
        "Konstantin",
        "PANKRATOV",
        "+420 736 530 403",
        new DateTime('25.08.1998'),
        "muž",
        "Slavojova 499/20, Praha 2, 12800"
    );

    $sala01 = new Student(
        "Adam",
        "SALVA",
        "+420 736 530 413",
        new DateTime('01.01.2002'),
        "muž",
        "Nám. Winstona Churchilla 1938/4, Praha 3, 12000"
    );

    $novj02 = new Student(
        "Jana",
        "NOVÁKOVÁ",
        "+420 736 530 423",
        new DateTime('15.03.2001'),
        "žena",
        "Varhulíkové 1582/24, Praha 7, 17000"
    );

    $students = [
        $pank09, 
        $sala01,
        $novj02
    ];
?>
<?php include "./head.php"; ?>

<div class="bc-list">
<?php foreach($students as $student): ?>
    <div class="bc">
        <div class="bc__header">
            <div class="logo">
                <img src="<?php echo $student->logo; ?>" alt="">
            </div>
            <div class="phone">
                <?php echo $student->phone; ?>
            </div>
        </div>
        <div class="bc__body">
            <h2><?php echo $student->getFullName(); ?></h2>
            <h4><?php echo $student->getStatus(); ?></h4>
        </div>
        <div class="bc__footer">
            <?php echo $student->address; ?>
        </div>
    </div>
<?php endforeach; ?>
</div>

<?php include "./foot.php"; ?>