<?php
function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    //khai bao nhu nay thi tat ca cac action se duoc ap dung goi sang phan model
    // load_model('index');
}
function indexAction()
{
    load_view('index');
}
function updateAction()
{
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $result = array(
        'username' => $username,
        'fullname' => $fullname
    );
    echo json_encode($result);
    
}
