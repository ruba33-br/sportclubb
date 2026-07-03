<?php
include "db.php";



if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM trainers WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();

} else {
    die("لا يوجد ID");
}
?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تعديل  مدرب</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> تعديل مدرب</h1>
                                    </div>
                                    <form class="user"  method="POST" action="updatetrainer.php">
                                         <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group text-right" dir="rtl">
                                             <label>اسم المدرب</label><br>
                                             <input type="text" name="name" class="form-control form-control-user" value="<?php echo $row['name']; ?>">
                                             
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>التخصص</label><br>
                                            <input type="text" name="specialization" class="form-control form-control-user" value="<?php echo $row['specialization']; ?>">
                                            
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>رقم الهاتف</label><br>
                                            <input type="text" name="phone" class="form-control form-control-user" value="<?php echo $row['phone']; ?>">
                                           
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>الإيميل</label><br>
                                            <input type="email" name="email" class="form-control form-control-user" value="<?php echo $row['email']; ?>">
                                            
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                                <label>الراتب</label><br>
                                                <input type="text" name="salary" class="form-control form-control-user" value="<?php echo $row['salary']; ?>">
                                            
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>تاريخ التعيين</label><br>
                                            <input type="date" name="hire_date" class="form-control form-control-user" value="<?php echo $row['hire_date']; ?>">
                                            
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