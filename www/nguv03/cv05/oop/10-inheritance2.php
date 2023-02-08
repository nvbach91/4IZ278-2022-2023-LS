<?php
/**
 * Abstraktní třídy jsou abstraktní, proto nemůže být instancována
 * Tady máme třídu Bytost -> je příliš abstraktní a proto nemá smysl 
 * vytvořit přímou instanci. Víme jen, že to má nějaké vlastnosti a chování,
 * které jsou společné pro všechny jeho pod třídy
 */
// abstract prohibits instantiation
abstract class Being { 
    protected $isAlive = true;
    public function isAlive() {
        if ($this->isAlive) {
            echo "Being is alive", PHP_EOL;
        } else {
            echo "Being is not alive", PHP_EOL;
        }
    }
    public function exit() {
        $this->isAlive = false;
    }
}
/**
 * Zvíře je bytost, a je stále příliš abstraktní, ale už je konkrétnější než
 * bytost, zde už ale má v sobě nějaké konkrétnější věci
 */
abstract class Animal extends Being {
    protected $age;
    public function __construct($age) {
        $this->age = $age;
    }
    protected function setAge($age) {
        $this->age = $age;
    }
    public function getAge() {
        return $this->age;
    }
}
/**
 * Kočka už je dost konkrétní, A bude mít všechy public/protected metody/členské proměnné
 * ze Zvíře, protože ho extenduje, a taky z Bytosti, protože Zvíře ji extenduje
 * 
 * Nemusíme tedy u podřazených tříd opakovat věci z nadřazených tříd
 */
class Cat extends Animal {
    private $name;
    public function __construct($name, $age) {
        $this->name = $name;
        parent::__construct($age);
    }
    public function getName() {
        return $this->name;
    }
}

$cat = new Cat("Meooooow", 4);
$cat->isAlive();
echo $cat->getName() . " is " . $cat->getAge() . " years old", PHP_EOL;
$cat->exit();
$cat->isAlive();

?>