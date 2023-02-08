<?php

/**
 * Přetěžování metod nebo operátoru nám umožňuje nadefinovat jednu metodu, která
 * se chová podle toho, jaké parametry/kolik parametrů do ni předáme
 * 
 * v PHP nemáme klasické přetěžování jako v C++ nebo Java, ale můžeme použít trik
 * tj. funkce, která vrátí pole argumentů
 */
class Mathe {
    public function getSum() {
        $args = func_get_args();
        if (empty($args)) {
            return 0;
        }
        $sum = 0;
        foreach ($args as $arg) {
            $sum += $arg;
        }
        return $sum;
    }
}

$s = new Mathe();
echo $s->getSum(), PHP_EOL;
echo $s->getSum(5), PHP_EOL;
echo $s->getSum(3, 4), PHP_EOL;
echo $s->getSum(3, 4, 7), PHP_EOL;

?>