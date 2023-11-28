<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/unitop.vn/back-end/lessons/section-28C/projectmvc.vn/">
    <title>Dang ky</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 class="page-title">DANG KY TAI KHOAN</h1>
        <form action="" id="form-login" method="POST">
            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fulname') ?>" placeholder="Fullname">
            <?php echo form_error('fullname') ?>
            <input type="text" name="email" id="email" value="" placeholder="Email"> <br>
            <?php
            echo  form_error('email');
            ?>
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" id="password" value="" placeholder="Password">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn_reg" id="btn-login" value="DANG KY">
            <?php echo form_error('account') ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=login")?>" id="lost-pass">Dang nhap</a>
    </div>
</body>

</html>