<?php

/**
 * Dědičnost nám umožňuje krátit redundantní kódy, tj. znova deklarovat co už bylo někde deklarováno
 * 
 * Nemusíme opisovat oběma třídám ty samé atributy, ale stačí dopsat jen to, v čem se liší. Zbytek se podědí.
 * 
 * Můžeme rozšiřovat existující komponenty o nové metody a tím je znovu využívat.
 */
class Base {
    // public members will be inherited
    public $name = "Base";
    // protected members will be inherited
    protected $id = 6124;
    // private WILL NOT be inherited
    private $is_defined = "yes"; 

}

class Derived extends Base {

    public function info() {
        echo "This is Derived class", PHP_EOL;
        echo "Members inherited: ", PHP_EOL;

        echo $this->name, PHP_EOL;
        echo $this->id, PHP_EOL;
        // $is_defined is not inherited since it is private in the base class
        //echo $this->is_defined, PHP_EOL;
    }
}

$derived = new Derived();
$derived->info();

?>