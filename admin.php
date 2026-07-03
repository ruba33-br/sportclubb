<?php
include "db.php";

require 'adminauth.php';
require 'auth.php';
$sql="SELECT id,username,email FROM users";
$result=$conn->query($sql);



?>


<!DOCTYPE html>
<html lang="ar">
<head>
    
    
    <title>    صفحة الادارة</title>
    <?php require_once 'includes/head.html'; ?>
</head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
          <?php require_once 'includes/sidebar.html';?>
             <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                 <!-- page Content -->
                <div id="content">
                    
                    <?php require_once 'includes/topbar.html';?>
                    <div class="container-fluid">


                      <!-- Page Heading -->
                      <h1 class="h3 mb-4 text-gray-800"> صفحة الادارة</h1>

                    </div>
                    <!-- /.container-fluid -->
                                         <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <a href="search.php">
                          <button class="btn btn-primary btn-user btn-block">بحث</button>
                        </a>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">USERS </h6>
                        </div>
                        <?php if(isset($_GET['msg'])){
                           $msg=$_GET['msg'];
                           echo "<button class= 'btn btn-danger'>".$msg."</button><br>";
                         }?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>Email</th>
                                            <th>Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>Email</th>
                                            <th>Delete</th>
                                            <th> Edit</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                     <?php if($result->num_rows>0){ 
                                        while($row=$result->fetch_assoc()){
                                       echo "<tr>";
                                       echo "<td>".$row["id"]."</td>";
                                       echo "<td>".$row["username"]."</td>";
                                       echo "<td>".$row["email"]."</td>";
                                       echo "<td><a href='deleteuser.php?id=".$row["id"]."'>delete</a></td>";
                                       echo "<td><a href='edituser.php?id=".$row["id"]."'>edit</a></td>";
                                       echo "</tr>";
                                       }}else{
                                          echo "<tr><td colspan='8'>لا يوجد مستخدمين </td></tr>";
                                       }
                                      

                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">subscriptions </h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subscription Name</th>
                                            <th>Duration Months</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Delete </th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Subscription Name</th>
                                            <th>Duration Months</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th> Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <a href="addsubscription.php" ><button class="form-control form-control-user">إضافة باقة</button></a>
                                     <?php $sql="SELECT * FROM subscriptions";
                                     $result=$conn->query($sql);
                                     if($result->num_rows>0){ 
                                     while($row=$result->fetch_assoc()){
                                       echo "<tr>";
                                       echo "<td>".$row["plan_name"]."</td>";
                                       echo "<td>".$row["duration_months"]."</td>";
                                       echo "<td>".$row["price"]."</td>";
                                       echo "<td>".$row["description"]."</td>";
                                        echo "<td><a href='deletesubscription.php?id=".$row["id"]."'>delete</a></td>";
                                       echo "<td><a href='editsubscription.php?id=".$row["id"]."'>edit</a></td>";
                                       echo "</tr>";
                                       }}else{
                                          echo "<tr><td colspan='8'>لا يوجد باقة </td></tr>";
                                       }
                                       

                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Members </h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Full Name</th>
                                            <th>Phone </th>
                                            <th>Subscription Id</th>
                                            <th>Subscription End Date</th>
                                            <th>Delete </th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Full Name </th>
                                            <th> Phone</th>
                                            <th>Subscription Id</th>
                                            <th>Subscription End Date</th>
                                            <th> Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        <a href="assignSubscription.php"><button class="form-control form-control-user">تعيين اشتراك</button></a>
                                     <?php $sql="SELECT * FROM members";
                                      $result=$conn->query($sql);
                                     if($result->num_rows>0){ 
                                      while($row=$result->fetch_assoc()){
                                       echo "<tr>";
                                       echo "<td>".$row["full_name"]."</td>";
                                       echo "<td>".$row["phone"]."</td>";
                                       echo "<td>".$row["subscription_id"]."</td>";
                                       echo "<td>".$row["subscription_end_date"]."</td>";
                                       echo "<td><a href='deletemember.php?id=".$row["id"]."'>delete</a></td>";
                                       echo "<td><a href='editmember.php?id=".$row["id"]."'>edit</a></td>";
                                       echo "</tr>";
                                       }}else{
                                          echo "<tr><td colspan='8'>لا يوجد أعضاء </td></tr>";
                                       }
                                       

                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Assign Member To Trainer</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Member Name </th>
                                            <th>Trainer Name </th>
                                            <th> Assigned Date</th>                                           
                                            <th>Delete </th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Member Name </th>
                                            <th> Trainer Name</th>
                                            <th>Assigned Date</th>
                                            <th> Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                        <a href="assignMember.php"><button class="form-control form-control-user">إسناد جديد</button></a>
                                     <?php $sql = "SELECT 
                                        member_trainer.member_id,
                                        member_trainer.trainer_id,
                                        members.full_name AS member_name,
                                        trainers.name AS trainer_name,
                                        member_trainer.assigned_date
                                        FROM member_trainer
                                        JOIN members ON member_trainer.member_id = members.id
                                        JOIN trainers ON member_trainer.trainer_id = trainers.id";

                                        $result = $conn->query($sql);
                                     if($result->num_rows>0){ 
                                     while($row=$result->fetch_assoc()){
                                      echo "<tr>";
                                      echo "<td>".$row['member_name']."</td>";
                                      echo "<td>".$row['trainer_name']."</td>";
                                      echo "<td>".$row['assigned_date']."</td>";

                                      echo "<td>
                                      <a href='deleteAssignment.php?member_id=".$row['member_id']."&trainer_id=".$row['trainer_id']."'>
                                       delete
                                      </a></td>";

                                      echo "<td>
                                      <a href='editAssignment.php?member_id=".$row['member_id']."&trainer_id=".$row['trainer_id']."'>
                                       edit
                                      </a></td>";

                                       echo "</tr>";
                                      }}else{
                                          echo "<tr><td colspan='8'>لم يتم الاسناد   </td></tr>";
                                       }
                                       

                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Trainers</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>  Name </th>
                                            <th> Specialization </th>
                                            <th> Phone</th> 
                                            <th> Email</th> 
                                            <th> Salary</th>                                                                                                                                                                         
                                            <th>Delete </th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name  </th>
                                            <th> Specialization </th>
                                            <th> Phone</th>
                                            <th> Email</th>
                                             <th> Salary</th> 
                                            <th> Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                        
                                         <a href="addtrainer.php"><button class="form-control form-control-user">إضافة مدرب</button></a>
                                     <?php $sql="SELECT * FROM trainers";
                                         $result=$conn->query($sql);
                                     if($result->num_rows>0){ 
                                     while($row=$result->fetch_assoc()){
                                      echo "<tr>";
                                      echo "<td>".$row["name"]."</td>";
                                      echo "<td>".$row["specialization"]."</td>";
                                      echo "<td>".$row["phone"]."</td>";
                                      echo "<td>".$row["email"]."</td>";
                                      echo "<td>".$row["salary"]."</td>";
                                      echo "<td><a href='deletetrainer.php?id=".$row["id"]."'>delete</a></td>";
                                      echo "<td><a href='edittrainer.php?id=".$row["id"]."'>edit</a></td>";
                                      echo "</tr>";
                                      }}else{
                                          echo "<tr><td colspan='8'> لا يوجد مدرب    </td></tr>";
                                       }
                                       

                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Full Name </th>
                                            <th> Amount </th>
                                            <th>  Payment Method</th> 
                                            <th> Payment Date</th>                                                                                                                                                                                                                   
                                            <th>Delete </th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Full Name  </th>
                                            <th> Amount </th>
                                            <th> Payment Method</th>
                                            <th> Payment Date</th>                                          
                                            <th> Delete</th>
                                            <th>Edit </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        
                                        
                                         
                                        <a href='addPayment.php'><button class="form-control form-control-user">إضافة دفعة</button></a>
                                        <?php $sql = "SELECT payments.*, members.full_name
                                        FROM payments
                                        JOIN members ON payments.member_id = members.id";

                                        $result = $conn->query($sql);
                                        if($result->num_rows>0){ 
                                     while($row = $result->fetch_assoc()){
                                     echo "<tr>";
                                     echo "<td>".$row['full_name']."</td>";
                                     echo "<td>".$row['amount']."</td>";
                                     echo "<td>".$row['payment_method']."</td>";
                                     echo "<td>".$row['payment_date']."</td>";
                                     echo "<td><a href='deletepayment.php?id=".$row["id"]."'>delete</a></td>";
                                     echo "<td><a href='editpayment.php?id=".$row["id"]."'>edit</a></td>";
                                     echo "</tr>";
                                     }}else{
                                          echo "<tr><td colspan='8'> لا يوجد مدفوعات    </td></tr>";
                                       }
                                       
                                         $conn->close();
                                        ?>
                                        
                                      
                                     
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  <!--  End Of page Content -->
                </div>
        

               <?php require_once 'includes/footer.html' ;?>
                <!-- End of Content Wrapper -->
            </div>
        <!-- End of Page Wrapper -->
        </div>
    </body>
</html>