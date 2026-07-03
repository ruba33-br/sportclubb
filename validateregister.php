<?php
include "db.php";
require_once "validation.php";

if (isset($_POST['submit'])) {

    $full_name = validate($_POST['full_name']);
    $username  = validate($_POST['username']);
    $email = validate_email(validate($_POST['email']));
    if(!$email){
        header("Location:register.php?error=invalidEmail");
        exit();
    }
    $password = validate_password($_POST['password']);
     if(!$password){
        header("Location:register.php?error=invalidPassword");
        exit();
    }else{
        $password=password_hash($password,PASSWORD_DEFAULT);
    }
    $phone = validate_phone($_POST['phone']);
     if(!$phone){
        header("Location:register.php?error=invalidPhone");
        exit();
    }
    $gender    = $_POST['gender'];
    $dob       = $_POST['date_of_birth'];
    $address   = validate($_POST['address']);

    $image = "default.png";

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0){
        header("Location: register.php?error=userExists");
        exit();
    }
    $check->close();


    $sql1 = "INSERT INTO users (username, email, password, role)
             VALUES (?, ?, ?, 'member')";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("sss", $username, $email, $password);
    $result = $stmt1->execute();
    if ($result === TRUE) {

        $user_id = $conn->insert_id;

      
        $sql2 = "INSERT INTO members 
        (user_id, full_name, phone, gender, date_of_birth, address, image)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
         $stmt2 = $conn->prepare($sql2);
         $stmt2->bind_param("issssss", $user_id, $full_name, $phone, $gender, $dob,
          $address, $image);
         $result = $stmt2->execute();
        
         $stmt2->close();
         $stmt1->close();


        header("Location: login.php?success=تم التسجيل بنجاح");
        exit();

    } else {
        echo "خطأ في التسجيل";
    }
    $conn->close();
}
?>