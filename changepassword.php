<?php
include "db.php";

$password = password_hash("Admin#2026", PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password='$password'
        WHERE email='admin2@gmail.com'";

if($conn->query($sql)){
    echo "تم تغيير كلمة المرور";
}else{
    echo $conn->error;
}
?>