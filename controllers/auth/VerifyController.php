<?php 
class VerifyController extends Controller{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        return $this->viewNomal('auth/verification/email_admin');
    }

    public function verify_email_admin()
    {
        if(isset($_POST['verify_email'])){
            $data['email'] = isset($_POST['email']) ? $this->check_input($_POST['email']) : '';
            $data['verification_code'] = isset($_POST['verification_code']) ? $this->check_input($_POST['verification_code']) : '';

            if($this->userModel->verify_email($data) > 0){
                $_SESSION['admin'] = $this->userModel->get_data_now($data['email']);
                return header('Location: ?c=dashboard');
            }else{
                return header('Location: ?c=verify&email='.$data['email']);
            }
        }
    }

    public function verify_email_user_exp()
    {
        if(!empty($_GET['email']) && !empty($_GET['token'])){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = strtotime(date('Y-m-d H:i:s'));
            $code = $_GET['token'];
            $token = pack("H*",($code));
            $data = explode('_', $token);
            $email = isset($_GET['email']) ? $this->check_input($_GET['email']) : '';
            $data['verification_code'] = isset($_GET['token']) ? $this->check_input($_GET['token']) : '';
            $expire = $data[1] + 86400;

            if($now < $expire){
                if($this->userModel->verify_email_user($email)){
                    $_SESSION['success'] = '<script>alert("Email đã được xác thực")</script>';
                    return header('Location: ?c=login');
                }
            }else{
                die('Het thoi gian xac thuc email');
            }

        }
    }

    public static function verify_admin(){
        if(!isset($_SESSION['admin']) && !isset($_SESSION['staff'])) header('Location: ?c=home');
    }

    public static function verify_user(){
        if(isset($_SESSION['user'])) header('Location: ?c=home');
    }

}
?>