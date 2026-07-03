<!DOCTYPE html>
<html lang="ar" >
 <head>
    <?php require_once "includes/head.html";?>
    <title> صفحةالبحث</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">صفحة البحث</h1>
                                    </div>
                                    <form class="user" method="GET">
                                        <div class="form-group text-right" dir="rtl">
                                            <input type="text" name="search" placeholder="ابحث هنا" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                required>
                                        </div>
                                       
                                      
                                        <button  type="submit" name="searchBtn" class="btn btn-primary btn-user btn-block">
                                            بحث
                                        </button>
                                        <hr>
                                       
                                    </form>
                                    <?php
                                      include "db.php";

                                      if (isset($_GET['searchBtn'])) {

                                      $search = trim($_GET['search']);
                                      $search = "%" . $search . "%";

                                      echo "<div dir='rtl' align='right'>";
                                      echo "<h3>نتائج البحث:</h3>";


                                      $sql1 = "SELECT * FROM users
                                      WHERE username LIKE ?
                                      OR email LIKE ?";

                                      $stmt1 = $conn->prepare($sql1);
                                      $stmt1->bind_param("ss", $search, $search);
                                      $stmt1->execute();
                                      $res1 = $stmt1->get_result();

                                       if ($res1->num_rows > 0) {
                                      echo "<h4>المستخدمين</h4>";
                                      while ($row = $res1->fetch_assoc()) {
                                       echo $row['username'] . " - " . $row['email'] . "<hr>";
                                       }
                                     }


                                      $sql2 = "SELECT * FROM members
                                       WHERE full_name LIKE ?
                                       OR phone LIKE ?";

                                       $stmt2 = $conn->prepare($sql2);
                                       $stmt2->bind_param("ss", $search, $search);
                                       $stmt2->execute();
                                       $res2 = $stmt2->get_result();

                                       if ($res2->num_rows > 0) {
                                        echo "<h4>الأعضاء</h4>";
                                       while ($row = $res2->fetch_assoc()) {
                                       echo $row['full_name'] . " - " . $row['phone'] . "<hr>";
                                        }
                                       }


                                      $sql3 = "SELECT * FROM trainers
                                      WHERE name LIKE ?
                                      OR email LIKE ?";

                                      $stmt3 = $conn->prepare($sql3);
                                      $stmt3->bind_param("ss", $search, $search);
                                      $stmt3->execute();
                                      $res3 = $stmt3->get_result();

                                      if ($res3->num_rows > 0) {
                                     echo "<h4>المدربين</h4>";
                                      while ($row = $res3->fetch_assoc()) {
                                      echo $row['name'] . " - " . $row['email'] . "<hr>";
                                       }
                                     }


                                    $sql4 = "SELECT * FROM subscriptions
                                    WHERE plan_name LIKE ?";

                                    $stmt4 = $conn->prepare($sql4);
                                    $stmt4->bind_param("s", $search);
                                    $stmt4->execute();
                                    $res4 = $stmt4->get_result();

                                   if ($res4->num_rows > 0) {
                                   echo "<h4>الباقات</h4>";
                                  while ($row = $res4->fetch_assoc()) {
                                  echo $row['plan_name'] . " - " . $row['price'] . "<hr>";
                                   }
                                  }


                                   $sql5 = "SELECT payments.*, members.full_name
                                    FROM payments
                                    JOIN members ON payments.member_id = members.id
                                    WHERE members.full_name LIKE ?
                                    OR payments.payment_method LIKE ?";

                                   $stmt5 = $conn->prepare($sql5);
                                   $stmt5->bind_param("ss", $search, $search);
                                    $stmt5->execute();
                                    $res5 = $stmt5->get_result();

                                   if ($res5->num_rows > 0) {
                                    echo "<h4>المدفوعات</h4>";
                                    while ($row = $res5->fetch_assoc()) {
                                   echo $row['full_name'] . " - " . $row['amount'] . " - " . $row['payment_method'] . "<hr>";
                                    }
                                  }

                                  $stmt1->close();
                                  $stmt2->close();
                                  $stmt3->close();
                                  $stmt4->close();
                                  $stmt5->close();

                                  echo "</div>";
                                    }
                                ?>
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