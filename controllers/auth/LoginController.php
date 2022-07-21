<?php
    class LoginController extends Controller{
        
        use Sendmail;

        private $modelUser;

        public function __construct()
        {
            $this->modelUser = $this->model('UserModel');
        }

        public function index()
        {
            return $this->view('auth/login/index');
        }

        public function subLogin()
        {
            if(isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])){
                $email = isset($_POST['email']) ? $this->check_input($_POST['email']) : '';
                $pass = isset($_POST['password']) ? $this->check_input($_POST['password']) : '';
                $loggerUser = $this->modelUser->check_user_exist($email);
                
                if($this->modelUser->check_user_exist($email) != null){
                    if(password_verify($pass, $loggerUser['password'])){
                        if(($loggerUser['roles'] == 'user') && $loggerUser['email_verified_at'] == null){
                            $_SESSION['user'] = $loggerUser;
                            $_SESSION['verify_email'] = "<script>alert('Please verify your email first')</script>";
                            return header('Location: ?c=home');
                        }
                        if(($loggerUser['roles'] == 'user') && $loggerUser['email_verified_at'] != null){
                            $_SESSION['user'] = $loggerUser;
                            return header('Location: ?c=home');
                        }
                        if($loggerUser['roles'] == 'staff'){
                            $_SESSION['staff'] = $loggerUser;
                            return header('Location: ?c=dashboard');
                        }
                        if($loggerUser['roles'] == 'admin'){
                            $_SESSION['admin'] = $loggerUser;
                            $verification_code = 'admin';
                            $_COOKIE[$verification_code] = substr(number_format(time() * rand(),0,'',''),0,6);
                            $data['verification_code'] = $_COOKIE[$verification_code];
                            $data['email'] = $email;
                            $body = '<p>Your verification code is: <b style="font-size: 30px">'.$data['verification_code'].'</b></p>';
                            if($this->modelUser->set_verify_code_admin($data)){
                                $this->sendToMail($email, $loggerUser['username'], $body);
                                return header("Location: ?c=verify&email=".$data['email']);
                            }
                        }
                    }else{
                        $_SESSION['error'] = 'Mat khau khong dung';
                        $_SESSION['email'] = $email;
                        return header('Location: ?c=login');
                    }
                }else{
                    $_SESSION['error'] = 'Tài khoản hoac mat khau không chinh xac';
                    return header('Location: ?c=login');
                }
            }else{
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
                return header('Location: ?c=login');
            }
        }

        public function logout()
        {
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
                return header('Location: ?c=home');
            }elseif(isset($_SESSION['staff'])){
                unset($_SESSION['staff']);
                return header('Location: ?c=home');
            }elseif(isset($_SESSION['admin'])){
                if($this->modelUser->check_verify_null($_SESSION['admin']['email'])['email_verified_at'] != null){
                    $this->modelUser->delete_verified_at($_SESSION['admin']['email']);
                    unset($_SESSION['admin']);
                    return header('Location: ?c=home');
                }
                // var_dump($this->modelUser->check_verify_null($_SESSION['admin']['email'])); exit;
                // echo check_verify_null($_SESSION['admin']['email'],$conn)['email_verified_at'] == null ? 'ok no nulkl' : 'no ko null';
            }
        }

    }
?>