<?php
include "db.php";
require_once "validation.php";
?>

<!DOCTYPE html>
<html lang="ar"  >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تسجيل الدخول</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">تسجيل الدخول</h1>
                                    </div>
                                    <form class="user" method="post" action="validateLogin.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="ادخل عنوان البريد الالكتروني" name="email" dir="rtl" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="كلمة المرور" name="password" dir="rtl" required>
                                        </div>
                                        <div class="form-group d-flex">
                                            <div class="ml-auto custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" value="1">
                                                <label class="custom-control-label" for="customCheck">
                                                    تذكرني</label>
                                            </div>
                                        </div>
                                        <button  class="btn btn-primary btn-user btn-block">
                                            تسجيل دخول
                                        </button>
                                        <hr>
                                       
                                    </form>
                                    <hr>
                                    
                                    <div class="text-center">
                                        <a class="small" href="register.php">!إنشاء حساب جديد</a>
                                    </div>
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