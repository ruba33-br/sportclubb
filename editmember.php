<?php
include "db.php";


if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql = "SELECT * FROM members WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();

    $full_name = $row["full_name"];
    $phone = $row["phone"];
    $gender = $row["gender"];
    $date_of_birth = $row["date_of_birth"];
    $address = $row["address"];
    $subscription_id = $row["subscription_id"];
}
?>
<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحة تعديل عضو</title>
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
                                        <h1 class="h4 text-gray-900 mb-4"> تعديل عضو</h1>
                                    </div>
                                    <form class="user"  action="updatemember.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group text-right" dir="rtl">
                                          <label >الاسم الكامل</label>
                                          <input type="text" name="full_name" class="form-control form-control-user"  value="<?php echo $full_name; ?>">
                                        </div>  
                                        <div class="form-group text-right" dir="rtl">
                                           <label>رقم الهاتف:</label>
                                           <input type="text" name="phone"  class="form-control form-control-user" value="<?php echo $phone; ?>">
                                        </div> 
                                        
                                        <div class="form-group text-right" dir="rtl">
                                      
                                                  <label>الجنس:</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="">-- اختر الجنس --</option>
                                                        <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>ذكر</option>
                                                        <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>أنثى</option>
                                                    </select>

                                        </div> 
                                        <div class="form-group text-right" dir="rtl">
                                          <label>تاريخ الميلاد:</label>
                                          <input type="date" name="date_of_birth" class="form-control form-control-user"  value="<?php echo $date_of_birth; ?>">
                                        </div> 
                                        <div class="form-group text-right" dir="rtl">
                                          <label>العنوان:</label>
                                          <textarea name="address" class="form-control form-control-user"><?php echo $address; ?></textarea>
                                        </div> 
                                       <div class="form-group text-right" dir="rtl">
                                         <label>الاشتراك:</label>

                                          <select name="subscription_id" class="form-control form-control-user">

                                              <option value="">-- اختر الاشتراك --</option>

                                              <?php
                                                $sql = "SELECT * FROM subscriptions";
                                                $result = $conn->query($sql);

                                                while ($sub = $result->fetch_assoc()) {

                                                $selected = ($sub['id'] == $subscription_id) ? "selected" : "";

                                                echo "<option value='" . $sub['id'] . "' $selected>"
                                                . $sub['plan_name'] .
                                                "</option>";
                                                }
                                                ?>

                                            </select>
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