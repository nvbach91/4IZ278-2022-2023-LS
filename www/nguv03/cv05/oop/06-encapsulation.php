<?php
/**
 * Zapouzdření umožňuje skrýt některé metody a atributy tak, aby zůstaly použitelné 
 * jen pro třídu zevnitř. Objekt si můžeme představit jako černou skřínku (anglicky 
 * blackbox), která má určité rozhraní (interface), přes které jí předáváme 
 * instrukce/data a ona je zpracovává.
 * 
 * Nevíme, jak to uvnitř funguje, ale víme, jak se navenek chová a používá. 
 * Nemůžeme tedy způsobit nějakou chybu, protože využíváme a vidíme jen to, co 
 * tvůrce třídy zpřístupnil.
 */
class Clock {

    private function getHours() {
        return date("H");
    }

    private function getMinutes() {
        return date("m");
    }

    private function getSeconds() {
        return date("s");
    }

    public function getTime() {
        echo $this->getHours() . ':' . $this->getMinutes() . ':' . $this->getSeconds();
    }
}

$clock = new Clock();
$clock->getTime();

// tohle je private, takze nejd zavolat, plati to i pro clenske promenne
//$clock->getSeconds();

?>