<?php
include "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$specialization = $_POST['specialization'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$salary = $_POST['salary'];
$hire_date = $_POST['hire_date'];

$check = $conn->prepare("SELECT id FROM trainers WHERE email = ? AND id != ?");
$check->bind_param("si", $email, $id);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: edittrainer.php?id=$id&error=emailExists");
    exit();
}

$check->close();


$sql = "UPDATE trainers SET
    name = ?,
    specialization = ?,
    phone = ?,
    email = ?,
    salary = ?,
    hire_date = ?
    WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $name, $specialization, $phone, $email, $salary, $hire_date, $id);

if ($stmt->execute()) {
    $stmt->close();

    $sql = "SELECT user_id FROM trainers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();

    if ($row && $row['user_id'] != NULL) {

        $user_id = $row['user_id'];

        $sql = "UPDATE users
                SET username = ?, email = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    header("Location: admin.php?msg=تم تعديل بيانات المدرب بنجاح");
    exit();

} else {
    echo "خطأ: " . $conn->error;
}
?>