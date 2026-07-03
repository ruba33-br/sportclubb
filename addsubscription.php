<?php include "db.php"; 

?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة اضافة باقة اشتراك</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> اضافة باقة اشتراك</h1>
                                    </div>
                                    <form class="user"  action="insertsubscription.php" method="POST">
                                        <div class="form-group">
                                            <label>اسم الباقة</label><br>
                                            <input type="text" name="plan_name"  class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="اسم الباقة."  required>
                                        </div>
                                        <div class="form-group">
                                            <label>مدة الاشتراك (بالشهور)</label><br>
                                            <input type="number" name="duration_months" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="المدة بالشهور"  required>
                                        </div>
                                        <div class="form-group">
                                            <label>السعر</label><br>
                                            <input type="number" name="price" step="0.01" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="السعر "  required>
                                        </div>
                                         <div class="form-group">
                                            <label>الوصف</label><br>
                                            <textarea name="description"  class="form-control form-control-user"></textarea><br><br>
                                            
                                        </div>
                                        <button  class="btn btn-primary btn-user btn-block">
                                            حفظ
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