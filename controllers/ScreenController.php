<?php 
include_once '../../services/ScreenService.php';

class ScreenController{
    private $screenService;

    public function __construct()
    {
        $this->screenService = new ScreenService();
    }

    public function getAllScreens(){
        return $this->screenService->getAllScreens();
    }

    public function getScreensByID($screenID){
        return $this->screenService->getScreensByID($screenID);
    }

    public function insertScreenInfo($resolution,$screenSize,$length,$width,$height){
        return $this->screenService->insertScreenInfo($resolution,$screenSize,$length,$width,$height);
    }

    public function updateScreenByID($screenID,$resolution,$screenSize,$length,$width,$height, $status){
        return $this->screenService->updateScreenByID($screenID,$resolution,$screenSize,$length,$width,$height, $status);
    }
}

?>