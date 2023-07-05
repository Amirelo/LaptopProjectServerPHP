<?php 
include_once '../../services/OperatingSystemService.php';

class OperatingSystemController{
    private $operatingSystemService;

    public function __construct()
    {
        $this->operatingSystemService = new OperatingSystemService();
    }

    public function getAllOperatingSystems(){
        return $this->operatingSystemService->getAllOperatingSystems();
    }

    public function getOperatingSystemsByID($OperatingSystemID){
        return $this->operatingSystemService->getOperatingSystemByID($OperatingSystemID);
    }

    public function insertOperatingSystemInfo($OS,$version, $type){
        return $this->operatingSystemService->insertOperatingSystem($OS,$version, $type);
    }

    public function updateOperatingSystemByID($OperatingSystemID,$OS,$version, $type, $status){
        return $this->operatingSystemService->updateOperatingSystemByID($OperatingSystemID,$OS,$version, $type, $status);
    }
}

?>