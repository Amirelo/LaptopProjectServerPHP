<?php
class Storage{
    public $storageID;
    public $type;
    public $maxSlots;
    public $availableSlots;
    public $currentStorage;
    public $status;

    public function __construct($storageID,$type,$maxSlots,$availableSlots,$currentStorage,$status){
        $this->storageID= $storageID;
        $this->type=  $type;
        $this->maxSlots=  $maxSlots;
        $this->availableSlots=  $availableSlots;
        $this->currentStorage=  $currentStorage;
        $this->status=  $status;
    }
  
}
?>