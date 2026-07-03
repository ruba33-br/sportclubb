<?php
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];

$sql1 = "UPDATE users 
SET username= ?, email= ? 
WHERE id= ?";
$stmt = $conn->prepare($sql1);
$stmt->bind_param("ssi", $username, $email, $id);
$stmt->execute();
$stmt->close();

$sql2 = "UPDATE trainers 
SET name= ?, email= ? 
WHERE user_id= ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("ssi", $username, $email, $id);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: admin.php?msg=تم التعديل بنجاح");
exit();
}
?>