<div id="back">
    <?php
    foreach ($newPeople as $people) {
        $isStudying = '<p>Studying at '.$people->student.'</p>';
        if ($people->student == "No"){
            $isStudying = '<p>Not a student</p>';
        }
        $work = "YES";
        if (!$people->doINeedWork){
            $work = "NO";
        }

        echo '<div class="vizitka">
    <img src="'.$people->image.'" alt="Profile picture">
    <div class="leftSide">
        <h2 class="nameSur">'. $people->getFullName().'</h2>
        <p class="student">'.$people->profession.'</p>
        <ul class="underLeftSide">
            <p>'.$people->phone.'</p>
            <p>'.$people->mail.'</p>
            <p>'.$people->webUrl.'</p>
        </ul>
    </div>
    <div class="rightSide">
        <p>'. $people->getAge().' years old</p>
        '.$isStudying.'
        <p>'. $people->getFullStreet().'</p>
        <p>'.$people->city.'</p>
        <p>Looking for work: '.$work.'</p>
    </div>


</div>';
    }
    include_once "oldHTMLstuff.html";
    ?>


</div>
