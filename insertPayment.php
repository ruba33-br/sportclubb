<?php
include "db.php";

$member_id = $_POST['member_id'];
$amount = $_POST['amount'];
$payment_method = $_POST['payment_method'];

$sql = "INSERT INTO payments (member_id, amount, payment_method)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ids", $member_id, $amount, $payment_method);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم إضافة الدفعة بنجاح");
    exit();

} else {
    echo "خطأ: " . $stmt->error;
}
?>