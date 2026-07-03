<?php
session_start();
include "db.php";

// التأكد من تسجيل الدخول وصلاحية المدرب
if (!isset($_SESSION['logged']) || $_SESSION['role'] != 'trainer') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. جلب بيانات المدرب
$sql = "SELECT * FROM trainers WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$trainer = $result->fetch_assoc();
$trainer_id = $trainer['id'];
$stmt->close();

// 2. جلب المشتركين التابعين للمدرب
$sql_m = "SELECT m.* FROM members m
          JOIN member_trainer mt ON m.id = mt.member_id
          WHERE mt.trainer_id = ?";
$stmt_m = $conn->prepare($sql_m);
$stmt_m->bind_param("i", $trainer_id);
$stmt_m->execute();
$members_result = $stmt_m->get_result();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <title>صفحة المدرب</title>
    <?php require_once 'includes/head.html'; ?>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php require_once 'includes/sidebar.html';?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <center>
                    <div class="container-fluid">
                         <h1 class="h3 mb-4 text-gray-800">صفحة المدرب</h1>
                    </div>
                </center>

                <div class="card shadow mb-4">
                    <center>
                        <div class="card-header py-3">
                           <p><?php echo $_SESSION['username']; ?> :مرحبا </p>
                           <hr>
                        </div>
                    </center>
                    <center>
                        <div class="card-body">
                            <h3>بياناتي</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>التخصص</th>
                                            <th>الهاتف</th>
                                            <th>الإيميل</th>
                                            <th>الراتب</th>
                                            <th>تاريخ التعيين</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $trainer['name']; ?></td>
                                            <td><?php echo $trainer['specialization']; ?></td>
                                            <td><?php echo $trainer['phone']; ?></td>
                                            <td><?php echo $trainer['email']; ?></td>
                                            <td><?php echo $trainer['salary']; ?></td>
                                            <td><?php echo $trainer['hire_date']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <h3>المشتركون التابعون لي</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>الصورة</th>
                                            <th>اسم المشترك</th>
                                            <th>الهاتف</th>
                                            
                                            <th>تاريخ انتهاء الاشتراك</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $members_result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <img src="uploads/<?php echo $row['image']; ?>" width="50" height="50" style="border-radius:50%;" alt="صورة المشترك">
                                            </td>
                                            <td><?php echo $row['full_name']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            
                                            <td><?php echo $row['subscription_end_date']; ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <a href="logout.php">
                                <button class="btn btn-primary btn-user btn-block">تسجيل الخروج</button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>
            <?php require_once 'includes/footer.html'; ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>