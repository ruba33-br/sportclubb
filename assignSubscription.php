<?php
include "db.php";



?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تعيين الاشتراك</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> تعيين اشتراك</h1>
                                    </div>
                                    <form class="user" action="assignSubscriptionAction.php" method="POST">
                                        <div class="form-group text-right" dir="rtl">
                                            <label >اختار العضو</label><br>
                                            <select name="member_id" required class="form-control form-control-user">
                                             <option value="" disabled selected>-- اختر العضو --</option>

                                             <?php
                                              $sql = "SELECT * FROM members";
                                              $result = $conn->query($sql);

                                              while($row = $result->fetch_assoc()){
                                              echo "<option value='".$row['id']."'>".$row['full_name']."</option>";
                                               }
                                                ?>
                                            </select>
                                            
                                           
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label >اختار الاشتراك </label><br>
                                            <select name="subscription_id" required class="form-control form-control-user">
                                             <option value="" disabled selected>-- اختر الاشتراك --</option>

                                               <?php
                                               $sql = "SELECT * FROM subscriptions";
                                               $result = $conn->query($sql);

                                              while($row = $result->fetch_assoc()){
                                               echo "<option value='".$row['id']."'>
                                              ".$row['plan_name']." - ".$row['price']."$
                                              </option>";
                                              }
                                                ?>
                                            </select>
                                   
                                            <br>
                                            
                                           
                                        
                                       
                                        <button  class="btn btn-primary btn-user btn-block">
                                            حفظ الاشتراك
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