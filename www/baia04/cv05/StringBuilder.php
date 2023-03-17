<?php

class StringBuilder {

    private string $string = '';

    public function append(string $str) {
        $this -> string .= $str;
        $this -> string .= " ";
    }
    
    public function build() {
        return $this -> string;
    }
}

?>