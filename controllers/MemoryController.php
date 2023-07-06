<?php 

include_once '../../services/MemoryService.php';

class MemoryController{
    private $memoryService;
    public function __construct(){
        $this->memoryService = new MemoryService();
    }

    public function getAllMemories(){
        return $this->memoryService->getAllMemories();
    }

    public function getMemoryByID($memoryID){
        return $this->memoryService->getMemoryByID($memoryID);
    }

    public function insertMemoryInfo($currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam){
        return $this->memoryService->insertMemoryInfo($currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam);
    }

    public function updateMemoryByID($memoryID,$currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam, $status){
        return $this->memoryService->updateMemoryByID($memoryID,$currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam, $status);
    }
}

?>