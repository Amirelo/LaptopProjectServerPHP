<?php 
class Coupon{
    public $couponID;
    public $name;
    public $effect;
    public $maxEffectValue;
    public $couponCode;
    public $status;
    public $userID;

    public function __construct($couponID,$name,$effect,$maxEffectValue,$couponCode,$status,$userID){
        $this->couponID = $couponID;
        $this->name = $name;
        $this->effect = $effect;
        $this->maxEffectValue = $maxEffectValue;
        $this->couponCode = $couponCode;
        $this->status = $status;
        $this->userID = $userID;
    }
}
?>