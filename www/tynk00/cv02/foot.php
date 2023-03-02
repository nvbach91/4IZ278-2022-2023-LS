<script>

    <?php foreach ($people as $person) : ?>
   

    var cPage<?php echo $person->id ?> = 1;
    var page<?php echo $person->id ?>1 = document.getElementById("<?php echo $person->id ?>-1");
    var page<?php echo $person->id ?>2 = document.getElementById("<?php echo $person->id ?>-2");



    function turn<?php echo $person->id ?>() {
        if (cPage<?php echo $person->id ?> == 1) {
            page<?php echo $person->id ?>1.style.display = "none";
            page<?php echo $person->id ?>2.style.display = "block";
            cPage<?php echo $person->id ?> = 2;
        } else {
            page<?php echo $person->id ?>1.style.display = "block";
            page<?php echo $person->id ?>2.style.display = "none";
            cPage<?php echo $person->id ?> = 1;
        }
    }

    <?php endforeach; ?>

    var p1 = document.getElementById("person1");
    var p2 = document.getElementById("person2");
    var p3 = document.getElementById("person3");
    p2.style.display = "none";
    p3.style.display = "none";

    function changePerson(person) {
        if (person == 1) {
            person1.style.display = "block";
            person2.style.display = "none";
            person3.style.display = "none";

        } else {
            if (person == 2) {
                person1.style.display = "none";
                person2.style.display = "block";
                person3.style.display = "none";

            }else {
                person1.style.display = "none";
                person2.style.display = "none";
                person3.style.display = "block";
            }
            
        }
    }

    
</script>


</body>


</html>