<?php 
include_once '../../services/CouponService.php';

class CouponController{
    private $couponService;
    public function __construct()
    {
        $this->couponService = (new CouponService());
    }

    public function insertCoupon($name,$effect,$maxEffectValue,$couponCode,$userID){
        return $this->couponService->insertCoupon($name,$effect,$maxEffectValue,$couponCode,$userID);
    }

    public function insertGlobalCoupon($name,$effect,$maxEffectValue,$couponCode){
        return $this->couponService->insertGlobalCoupon($name,$effect,$maxEffectValue,$couponCode);
    }

    public function updateCouponStatus($status, $couponID){
        return $this->couponService ->updateCouponStatus($status, $couponID);
    }

    public function getCouponsByUserID($userID){
        return $this->couponService->getCouponsByUserID($userID);
    }
}


?>