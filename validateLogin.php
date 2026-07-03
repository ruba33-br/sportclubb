<?php
include 'db.php';
require_once 'validation.php';
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

 
    if (empty($email)) {
        header("Location: login.php?error=البريد فارغ");
        exit();
    }

    if (empty($password)) {
        header("Location: login.php?error=ككلمة المرور فارغة");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email= ? ";
    $statment = $conn->prepare($sql);
    $statment->bind_param("s" , $email);
    $statment->execute();
    $result = $statment->get_result();

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {

            $_SESSION['user_id'] = $row["id"];
            $_SESSION['username'] = $row["username"];
            $_SESSION['role'] = $row["role"];
            $_SESSION['logged'] = true;


            if (isset($_POST['remember'])) {
                setcookie("user_id", $row['id'], time() + (86400 * 30), "/");
                setcookie("username", $row['username'], time() + (86400 * 30), "/");
            }

            if ($row['role'] == 'admin') {

                header("Location: admin.php");

            }
           else if ($row['role'] == 'trainer') {

                header("Location: trainers.php");
           }
           else {

                header("Location: member.php");

           }
            exit();

        } else {
            header("Location: login.php?error=كلمة مرور خاطئة");
            exit();
        }

    } else {
        header("Location: login.php?error=المستخدم غير موجود");
        exit();
    }

} else {
    header("Location: login.php?error=أملأ جميع الحقول");
    exit();
}
?>