<?php

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data , ENT_QUOTES , 'UTF-8');
    return $data;
}


function validate_email($email){
    $email=filter_var($email ,FILTER_SANITIZE_EMAIL);
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return $email;
    }
      return false;
}
 
function validate_phone($phone){
    $phone=filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
    $phone=str_replace("-","",$phone);
    if(preg_match("/^05[69][0-9]{7}$/",$phone)){
        return $phone;
    
    }
    return false;
}

function validate_password( $password){
    $pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\w_]).{6,}$/";
    if(preg_match($pattern,$password)){
        return $password;
    }
    return false;
}
?>