<?php
include "db.php";
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$name = $_POST['name'];
$specialization = $_POST['specialization'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$salary = $_POST['salary'];
$hire_date = $_POST['hire_date'];

// التحقق من وجود المستخدم
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("لا يوجد حساب بهذا الإيميل في جدول المستخدمين (users)");
}

$user = $result->fetch_assoc();
$user_id = $user['id'];

$stmt->close();

// تحديث صلاحية المستخدم إلى مدرب
$sql = "UPDATE users SET role = 'trainer' WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// إضافة المدرب
$sql = "INSERT INTO trainers
(name, specialization, phone, email, salary, hire_date, user_id)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssdsi",
    $name,
    $specialization,
    $phone,
    $email,
    $salary,
    $hire_date,
    $user_id
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: admin.php?msg=تم إضافة المدرب بنجاح وتحديث رتبته إلى مدرب");
    exit();

} else {
    echo "خطأ في جدول المدربين: " . $stmt->error;
}
?>