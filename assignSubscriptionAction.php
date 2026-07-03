<?php
include "db.php";

$member_id = $_POST['member_id'];
$subscription_id = $_POST['subscription_id'];

// الحصول على مدة الاشتراك
$sql = "SELECT duration_months FROM subscriptions WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $subscription_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();

$months = $row['duration_months'];

$start_date = date('Y-m-d');
$end_date = date('Y-m-d', strtotime("+$months months"));

// تحديث اشتراك العضو
$sql = "UPDATE members
        SET subscription_id = ?,
            join_date = ?,
            subscription_end_date = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issi",
    $subscription_id,
    $start_date,
    $end_date,
    $member_id
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم تعيين الاشتراك مع تاريخ الانتهاء");
    exit();

} else {
    echo "خطأ: " . $stmt->error;
}
?>