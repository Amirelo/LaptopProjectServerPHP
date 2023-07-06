<?php 

class Memory{
    public $memoryID;
    public $currentRAM;
    public $type;
    public $speed;
    public $maxSlots;
    public $availableSlots;
    public $maxRam;
    public $status;

    public function __construct($memoryID,$currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam,$status)
    {
        $this->memoryID = $memoryID;
        $this->currentRAM = $currentRAM;
        $this->type = $type;
        $this->speed = $speed;
        $this->maxSlots = $maxSlots;
        $this->availableSlots = $availableSlots;
        $this->maxRam = $maxRam;
        $this->status = $status;
    }
}

?>