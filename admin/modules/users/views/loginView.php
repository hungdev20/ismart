<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/unitop.vn/back-end/lessons/section-28C/projectmvc.vn/">
    <title>Dang Nhap</title>
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div id="wp-form-login">
        <h1 class="page-title">DANG NHAP</h1>
        <form action="" id="form-login" method="POST">
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username">
            <?php echo form_error('username') ?>
            <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>" placeholder="Password">
            <?php echo form_error('password') ?>             
            <input type="submit" name="btn_login" id="btn-login" value="DANG NHAP">
            <?php echo form_error('account') ?>
        </form>
    </div>
</body>

</html>