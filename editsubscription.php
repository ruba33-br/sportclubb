<?php
include "db.php";



$id = $_GET['id'];

$sql = "SELECT * FROM subscriptions WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تعديل  اشتراك</title>
</head>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> تعديل باقة اشتراك</h1>
                                    </div>
                                    <form class="user"  action="updatesubscription.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group text-right" dir="rtl">
                                             <label>اسم الباقة</label><br>
                                             <input type="text" name="plan_name" class="form-control form-control-user" value="<?php echo $row['plan_name']; ?>">
                                            
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>المدة (شهر)</label><br>
                                            <input type="number" name="duration_months" class="form-control form-control-user" value="<?php echo $row['duration_months']; ?>">
                                         
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>السعر</label><br>
                                            <input type="text" name="price" class="form-control form-control-user" value="<?php echo $row['price']; ?>">
                                           
                                        </div>
                                         <div class="form-group text-right" dir="rtl">
                                            <label>الوصف</label><br>
                                            <textarea name="description" class="form-control form-control-user"><?php echo $row['description']; ?></textarea>
                                            
                                        </div>
                                        <button  class="btn btn-primary btn-user btn-block">
                                            تعديل
                                        </button>
                                        <hr>
                                       
                                    </form>
                                    <hr>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <?php require_once "includes/jslinks.html";?>
    </div>

   
   

</body>
</html>