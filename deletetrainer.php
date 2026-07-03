<?php
include "db.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "DELETE FROM trainers WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف المدرب بنجاح");
        exit();

    } else {
        echo "خطأ في الحذف: " . $stmt->error;
    }

} else {
    echo "لا يوجد ID";
}

$conn->close();
?>