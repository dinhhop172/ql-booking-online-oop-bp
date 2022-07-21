<?php
    class RegisterController extends Controller {
        
        use Sendmail;

        private $modelUser;

        public function __construct()
        {
            $this->modelUser = $this->model('UserModel');
        }

        public function index()
        {
            return $this->view('auth/register/index');
        }

        public function subRegister()
        {
            $verification_code = 'user';
            if(isset($_POST['register'])) {
                $data['username'] =  $this->check_input($_POST['username']);
                $data['email'] = isset($_POST['email']) ? $this->check_input($_POST['email']) : $_SESSION['error']['email'] = 'Email khong hop le';
                $data['password'] = isset($_POST['password']) ? $this->check_input($_POST['password']) : '';
                $data['phone_number'] = $this->check_input($_POST['phone_number']);
                $data['sex'] = $this->check_input($_POST['sex']);
                $data['address'] = $this->check_input($_POST['address']);
                $token = md5($data['email']).rand(10,9999);
                $_COOKIE[$verification_code] = $token;
                $data['verification_code'] = $_COOKIE[$verification_code];

                if (empty($data['username'])){
                    $error['username'] = 'Bạn chưa nhập tên';
                }
                if (empty($data['email'])){
                    $error['email'] = 'Bạn chưa nhập email';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $error['email'] = 'Email không hợp lệ';
                }
                if (empty($data['password'])){
                    $error['password'] = 'Bạn chưa nhập password';
                }
                if (empty($data['phone_number'])){
                    $error['phone_number'] = 'Bạn chưa nhập so dien thoai';
                }elseif(!preg_match('/^[0-9]{10}+$/', $data['phone_number'])) {
                    $error['phone_number'] = 'Số điện thoại không hợp lệ';
                }
                if (empty($data['sex'])){
                    $error['sex'] = 'Bạn chưa nhập sex';
                }
                if (empty($data['address'])){
                    $error['address'] = 'Bạn chưa nhập address';
                }
                if (empty($error)){
                    if(!$this->modelUser->check_user_exist($data['email'])){
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        if($this->modelUser->regester($data)){
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $now = date("Y-m-d H:i:s");
                            $number_time_now = strtotime($now);
                            $last_id = $this->modelUser->conn->lastInsertId();
                            $code = bin2hex($last_id . '_' . $number_time_now);
                            $body = '<p>Vui lòng click vào <a href="http://ql-booking-oop.com/?c=verify&a=verify_email_user_exp&email='.$data['email'].'&token='.$code.'">đây</a> để xác thực, email này chỉ có giá trị đến 24 tiếng sau.</p>';
                            
                            $this->sendToMail($data['email'], $data['username'], $body);

                            $_SESSION['success'] = '<script>alert("Đăng ký thành công, vui lòng kiểm tra email để xác thực")</script>';
                                    
                            return header('Location: ?c=login');
                        }else{
                            $_SESSION['error']['error'] = 'Dang ky that bai';
                            return header('Location: ?c=register');
                        }
                    }else{
                        $_SESSION['error']['email'] = 'Email da ton tai';
                        $_SESSION['data'] = $data;
                        return header('Location: ?c=register');
                    }
                } else {
                    $_SESSION['error'] = $error;
                    $_SESSION['data'] = $data;
                    return header('Location: ?c=register');
                }
            }else{
                $_SESSION['error']['post'] = 'Không thể đăng ký, vui lòng thử lại sau';
            }
        }

    }
?>