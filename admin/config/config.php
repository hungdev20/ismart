<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * ---------------------------------------------------------
 * BASE URL
 * ---------------------------------------------------------
 * Cấu hình đường dẫn gốc của ứng dụng
 * Ví dụ: 
 * http://hocweb123.com đường dẫn chạy online 
 * http://localhost/yourproject.com đường dẫn dự án ở local
 * 
 */
// duong dan co ban cua he thong
$config['base_url'] = "http://localhost/unitop.vn/back-end/lessons/section-28C/projectmvc.vn/";

// di vao mac dinh
$config['default_module'] = 'home';
$config['default_controller'] = 'index';
$config['default_action'] = 'index';












