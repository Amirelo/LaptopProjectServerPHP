<?php 

class Screen{
    public $screenID;
    public $resolution;
    public $screenSize;
    public $status;

    public function __construct($screenID,$resolution,$screenSize,$status)
    {
        $this->screenID = $screenID;
        $this->resolution = $resolution;
        $this->screenSize = $screenSize;
        $this->status = $status;
    }
}


?>