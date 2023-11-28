<?php
function construct()
{
  //    echo "DÙng chung, load đầu tiên";
  load_model('index');
}
function indexAction()
{
  $s = '';
  if (!empty($_GET['s'])) {
    $s = $_GET['s'];
  }
  $status = '';
  if (!empty($_GET['status'])) {
    $status = $_GET['status'];
  }
  if ($status == 'trash') {
    $acts = [
      'restore' => 'Khôi phục',
      'forceDelete' => 'Xóa vĩnh viễn',
    ];
    $list_users = get_list_users("`deleted_at` IS NOT NULL && (`username` LIKE '%{$s}%' OR `fullname` LIKE '%{$s}%' OR `email` LIKE '%{$s}%' OR `phone_number` LIKE '%{$s}%'OR `address` LIKE '%{$s}%')");
  } else {
    $acts = [
      'delete' => 'Xóa tạm thời'
    ];
    $list_users = get_list_users("`deleted_at` IS NULL && (`username` LIKE '%{$s}%' OR `fullname` LIKE '%{$s}%' OR `email` LIKE '%{$s}%' OR `phone_number` LIKE '%{$s}%'OR `address` LIKE '%{$s}%')");
  }
  $active = count(get_list_users("`deleted_at` IS NULL"));
  $trash = count(get_list_users("`deleted_at` IS NOT NULL"));
  $user_info = get_user_by_username(user_login());
  $user_id = $user_info['user_id'];
  $data = [
    'list_users' => $list_users,
    'active' => $active,
    'trash' => $trash,
    'acts' => $acts,
    'status' => !empty($status) ? $status : '',
    'user_id' => $user_id,
    's' => $s
  ];
  load_view('index', $data);
}
function actionAction()
{
  if (!empty($_POST['checkItem'])) {
    $checkItems = $_POST['checkItem'];
    $user_info = get_user_by_username(user_login());
    $user_id = $user_info['user_id'];
    foreach ($checkItems as $key => $value) {
      if ($value == $user_id) {
        unset($checkItems[$key]);
      }
    }
    if ($checkItems) {
      if ($_POST['actions']) {
        $action = $_POST['actions'];
        if ($action == 'delete') {
          foreach ($checkItems as $key => $id) {
            delete_user_by_id($id);
          }
          $_SESSION['status'] = 'Đã xóa tạm thời tài khoản thành công';
        } else if ($action == 'restore') {
          foreach ($checkItems as $key => $id) {
            restore_user_by_id($id);
          }
          $_SESSION['status'] = 'Đã khôi phục tài khoản thành công';
        } else {
          foreach ($checkItems as $key => $id) {
            forceDelete_user_by_id($id);
          }
          $_SESSION['status'] = 'Đã xóa vĩnh viễn tài khoản thành công';
        }
      } else {
        $_SESSION['status'] = 'Bạn cần chọn thao tác để áp dụng lên bản ghi đã chọn';
      }
    } else {
      $_SESSION['status'] = 'Bạn không được phép xóa bản ghi của chính mình';
    }
  } else {
    $_SESSION['status'] = 'Bạn cần chọn bản ghi trước khi thực hiện thao tác';
  }
  redirect($_SERVER['HTTP_REFERER']);
}
