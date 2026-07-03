<?php
include "db.php";




$member_id = $_GET['member_id'];
$trainer_id = $_GET['trainer_id'];
?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تعديل الاسناد</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> تعديل الاسناد</h1>
                                    </div>
                                    <form class="user" action="updateAssignment.php" method="POST">
                                        <input type="hidden" name="old_member_id" value="<?php echo $member_id; ?>">
                                        <input type="hidden" name="old_trainer_id" value="<?php echo $trainer_id; ?>">
                                        <div class="form-group text-right" dir="rtl">
                                            <label >اختار عضو جديد</label><br>
                                            <select name="member_id" class="form-control form-control-user">

                                              <?php
                                              $sql = "SELECT * FROM members";
                                              $result = $conn->query($sql);

                                              while($row = $result->fetch_assoc()){
                                              $selected = ($row['id'] == $member_id) ? "selected" : "";
                                               echo "<option value='".$row['id']."' $selected>".$row['full_name']."</option>";
                                               }
                                               ?>

                                            </select>
                                                                                     
                                        </div>
                                        <div class="form-group text-right" dir="rtl">
                                            <label >اختار مدرب جديد </label><br>
                                            <select name="trainer_id" class="form-control form-control-user">

                                            <?php
                                           $sql = "SELECT * FROM trainers";
                                           $result = $conn->query($sql);

                                           while($row = $result->fetch_assoc()){
                                           $selected = ($row['id'] == $trainer_id) ? "selected" : "";
                                           echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";
                                           }
                                           ?>

                                            </select>
                             
                                   
                                            <br>
                                            
                                           
                                        
                                       
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