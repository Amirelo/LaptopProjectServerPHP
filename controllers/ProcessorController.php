<?php 
include_once '../../services/ProcessorService.php';

class ProcessorController{
    private $processorService;

    public function __construct()
    {
        $this->processorService = new ProcessorService();
    }

    public function getAllProcessors(){
        return $this->processorService->getAllProcessors();
    }

    public function getProcessorsByID($processorID){
        return $this->processorService->getProcessorsByID($processorID);
    }

    public function insertProcessorInfo($name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory){
        return $this->processorService->insertProcessorInfo($name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory);
    }

    public function updateProcessorByID($processorID,$name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory, $status){
        return $this->processorService->updateProcessorByID($processorID,$name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory, $status);
    }
}

?>