
<?php
//Tat ca action se duoc ghi o day

use Aws\ElastiCache\Exception\ElastiCacheException;

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    //khai bao nhu nay thi tat ca cac action se duoc ap dung goi sang phan model
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email-function');
}
function regAction()
{
    global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn_reg'])) {
        #. Phat co
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Khong duoc de trong ho ten";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiem tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Khong duoc de trong ten dang nhap";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Ten dang nhap khong dung dinh dang";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiem tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Khong duoc de trong mat khau";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mat khau khong dung dinh dang";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kiem tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Khong duoc de trong email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email khong dung dinh dang";
            } else {
                $email = $_POST['email'];
            }
        }
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
                    'reg_date' => time()
                );

                add_user($data);
                alter_active_value();
                #2. Gui mail cho nguoi dung trong do co duong link chua ma token
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Chúc mừng bạn đã đăng ký tài khoản học trực tuyến thành công, để active tài khoản bạn vui lòng nhấn vào link sau: $link_active</p>
                <p>Nếu bạn không active thì tài khoản sẽ tự động được xóa sau 24h kể từ khi đăng kí thành công</p>
                <p>Nếu đây không phải email của bạn vui lòng bỏ qua thông tin này</p>";
                send_mail('nguyenmanhhung201102@gmail.com', 'Do thi ngoc anh', 'kich hoat tai khoan he thong UNITOP', $content);

                redirect("?mod=users&action=login");
            } else {
                $error['account'] = 'Email hoac mat khau da bi trung tren he thong';
            }
        }
    }
    load_view('reg');
}
function activeAction() 
{
    $active_token = $_GET['active_token'];
    if (check_token($active_token)) {
        active_account($active_token);
        $link_login = base_url("?mod=users&action=login");
        echo "Ban da kich hoat thanh cong, vui long click vao link sau de dang nhap: <a href ='{$link_login}'>Dang nhap</a>";
    } else {
        echo "Tai khoan cua ban sai hoac la da duoc kich hoat";
    }
}
function loginAction()
{
    global $error, $username, $password, $email, $fullname;
    if (isset($_POST['btn_login'])) {
        #Kiem tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Khong duoc de trong ten dang nhap";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Ten dang nhap khong dung dinh dang";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiem tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Khong duoc de trong mat khau";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mat khau khong dung dinh dang";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #ket luan
        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                if (!empty($_POST['remember_me'])) {
                    setcookie('is_login', true, time(), '/');
                    setcookie('user_login', $username, time(), '/');
                }
                //chuyen huong vao trong he thong 
                redirect("?");
            } else {
                $error['account'] = 'Tai khoan hoac mat khau khong chinh xac';
            }
        }
    }
    load_view('login');
}
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}
// Reset password

function resetAction()
{
    load_view('reset');
}
function resetSuccessAction()
{
    load_view('resetSuccess');
}
function updateAction()
{
    $user_info = get_user_by_username(user_login());
    $user_id = $user_info['user_id'];
    $data = [
        'user_id' => $user_id,
        'user_info' => $user_info
    ];
    load_view('update', $data);
}
function deleteAction()
{
    $id = (int)$_GET['id'];
    delete_user_by_id($id);
    $_SESSION['status'] = 'Bạn đã xóa tạm thời bản ghi thành công';
    redirect("?mod=users&controller=team");
}
