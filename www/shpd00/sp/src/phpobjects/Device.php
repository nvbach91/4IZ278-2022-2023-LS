<?php
    class Device{
        public $serial;
        public $name;
        public $onlineState;
        public $doorState;
        
        function __construct($serial,$name,$onlineState,$doorState){
            $this -> serial = $serial;
            $this -> name = $name;
            $this -> onlineState = $onlineState;
            $this -> doorState = $doorState;
        }
    }
?>