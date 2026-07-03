<?php
include "db.php";

if (isset($_GET['member_id']) && isset($_GET['trainer_id'])) {

    $member_id = $_GET['member_id'];
    $trainer_id = $_GET['trainer_id'];

    $sql = "DELETE FROM member_trainer
            WHERE member_id = ?
            AND trainer_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $member_id, $trainer_id);

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم حذف الإسناد بنجاح");
        exit();

    } else {
        echo "خطأ: " . $stmt->error;
    }

} else {
    echo "بيانات ناقصة";
}
?>