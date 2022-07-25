<?php 

class BookingController extends Controller {

    private $booking;
    private $user;
    private $room;

    public function __construct() {
        VerifyController::verify_admin();
        $this->booking = $this->model('BookModel');
        $this->user = $this->model('UserModel');
        $this->room = $this->model('RoomModel');
    }

    public function index() {
        $data = [
            'booking' => $this->booking->show_all_booking()
        ];
        $this->view('admin/booking/index', $data);
    }

    public function edit()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data['booking'] = $this->booking->edit_booking($id);
            $data['get_all_account'] = $this->user->get_all_account();
            $data['get_all_room'] = $this->room->show_all_rooms();
            return $this->view('admin/booking/edit', $data);
        }
    }

    public function update()
    {
        if(isset($_POST['updateBooking'])){
            $data['id'] = isset($_POST['id_booking']) ? $this->check_input($_POST['id_booking']) : '';
            $data['account_id'] = isset($_POST['account_id']) ? $this->check_input($_POST['account_id']) : '';
            $data['room_id'] = isset($_POST['room_id']) ? $this->check_input($_POST['room_id']) : '';
            $data['check_in'] = isset($_POST['check_in']) ? $this->check_input($_POST['check_in']) : '';
            $data['check_out'] = isset($_POST['check_out']) ? $this->check_input($_POST['check_out']) : '';
            $data['total_day'] = isset($_POST['total_day']) ? $this->check_input($_POST['total_day']) : '';
            $data['total_price'] = isset($_POST['total_price']) ? $this->check_input($_POST['total_price']) : '';
            $data['status'] = isset($_POST['status']) ? $this->check_input($_POST['status']) : '';
            
            if (empty($data['account_id'])){
                $error['account_id'] = 'Bạn chưa chon user';
            }
            if (empty($data['room_id'])){
                $error['room_id'] = 'Bạn chưa nhập phong';
            }
            if (empty($data['check_in'])){
                $error['check_in'] = 'Bạn chưa chon check_in';
            }
            if (empty($data['check_out'])){
                $error['check_out'] = 'Bạn chưa chon check_out';
            }
            if (empty($data['total_day'])){
                $error['total_day'] = 'Bạn chưa chon total_day';
            }
            if (empty($data['total_price'])){
                $error['total_price'] = 'Bạn chưa chon total_price';
            }
            if (empty($data['status'])){
                $error['status'] = 'Bạn chưa chon status';
            }

            if(!$error){
                if($this->booking->update($data)){
                    $_SESSION['success'] = '<script>alert("Cập nhật thành công")</script>';
                    header('location: ?c=booking&a=edit&id='.$data['id']);
                }else{
                    $_SESSION['error'] = '<script>alert("Cập nhật thất bại")</script>';
                    header('location: ?c=booking&a=edit&id='.$data['id']);
                }
            }else{
                $_SESSION['error'] = $error;
                $_SESSION['data'] = $data;
                return header('Location: ??c=booking&a=edit&id='.$data['id']);
            }
        }else{
            die('update room error');
        }
    }

    public function destroy()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($this->booking->change_status_room($id)){
                if($this->booking->delete($id)){
                    $_SESSION['success'] = '<script>alert("Xóa thành công")</script>';
                    return header('Location: ?c=booking');
                }
            }else{
                $_SESSION['error'] = '<script>alert("Xóa thất bại")</script>';
                return header('Location: ?c=booking');
            }
        }
    }

}

?>