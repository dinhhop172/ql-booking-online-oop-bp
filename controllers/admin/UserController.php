<?php 

class UserController extends Controller{

    private $user;

    public function __construct()
    {
        $this->user = $this->model('UserModel');
        VerifyController::verify_admin();
    }

    public function index()
    {
        $data['users_staffs'] = $this->user->show_all_users_staffs();
        $data['users'] = $this->user->show_all_users();
        return $this->view('admin/users/index', $data);
    }

    public function create()
    {
        return $this->view('admin/users/create');
    }

    public function store()
    {
        if(isset($_POST['createUser'])){
            $data['username'] = isset($_POST['username']) ? $this->check_input($_POST['username']) : '';
            $data['email'] = isset($_POST['email']) ? $this->check_input($_POST['email']) : '';
            $data['password'] = isset($_POST['password']) ? $this->check_input($_POST['password']) : '';
            $data['phone_number'] = isset($_POST['phone_number']) ? $this->check_input($_POST['phone_number']) : '';
            $data['sex'] = isset($_POST['sex']) ? $this->check_input($_POST['sex']) : '';
            $data['address'] = isset($_POST['address']) ? $this->check_input($_POST['address']) : '';
            $data['roles'] = isset($_POST['roles']) ? $this->check_input($_POST['roles']) : '';
            $data['staff_id'] = isset($_SESSION['staff']) ? $_SESSION['staff']['id'] : '';

            if (empty($data['email'])){
                $error['email'] = 'Bạn chưa nhập email';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'Email không hợp lệ';
            }elseif($this->user->check_user_exist($data['email'])){
                $error['email'] = 'Email đã tồn tại';
            }
            if (empty($data['password'])){
                $error['password'] = 'Bạn chưa nhập password';
            }else{
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            if (empty($data['phone_number'])){
                $error['phone_number'] = 'Bạn chưa nhập so dien thoai';
            }elseif(!preg_match('/^[0-9]{10}+$/', $data['phone_number'])) {
                $error['phone_number'] = 'Số điện thoại không hợp lệ';
            }
            if(!$error){
                if(isset($_SESSION['admin'])){
                    if($this->user->store($data)){
                        echo '<script>alert("Add user thành công")</script>';
                        echo '<script>window.location.href = "?c=user"</script>';
                    }else{
                        echo '<script>alert("Add user thất bại")</script>';
                        echo '<script>window.location.href = "?c=user&a=create"</script>';
                    }
                }else{
                    if($this->user->staff_store($data)){
                        echo '<script>alert("Add user thành công")</script>';
                        echo '<script>window.location.href = "?c=user"</script>';
                    }else{
                        echo '<script>alert("Add user thất bại")</script>';
                        echo '<script>window.location.href = "?c=user&a=create"</script>';
                    }
                }
                
            }else{
                $_SESSION['error'] = $error;
                $_SESSION['data'] = $data;
                return header('Location: ?c=user&a=create');
            }
        }else{
            die('error');
        }
    }

    public function edit()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data['user'] = $this->user->edit($id);
            $data['roles'] = $this->user->get_role_by_id($id);
            return $this->view('admin/users/edit', $data);
        }else{
            die('Id not found');
        }
    }

    public function update()
    {
        if(isset($_POST['updateUser'])){
            $data['id'] = isset($_POST['id_user']) ? $this->check_input($_POST['id_user']) : '';
            $data['username'] = isset($_POST['username']) ? $this->check_input($_POST['username']) : '';
            $data['email'] = isset($_POST['email']) ? $this->check_input($_POST['email']) : '';
            $data['password'] = isset($_POST['password']) ? $this->check_input($_POST['password']) : '';
            $data['phone_number'] = isset($_POST['phone_number']) ? $this->check_input($_POST['phone_number']) : '';
            $data['sex'] = isset($_POST['sex']) ? $this->check_input($_POST['sex']) : '';
            $data['address'] = isset($_POST['address']) ? $this->check_input($_POST['address']) : '';
            $data['roles'] = isset($_POST['roles']) ? $this->check_input($_POST['roles']) : '';
    
            if (empty($data['email'])){
                $error['email'] = 'Bạn chưa nhập email';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'Email không hợp lệ';
            }
            // elseif(check_user_exist($data['email'], $conn)){
            //     $error['email'] = 'Email đã tồn tại';
            // }
            if (empty($data['password'])){
                $error['password'] = 'Bạn chưa nhập password';
            }elseif($data['password'] != $_POST['re-password']){
                $error['password'] = 'Password không trùng nhau';
            }else{
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            if (empty($data['phone_number'])){
                $error['phone_number'] = 'Bạn chưa nhập so dien thoai';
            }elseif(!preg_match('/^[0-9]{10}+$/', $data['phone_number'])) {
                $error['phone_number'] = 'Số điện thoại không hợp lệ';
            }
            if(!$error){
                if($this->user->update($data)){
                    echo '<script>alert("Cập nhật thành công")</script>';
                    echo '<script>window.location.href = "?c=user"</script>';
                }else{
                    echo '<script>alert("Cập nhật thất bại")</script>';
                    echo '<script>window.location.href = "?c=user"</script>';
                }
            }else{
                $_SESSION['error'] = $error;
                $_SESSION['data'] = $data;
                return header('Location: ?c=user&a=edit&id='.$data['id']);
            }
        }else{
            echo 'ko';
        }
    }

    public function destroy()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($this->user->delete_user($id)){
                echo '<script>alert("Xóa thành công")</script>';
                echo "<script>window.location.href = '?c=user&a=index'</script>";
            }else{
                echo '<script>alert("User đang booking, không thể xóa")</script>';
                echo "<script>window.location.href = '?c=user&a=index'</script>";
            }
        }
    }



}

?>