<?php
include "db.php";

$member_id = $_POST['member_id'];
$trainer_id = $_POST['trainer_id'];

// التحقق من عدم وجود الإسناد مسبقاً
$check = $conn->prepare("SELECT * FROM member_trainer WHERE member_id = ? AND trainer_id = ?");
$check->bind_param("ii", $member_id, $trainer_id);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {
    $check->close();
    $conn->close();

    header("Location: admin.php?msg=هذا العضو مسند لهذا المدرب مسبقاً");
    exit();
}

$check->close();

// إضافة الإسناد
$sql = "INSERT INTO member_trainer (member_id, trainer_id)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $member_id, $trainer_id);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم إسناد العضو للمدرب بنجاح");
    exit();

} else {
    echo "خطأ: " . $stmt->error;
}
?>