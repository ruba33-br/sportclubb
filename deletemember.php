<?php
include 'db.php';

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "DELETE FROM members WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف العضو");
        exit();

    } else {
        echo "error: " . $stmt->error;
    }
}
?>