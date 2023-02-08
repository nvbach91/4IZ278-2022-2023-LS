<?php

class Simple {
    public $prop = 'prop';
}

$simpleInstance = new Simple;
print_r($simpleInstance);
echo gettype($simpleInstance), PHP_EOL;
echo "Am I an instance of Simple? Answer:", $simpleInstance instanceof Simple;

?>