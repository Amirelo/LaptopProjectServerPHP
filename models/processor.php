<?php 
class Processor{
    public $processorID;
    public $name;
    public $CPU_Speed;
    public $cores;
    public $logicalProcessor;
    public $cacheMemory;
    public $status;

    public function __construct($processorID, $name, $CPU_Speed, $cores, $logicalProcessor,$cacheMemory,$status){
        $this->processorID = $processorID;
        $this->name = $name;
        $this->CPU_Speed = $CPU_Speed;
        $this->cores = $cores;
        $this->logicalProcessor = $logicalProcessor;
        $this->cacheMemory = $cacheMemory;
        $this->status = $status;
    }
}



?>