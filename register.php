<?php
include "db.php";
require_once "validation.php";

if (isset($_POST['submit'])) {

    $full_name = validate($_POST['full_name']);
    $username = validate($_POST['username']);
    $email = validate_email($_POST['email']);
    $password = validate_password($_POST['password']);
    $phone = validate_phone($_POST['phone']);
    $address = validate($_POST['address']);
    $date_of_birth = validate($_POST['date_of_birth']);
    $gender = validate($_POST['gender']);

    if (!$email) {
        die("البريد الإلكتروني غير صحيح");
    }

    if (!$password) {
        die("كلمة المرور يجب أن تحتوي على حرف كبير وحرف صغير ورقم ورمز، وأن تكون 6 أحرف على الأقل.");
    }

    if (!$phone) {
        die("رقم الهاتف غير صحيح");
    }

    // تشفير كلمة المرور
    $password = password_hash($password, PASSWORD_DEFAULT);

    // رفع الصورة
    $image = "";

    if (!empty($_FILES['profile_image']['name'])) {

        $image = time() . "_" . $_FILES['profile_image']['name'];

        move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            "uploads/" . $image
        );
    }

    // إضافة المستخدم
    $role = "member";

    $sql = "INSERT INTO users(username,email,password,role)
            VALUES('$username','$email','$password','$role')";

    if (mysqli_query($conn, $sql)) {

        $user_id = mysqli_insert_id($conn);

        $sql2 = "INSERT INTO members
        (user_id,full_name,phone,gender,date_of_birth,address,image,join_date)
        VALUES
        ('$user_id',
        '$full_name',
        '$phone',
        '$gender',
        '$date_of_birth',
        '$address',
        '$image',
        CURDATE())";

        if (mysqli_query($conn, $sql2)) {

            header("Location: login.php");
            exit();

        } else {

            echo mysqli_error($conn);

        }

    } else {

        echo mysqli_error($conn);

    }

}
?>

<!DOCTYPE html>
<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
 <head>
    <meta charset="UTF-8">
    <?php require_once "includes/head.html"; ?>

  </head>
 <body class="bg-gradient-primary">
    
  <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">إنشاء حساب جديد!</h1>
                            </div>

                        <form class="user" method="POST" enctype="multipart/form-data">

                            <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user"
                                name="full_name" placeholder="الإسم الكامل">
                            </div>

                            <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user"
                                name="username" placeholder="اسم المستخدم">
                            </div>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    name="email" placeholder="البريد الإلكتروني">
                            </div>

                            <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user"
                                    name="password" placeholder="كلمة المرور">
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user"
                                    name="phone" placeholder="رقم الهاتف">
                            </div>
                            </div>

                        <!-- العنوان -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                    name="address" placeholder="العنوان">
                            </div>

                        <!-- تاريخ الميلاد والجنس -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="date" class="form-control"
                                        name="date_of_birth">
                            </div>

                            <div class="col-sm-6">
                                <select class="form-control" name="gender">
                                    <option value="">اختر الجنس</option>
                                    <option value="Male">ذكر</option>
                                    <option value="Female">أنثى</option>
                                </select>
                            </div>
                        </div>

                        <!-- الصورة الشخصية -->
                            <div class="form-group">
                                <label for="profile_image"class="d-block text-right">
                                    الصورة الشخصية
                                </label>

                                <input type="file"
                                    class="form-control form-control-user"
                                    id="profile_image"
                                    name="profile_image"
                                    accept="image/*">
                            </div>

                            <button  name = "submit" type="submit" class="btn btn-primary btn-user btn-block">
                         تسجيل حساب
                          </button>

                        </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">هل لدبك حساب بالفعل؟ تسجيل دخول</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once "includes/jslinks.html"; ?>

  

</body>
</html>