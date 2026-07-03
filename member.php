<?php
session_start();
include "db.php";



if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT members.*, subscriptions.plan_name,
        subscriptions.duration_months,
        subscriptions.price,
        subscriptions.description
        FROM members
        LEFT JOIN subscriptions
        ON members.subscription_id = subscriptions.id
        WHERE members.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "لم يتم العثور على بيانات العضو";
    exit();
}

$member = $result->fetch_assoc();
$stmt->close();

$member_id = $member['id'];

$sql_payments = "SELECT * FROM payments
                 WHERE member_id = ?
                 ORDER BY payment_date DESC";

$stmt = $conn->prepare($sql_payments);
$stmt->bind_param("i", $member_id);
$stmt->execute();

$payments_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ar"  >
 <head>
    
    
    <title>    صفحة العضو</title>
    <?php require_once 'includes/head.html'; ?>
 </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
          <?php require_once 'includes/sidebar.html';?>
             <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                 <!-- page Content -->
                <div id="content">
                    
                    
                    <div class="container-fluid">

                      <!-- Page Heading -->
                      <h1 class="h3 mb-4 text-gray-800">صفحة العضو</h1>

                    </div>
                    <!-- /.container-fluid -->
                                         <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                         <p align="center">
                             مرحباً <?php echo $_SESSION['username']; ?>
                            </p>

                            <hr>

                            
                        </div>
                      <center> 
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                      <th colspan="2">بيانات العضو</th>
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <tr>
                                          <td><b>الاسم الكامل</b></td>
                                          <td><?php echo $member['full_name']; ?></td>
                                        </tr>

                                        <tr>
                                           <td><b>رقم الهاتف</b></td>
                                           <td><?php echo $member['phone']; ?></td>
                                        </tr>

                                        <tr>
                                          <td><b>الجنس</b></td>
                                          <td><?php echo ($member['gender'] == 'Male') ? 'ذكر' : 'أنثى'; ?></td>
                                        </tr>

                                        <tr>
                                         <td><b>تاريخ الميلاد</b></td>
                                         <td><?php echo $member['date_of_birth']; ?></td>
                                        </tr>

                                        <tr>
                                         <td><b>العنوان</b></td>
                                         <td><?php echo $member['address']; ?></td>
                                        </tr>

                                        <tr>
                                         <td><b>تاريخ الانضمام</b></td>
                                         <td><?php echo $member['join_date']; ?></td>
                                       </tr>

                                        <tr>
                                           <td><b>تاريخ انتهاء الاشتراك</b></td>
                                           <td><?php echo $member['subscription_end_date']; ?></td>
                                        </tr>

                                        <tr>
                                             <td><b>الصورة الشخصية</b></td>
                                            <td>
                                              <?php
                                              if (!empty($member['image']) && file_exists("uploads/" . basename($member['image']))) {
                                              ?>
                                              <img src="uploads/<?php echo basename($member['image']); ?>" width="120">
                                              <?php
                                              } else {
                                               echo "لا توجد صورة";
                                              }
                                             ?>
                                            </td>
                                        </tr>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th colspan="2">بيانات الاشتراك</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <tr>
                                           <td><b>اسم الخطة</b></td>
                                           <td><?php echo !empty($member['plan_name']) ? $member['plan_name'] : 'لا يوجد اشتراك'; ?></td>
                                        </tr>

                                        <tr>
                                            <td><b>مدة الاشتراك</b></td>
                                            <td><?php echo !empty($member['duration_months']) ? $member['duration_months'] . " شهر" : "-"; ?></td>
                                        </tr>

                                        <tr>
                                            <td><b>السعر</b></td>
                                            <td><?php echo !empty($member['price']) ? $member['price'] . " $" : "-"; ?></td>
                                        </tr>

                                        <tr>
                                           <td><b>الوصف</b></td>
                                           <td><?php echo !empty($member['description']) ? $member['description'] : "-"; ?></td>
                                        </tr>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <h3>سجل المدفوعات</h3>

                                    <?php
                                    if ($payments_result->num_rows > 0) {
                                    ?>
                                    <thead>
                                        <tr>
                                           <th>رقم العملية</th>
                                           <th>المبلغ</th>
                                           <th>تاريخ الدفع</th>
                                           <th>طريقة الدفع</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       <?php
                                        $total = 0;

                                        while ($pay = $payments_result->fetch_assoc()) {

                                        $total += $pay['amount'];
                                        ?>

                                        <tr>
                                           <td><?php echo $pay['id']; ?></td>
                                           <td><?php echo $pay['amount']; ?> $</td>
                                           <td><?php echo $pay['payment_date']; ?></td>
                                           <td><?php echo $pay['payment_method']; ?></td>
                                        </tr>

                                        <?php
                                        }
                                        ?>

                                        <tr>
                                          <th colspan="3">إجمالي المدفوعات</th>
                                          <th><?php echo $total; ?> $</th>
                                        </tr>
                                        <?php
                                          } else {
                                          echo "<p>لا توجد مدفوعات مسجلة.</p>";
                                          }


                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                                <a href="logout.php">
                                  <button class="btn btn-primary btn-user btn-block">تسجيل الخروج</button>
                                </a>

                             
                            </div>
                        </div>
                      
                    </div>
                  </center>
                </div>
                    
                  
                    
                       
                       
                    </div>
                  <!--  End Of page Content -->
                </div>
        

               <?php require_once 'includes/footer.html' ;?>
                <!-- End of Content Wrapper -->
            </div>
        <!-- End of Page Wrapper -->
        </div>
    </body>
</html>