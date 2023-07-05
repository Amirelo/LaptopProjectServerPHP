<?php 
include_once '../../dbconfigs/dbconfigs';
class CouponService{
    private $connection;
    private $table_name="Coupon";

    public function __construct()
    {
        $this->connection =  (new Database())->getConnect();
    }

}


?>