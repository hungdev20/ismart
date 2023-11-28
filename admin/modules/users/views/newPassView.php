<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/unitop.vn/back-end/lessons/section-28C/projectmvc.vn/">
    <title>Thiet lap mat khau moi</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 class="page-title">MAT KHAU MOI</h1>
        <form action="" id="form-login" method="POST">
            <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Password">
            <?php echo form_error('password') ?>
            <input type="submit" name="btn_new_pass" id="btn-login" value="Luu mat khau">
            <?php echo form_error('account') ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=reset") ?>" id="lost_pass">Quen mat khau</a>
        <a href="<?php echo base_url("?mod=users&action=reg") ?>" id="lost_pass">Dang ky</a>

    </div>
</body>

</html>