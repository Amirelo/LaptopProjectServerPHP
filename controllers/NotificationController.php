<?php
include_once '../../services/NotificationService.php';

class NotificationController
{
    public function getUserNotification($userID)
    {
        return (new NotificationService())->getUserNotification($userID);
    }

    public function insertNotificationInfo($title, $detail, $userID)
    {
        return (new NotificationService())->insertNotificationInfo($title, $detail, $userID);
    }

    public function updateNotificationStatus($status, $userID, $notificationID)
    {
        return (new NotificationService())->updateNotificationStatus($status, $userID, $notificationID);
    }
}
