<?php
    class DeviceHistoryRecord{
        public $time;
        public $event;
        
        function __construct($time,$event){
            $this -> time = $time;
            $this -> event = $event;
        }
    }
?>