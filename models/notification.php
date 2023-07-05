<?php 
class Notification{
    public $notificationID;
    public $title;
    public $detail;
    public $createdDate;
    public $disableDate;
    public $status;
    public $userID;

    public function __construct($notificationID,$title,$detail,$createdDate,$disableDate,$status,$userID){
        $this->notificationID = $notificationID;
        $this->title = $title;
        $this->detail = $detail;
        $this->createdDate = $createdDate;
        $this->disableDate = $disableDate;
        $this->status = $status;
        $this->userID = $userID;
    }
}
?>