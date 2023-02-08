<?php
/**
 * Polymorfismus nám umožňuje přepsat si nějakou jednu metodu u každé podtřídy tak, 
 * aby dělala, co chceme.
 * 
 * Tj. zavoláme nějakou metodu u několik podtříd a dostaneme pokaždé něco jiného, protože
 * ta metoda se chová jinak u každé z těchto podtříd.
 */
abstract class Shape {
    private $x = 0;
    private $y = 0;
    // this method will do different things based on the derived type
    public abstract function area();
}

class Rectangle extends Shape {
    // different constructor
    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
    function area() {
        return $this->x * $this->y;
    }
}

class Square extends Shape {
    // different constructor
    function __construct($x) {
        $this->x = $x;
    }
    function area() {
        return $this->x * $this->x;
    }
}

$shapes = [ 
    new Square(5), 
    new Rectangle(12, 4), 
    new Square(8) 
];

foreach ($shapes as $shape) {
    echo $shape->area(), PHP_EOL;
}

?>