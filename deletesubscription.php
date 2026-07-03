<?php
include "db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM subscriptions WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف الاشتراك بنجاح");
        exit();

    } else {
        echo "خطأ: " . $stmt->error;
    }

} else {
    echo "لا يوجد ID";
}
?>
