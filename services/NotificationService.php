<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/notification.php';

class NotificationService
{
    private $connection;
    private $table_name = "TBL_NOTIFICATION";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getUserNotification($userID)
    {
        $sql = "SELECT NOTIFICATIONID,TITLE,DETAIL,CREATEDDATE,DISABLEDATE,STATUS,USERID FROM " . $this->table_name . " WHERE USERID = ? AND STATUS<=1 ORDER BY NOTIFICATIONID DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listNotifications = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $notification = new Notification($NOTIFICATIONID, $TITLE, $DETAIL, $CREATEDDATE, $DISABLEDATE, $STATUS, $USERID);
            array_push($listNotifications, $notification);
        }
        return new Response(1, "Get user notification success", $listNotifications);
    }

    public function insertNotificationInfo($title, $detail, $userID)
    {
        $sql = "INSERT INTO " . $this->table_name . " (TITLE,DETAIL,CREATEDDATE,STATUS,USERID) VALUES(?,?,?,0,?)";
        $createdDate = date('Y-m-d H:i:s');
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $detail);
        $stmt->bindParam(3, $createdDate);
        $stmt->bindParam(4, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Insert notification success", null);
        } else {
            $response = new Response(0, "Fail to add notification", null);
        }
        return $response;
    }

    public function updateNotificationStatus($status, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET STATUS=? WHERE USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Update notification status success", null);
        } else {
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}
