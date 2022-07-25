<?php

class StaffController extends Controller
{
    private $staff;

    public function __construct()
    {
        VerifyController::verify_admin();
        $this->staff = $this->model('UserModel');
    }

    public function index()
    {
        $data = [
            'staff' => $this->staff->get_staff_has_user()
        ];
        return $this->view('admin/staffs/index', $data);
    }

    public function update_percent()
    {
        if (isset($_POST['update_percent']) && !empty($_POST['percent']) && !empty($_POST['staff_id'])) {
            $data['percent'] = $_POST['percent'];
            $data['id'] = $_POST['staff_id'];
            if($this->staff->update_percent($data)){
                echo "<script>alert('Cập nhật thành công')</script>";
                echo "<script>window.location.href= '?c=staff' </script>";
            }
        }
    }

    public function show_withdrawal()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $data = $this->staff->get_percent_money_of_staff_by_id($id);
            return $this->view('admin/staffs/show_request', $data);
        }else{
            echo "<script>alert('Bạn chưa chọn nhân viên')</script>";
            echo "<script>window.location.href= '?c=dashboard' </script>";
        }
    }
}

?>