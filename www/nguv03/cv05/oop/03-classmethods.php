<?php

class Circle {
    public $radius;
    public function setRadius($radius) {
        $this->radius = $radius;
    }
    public function area() {
        return $this->radius * $this->radius * M_PI;
    }
}

$c1 = new Circle();
$c1->setRadius(5);

echo $c1->area();

?>