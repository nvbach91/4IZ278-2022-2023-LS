<?php
class Device{
    public $serial;
    public $isOnline;
    public $isDoorOpen;
    public function __construct($serial,$isOnline,$isDoorOpen){
        $this->serial = $serial;
        $this->isOnline = $isOnline;
        $this->isDoorOpen = $isDoorOpen;
    }
}
?>
