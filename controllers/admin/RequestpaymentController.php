<?php 

class RequestpaymentController extends Controller 
{

    private $request_payment;
    private $staff;

    public function __construct()
    {
        VerifyController::verify_admin();
        $this->request_payment = $this->model('RequestpaymentModel');
        $this->staff = $this->model('UserModel');
    }

    public function index()
    {
        $data = [
            'request_payments' => $this->request_payment->index(),
            'staff' => $this->staff->get_staff_has_user(),
        ];
        $this->view('admin/request_payment/index', $data);
    }

    public function store()
    {
        if(isset($_POST['withdrawal']) && !empty($_POST['money']) ){
            if(isset($_SESSION['staff'])){
                $money_staff = $this->staff->get_money_of_staff_by_id($_SESSION['staff']['id']);
                (int)$data['staff_id'] = $_SESSION['staff']['id'];
                $money = $money_staff['money'];
            }
            $data['money'] = $_POST['money'];
            $data['request_day'] = date('Y-m-d H:i:s');
            
            $now = date("m");
            $month = $this->staff->get_request_day_of_staff($data['staff_id']);
            // var_dump($this->staff->get_status_reject($data));exit;
            // var_dump($now,$month);exit;
            if($data['money'] <= $money){
                if(($now != $month['month']) || $month['status'] == 3){
                    $data['tientru'] = $money - $data['money'];

                    if($this->request_payment->store($data)){
                        if($this->staff->update_meney_of_staff($data['staff_id'], $data['tientru'])){
                            echo "<script>alert('Gửi yêu cầu rút tiền thành công')</script>";
                            echo "<script>window.location.href= '?c=staff&a=show_withdrawal&id=".$data['staff_id']."' </script>";
                        }
                    }else{
                        echo "<script>alert('Gửi yêu cầu rút tiền thất bại')</script>";
                        echo "<script>window.location.href= '?c=staff&a=show_withdrawal&id=".$data['staff_id']."' </script>";
                    }

                }else{
                    echo "<script>alert('Chỉ gửi yêu cầu rút tiền một lần trong tháng')</script>";
                    echo "<script>window.location.href= '?c=staff&a=show_withdrawal&id=".$data['staff_id']."' </script>";
                }
            }else{
                echo "<script>alert('Không thể lớn hơn số tiền có')</script>";
                echo "<script>window.location.href= '?c=staff&a=show_withdrawal&id=".$data['staff_id']."'</script>";
            }
        }
    }

    public function update_accept()
    {
        if(isset($_POST['update_accept']) && !empty($_POST['request_id'])){
            $data['id'] = $_POST['request_id'];
            if($this->request_payment->update_accept($data)){
                echo "<script>alert('Đã chấp nhận yêu cầu rút tiền')</script>";
                echo "<script>window.location.href= '?c=requestpayment' </script>";
            }
        }
    }

    public function update_cancel()
    {
        if(isset($_POST['update_cancel']) && !empty($_POST['cancel_id'])){
            $data['id'] = $_POST['cancel_id'];
            $data['staff_id'] = $_POST['staff_id'];
            $data['money'] = $_POST['money'];
            // var_dump($data);exit;
            // var_dump($this->staff->staff_get_money_when_admin_reject($money, $id));exit;
            if($this->staff->staff_get_money_when_admin_reject($data)){
                    if($this->request_payment->update_cancel($data)){
                    echo "<script>alert('Đã từ chối rút tiền')</script>";
                    echo "<script>window.location.href= '?c=requestpayment' </script>";
                }
            }
        }
    }

}

?>