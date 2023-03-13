<div id="back">
    <?php
    foreach ($newPeople as $people) {
        $isStudying = 'Studying at '.$people->student;
        if ($people->student == "No"){
            $isStudying = 'Not a student';
        }
        $work = "YES";
        if (!$people->doINeedWork){
            $work = "NO";
        }

        echo '<div class="card">
    <img src="' .$people->image.'" alt="Profile picture">
    <div class="leftSide">
        <h2 class="nameSur">'. $people->getFullName().'</h2>
        <p class="student">'.$people->profession.'</p>
        <ul class="underLeftSide">
            <li>'. $people->getAge().' years old</li>
            <li>'.$people->city.'</li>
            <li>'.$people->mail.'</li>
        </ul>
    </div>
    <div class="rightSide">
        '.$people->phone.'<br>
        '.$isStudying.'<br>
        '. $people->getFullStreet().'<br>
        '.$people->webUrl.'<br>
        Looking for work: '.$work.'<br>
    </div>


</div>';
    }
    include_once "html/oldHTMLstuff.html";
    ?>


</div>
