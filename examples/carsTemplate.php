<?php
    foreach($cars as $car) {
        echo new ExampleTemplate('singleCar.php', array('car' => $car)), "\n<hr />\n";
    }    
?>