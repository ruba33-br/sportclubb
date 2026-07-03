<?php
include "db.php";

$plan_name = $_POST['plan_name'];
$duration_months = $_POST['duration_months'];
$price = $_POST['price'];
$description = $_POST['description'];

$check = $conn->prepare("SELECT id FROM subscriptions WHERE plan_name = ?");
$check->bind_param("s", $plan_name);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: admin.php?msg=اسم الباقة موجود مسبقاً");
    exit();
}

$check->close();

$sql = "INSERT INTO subscriptions
        (plan_name, duration_months, price, description)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sids", $plan_name, $duration_months, $price, $description);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم إضافة الباقة بنجاح");
    exit();

} else {
    echo "خطأ: " . $stmt->error;
}
?>