<?php 

include_once '../../services/StorageService.php';

class StorageController{
    private $storageService;
    public function __construct(){
        $this->storageService = new StorageService();
    }

    public function getAllStorages(){
        return $this->storageService->getAllStorages();
    }

    public function getStorageByID($storageID){
        return $this->storageService->getStorageByID($storageID);
    }

    public function insertStorageInfo($type,$maxSlots,$availableSlots,$currentStorage){
        return $this->storageService->insertStorageInfo($type,$maxSlots,$availableSlots,$currentStorage);
    }

    public function updateStorageByID($storageID,$type,$maxSlots,$availableSlots,$currentStorage, $status){
        return $this->storageService->updateStorageByID($storageID,$type,$maxSlots,$availableSlots,$currentStorage, $status);
    }
}

?>