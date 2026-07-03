<?php
include "db.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    // حذف المدرب المرتبط بالمستخدم (إن وجد)
    $sql = "DELETE FROM trainers WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // حذف المستخدم
    $sql = "DELETE FROM users WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف المستخدم بنجاح");
        exit();

    } else {
        echo "خطأ في الحذف: " . $stmt->error;
    }

} else {
    echo "لا يوجد ID";
}
?>