<?php
include "db.php";

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];
$subscription_id = $_POST['subscription_id'];


$sql = "SELECT duration_months FROM subscriptions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $subscription_id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

$months = $row['duration_months'];
$end_date = date('Y-m-d', strtotime("+$months months"));


$sql = "UPDATE members SET
        full_name = ?,
        phone = ?,
        gender = ?,
        date_of_birth = ?,
        address = ?,
        subscription_id = ?,
        subscription_end_date = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssisi",
    $full_name,
    $phone,
    $gender,
    $date_of_birth,
    $address,
    $subscription_id,
    $end_date,
    $id
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم التعديل بنجاح");
    exit();

} else {
    echo $stmt->error;
}
?>