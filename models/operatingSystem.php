<?php
class OperatingSystem
{
    public $operatingSystemID;
    public $OS;
    public $version;
    public $type;
    public $status;

    public function __construct($operatingSystemID, $OS, $version, $type, $status)
    {
        $this->operatingSystemID = $operatingSystemID;
        $this->OS = $OS;
        $this->version = $version;
        $this->type = $type;
        $this->status = $status;
    }
}
