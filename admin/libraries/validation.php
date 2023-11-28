<?php
//check username
function is_username($username){
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($partten, $username))
    return FALSE;
    return true;
}
function is_password($password){
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (!preg_match($partten, $password)) 
    return FALSE;
    return true;
} 
//số điện thoại
//email 
function is_number($phone_number){
    $partten = "/^(09|08|01[2|6|8|9])([0-9]{8})$/";
    if (!preg_match($partten, $phone_number)) 
    return FALSE;
    return true;
}
function is_email($email)  {
    // $partten = "/^[\w_.]{6,32}@([\w]{2,12})(.[a-zA-Z]{2,12})+$/";
    $partten = "/^[\w_.]{6,32}@([\w]{2,12})(.[a-zA-Z]{2,12})+$/";
    if(!preg_match($partten, $email))
    return FALSE;
    return true;
}
//set_value
function set_value($label_field){
     global $$label_field;
    if(!empty($$label_field)) return $$label_field;
}
//form_error
function form_error($label_field){
    global $error;
    if (!empty($error[$label_field])) return "<p class = 'error'>{$error[$label_field]}</p>";
}

?>