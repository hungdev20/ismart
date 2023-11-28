<?php
//Noi lam viec voi database
function user_exists($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' OR `email` = '{$email}'");

    if ($check_user > 0)
        return true;
    return false;
}
function check_user_exists_by_id($id)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `user_id` = {$id} ");

    if ($check_user > 0)
        return true;
    return false;
}
function add_user($data)
{

    return db_insert("tbl_users", $data);
}

function get_list_users($condition)
{
    $result = db_fetch_array("SELECT * FROM `tbl_users` WHERE {$condition}");
    // return ("SELECT * FROM `tbl_users` {$condition}");
    return $result;
}
function get_users_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
function get_user_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $item;
}
function delete_user_by_id($id)
{
    db_update('tbl_users', array('deleted_at' => date("Y-m-d,h:i:s", time())), "`user_id` = {$id}");
}
function forceDelete_user_by_id($id)
{
    if (check_user_exists_by_id($id)) {
        db_delete("tbl_users", "`user_id` = {$id}");
    }
}
function restore_user_by_id($id)
{
    db_update('tbl_users', array('deleted_at' => NULL), "`user_id` = {$id}");
}
function check_token($active_token)
{
    $check_token = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` ='{$active_token}' && `is_active` = '0'");

    if ($check_token > 0)
        return true;
    return false;
}
function active_account($active_token)
{
    db_update('tbl_users', array('is_active' => 1), "`active_token` = '{$active_token}'");
}
function alter_active_value()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time_check = time() - 60;
    db_delete('tbl_users', "`is_active` = '0' AND `reg_date` < '{$time_check}'");
}
//reset
function check_email($email)
{
    $record = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    if ($record > 0) {
        return true;
        return false;
    }
}
function update_reset_token($data, $email)
{
    db_update('tbl_users', $data, "`email` = '{$email}'");
}
function check_reset_token($reset_token)
{
    $record = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_token` = '{$reset_token}'");
    if ($record > 0) {
        return true;
        return false;
    }
}
function update_pass($data, $reset_token)
{
    db_update('tbl_users', $data, "`reset_token` = '{$reset_token}'");
    redirect("?mod=users&action=resetSuccess");
}
