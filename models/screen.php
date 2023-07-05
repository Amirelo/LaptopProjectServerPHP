<?php 

class Screen{
    public $screenID;
    public $resolution;
    public $screenSize;
    public $length;
    public $width;
    public $height;
    public $status;

    public function __construct($screenID,$resolution,$screenSize,$length,$width,$height,$status)
    {
        $this->screenID = $screenID;
        $this->resolution = $resolution;
        $this->screenSize = $screenSize;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->status = $status;
    }
}


?>