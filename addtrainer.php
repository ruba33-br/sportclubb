<?php
include "db.php";



require_once "validation.php";
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة اضافة مدرب</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> اضافة مدرب </h1>
                                    </div>
                                    <form class="user"  method="POST" action="inserttrainer.php">
                                        <div class="form-group text-right" dir="rtl">
                                            <label>اسم المدرب</label><br>
                                            <input type="text" name="name"  class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="اسم المدرب."  required>
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>التخصص</label><br>
                                            <input type="text" name="specialization" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="التخصص "  required>
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label>رقم الهاتف</label><br>
                                            <input type="text" name="phone" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="رقم الهاتف "  required>
                                        </div>
                                         <div class="form-group text-right" dir="rtl">
                                            <label>الايميل </label><br>
                                            <input type="email" name="email" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="الايميل"  required>
                                        </div>
                                         <div class="form-group text-right" dir="rtl">
                                            <label>الراتب </label><br>
                                            <input type="text" name="salary" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="الراتب  "  required>
                                        </div>
                                         <div class="form-group text-right" dir="rtl">
                                            <label>تاريخ التعيين</label><br>
                                            <input type="date" name="hire_date" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="تاريخ التعيين "  required>
                                        </div>
                                       
                                        <button  class="btn btn-primary btn-user btn-block">
                                            حفظ المدرب
                                        </button><br>
                                        <a href="admin.php"><button  class="btn btn-primary btn-user btn-block" >
                                             الرجوع لصفحة الادمن
                                        </button></a>
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