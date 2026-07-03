<?php
include "db.php";
include "auth.php";
require_once "validation.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = validate($_POST["user_id"]);
    $subscription_id = validate($_POST["subscription_id"]);
    $full_name = validate($_POST["full_name"]);
    $phone = validate($_POST["phone"]);
    $gender = validate($_POST["gender"]);
    $date_of_birth = validate($_POST["date_of_birth"]);
    $address = validate($_POST["address"]);

    $fileDist = "default.png";

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        $file = $_FILES["image"];
        $filename = $file["name"];
        $fileTmp = $file["tmp_name"];
        $fileSize = $file["size"];

        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $allowed = ["jpg", "jpeg", "png", "gif"];

        if (in_array($fileExt, $allowed)) {

            if ($fileSize < 5000000) {

                $newFileName = uniqid("member_", true) . "." . $fileExt;
                $fileDist = "uploads/" . $newFileName;

                move_uploaded_file($fileTmp, $fileDist);

            } else {
                echo "حجم الصورة أكبر من 5MB";
                exit();
            }

        } else {
            echo "امتداد الصورة غير مسموح";
            exit();
        }
    }

    // التحقق من أن المستخدم ليس عضواً بالفعل
    $check = $conn->prepare("SELECT id FROM members WHERE user_id = ?");
    $check->bind_param("i", $user_id);
    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {
        header("Location: admin.php?msg=العضو موجود مسبقاً");
        exit();
    }

    $check->close();

    // إضافة العضو
    $sql = "INSERT INTO members
            (user_id, subscription_id, full_name, phone, gender, date_of_birth, address, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iissssss",
        $user_id,
        $subscription_id,
        $full_name,
        $phone,
        $gender,
        $date_of_birth,
        $address,
        $fileDist
    );

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: admin.php?msg=تم إضافة العضو بنجاح");
        exit();

    } else {
        echo $stmt->error;
    }
}
?>