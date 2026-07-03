<?php
include "db.php";

$old_member_id = $_POST['old_member_id'];
$old_trainer_id = $_POST['old_trainer_id'];

$new_member_id = $_POST['member_id'];
$new_trainer_id = $_POST['trainer_id'];

$sql = "UPDATE member_trainer 
        SET member_id = ?,
            trainer_id = ?
        WHERE member_id = ?
        AND trainer_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "iiii",
    $new_member_id,
    $new_trainer_id,
    $old_member_id,
    $old_trainer_id
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم تعديل الإسناد بنجاح");
    exit();

} else {
    echo "حدث خطأ أثناء التعديل: " . $stmt->error;
}
?>