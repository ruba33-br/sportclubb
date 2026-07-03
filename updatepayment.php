<?php
include "db.php";

$id = $_POST['id'];
$amount = $_POST['amount'];
$payment_method = $_POST['payment_method'];

$sql = "UPDATE payments
        SET amount = ?,
            payment_method = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("dsi", $amount, $payment_method, $id);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم تعديل الدفعة بنجاح");
    exit();

} else {
    echo "حدث خطأ: " . $stmt->error;
}
?>