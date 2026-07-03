<?php
include "db.php";

$id = $_POST['id'];
$plan_name = $_POST['plan_name'];
$duration_months = $_POST['duration_months'];
$price = $_POST['price'];
$description = $_POST['description'];

$sql = "UPDATE subscriptions
        SET plan_name = ?, duration_months = ?, price = ?, description = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sidsi",
    $plan_name,
    $duration_months,
    $price,
    $description,
    $id
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم تعديل الاشتراك بنجاح");
    exit();

} else {
    echo $stmt->error;
}
?>