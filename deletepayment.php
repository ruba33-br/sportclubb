<?php
include "db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM payments WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف الدفعة بنجاح");
        exit();

    } else {
        echo "حدث خطأ أثناء الحذف: " . $stmt->error;
    }

} else {
    echo "لا يوجد ID";
}

$conn->close();
?>