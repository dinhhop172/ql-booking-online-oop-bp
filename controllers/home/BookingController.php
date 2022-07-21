<?php 

class BookingController extends Controller
{
    // private $room;
    private static $user;
    private static $room;
    private $booking;

    public function __construct()
    {
        static::$user = $this->model('UserModel');
        static::$room = $this->model('RoomModel');
        $this->booking = $this->model('BookModel');
    }

    public function index()
    {
        return $this->viewNomal('home/booking/index');
    }

    public static function getUserById($id)
    {
        return static::$user->get_user_by_id($id);
    }

    public static function getRoomById($id)
    {
        return static::$room->get_room_by_id($id);
    }

    public function subBooking()
    {
        if(isset($_POST['account_id']) && isset($_POST['room_id'])){
            $data['account_id'] = $_POST['account_id'];
            $data['room_id'] = $_POST['room_id'];
            if(isset($_POST['book_now'])){
                $data['check_in'] = isset($_POST['check_in']) ? $this->check_input($_POST['check_in']) : '';
                $data['check_out'] = isset($_POST['check_out']) ? $this->check_input($_POST['check_out']) : '';
                (int)$price = isset($_POST['price']) ? $this->check_input($_POST['price']) : null;
                
                $datetime1 = strtotime($data['check_in']);
                $datetime2 = strtotime($data['check_out']);
                
                $secs = $datetime2 - $datetime1;
                $data['total_day'] = $secs / 86400;
                $data['total_price'] = $data['total_day'] * $price;

                if (empty($data['check_in'])){
                    $error['check_in'] = 'Bạn chưa chon check_in';
                }
                if (empty($data['check_out'])){
                    $error['check_out'] = 'Bạn chưa chon check_out';
                }
                if(!$error){
                    if($this->booking->book_now($data)){
                        if($this->booking->change_status_room_when_booking($data['room_id'])){
                            echo '<script>alert("Đặt phòng thành công")</script>';
                            echo '<script>window.location.href = "../../index.php"</script>';
                        }
                        
                    }else{
                        echo '<script>alert("Đặt phòng thất bại")</script>';
                        echo '<script>window.location.href = "../../index.php"</script>';
                    }
                }
            }else{
                echo 'not button booking';
            }
        }else{
            echo 'ko co user_id va room_id';
        }
    }

    public function showViewUserBooked()
    {
        $id = $_SESSION['user']['id'];
        $data['user-booked'] = $this->booking->show_all_booking_of_user($id);
        return $this->viewNomal('home/booking/show_user_booked', $data);
    }

    public static function showRoomAccountBooked($id)
    {
        return static::$room->get_room_account_booking($id);
    }

    public function cancelBooking()
    {
        if(isset($_GET['id_booking']) && isset($_GET['id_room'])){
            $id_booking = $_GET['id_booking'];
            $id_room = $_GET['id_room'];
            if(static::$room->update_status_room_when_cancel_booking($id_room)){
                if($this->booking->cancel_booking($id_booking)){
                    $_SESSION['success'] = '<script>alert("Xóa thành công")</script>';
                    return header('Location: ?c=home');
                }else{
                    $_SESSION['error'] = '<script>alert("Xóa thất bại")</script>';
                    return header('Location: ?c=home');
                }
            }else{
                $_SESSION['error'] = '<script>alert("Xóa thất bại")</script>';
                return header('Location: ?c=home');
            }
        }
    }

    public function showEditRoomBooked()
    {
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
            $data = $this->booking->get_date_booking_of_user($id);
            return $this->viewNomal('home/booking/edit_room_booked', $data);
        }else{
            return header('Location: ?c=home');
        }
    }

    public function editRoomBooked()
    {
        if(isset($_POST['update_booking_user'])){
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : '';
            $check_out = isset($_POST['check_out']) ? $_POST['check_out'] : '';
    
            if($this->booking->update_order_booking($check_in, $check_out, $id)){
                $data_by_id = $this->booking->edit_booking($id);
                
                $data['check_in'] = strtotime($data_by_id['check_in']);
                $data['check_out'] = strtotime($data_by_id['check_out']);
                (int)$data['price'] = static::$room->get_price_room($data_by_id['room_id'])['price'];
                
                // var_dump($data);exit;
                $secs = $data['check_out'] - $data['check_in'];
                $data['total_day'] = $secs / 86400;
                $data['total_price'] = $data['total_day'] * $data['price'];
                if($this->booking->update_order_booking_two($data['total_day'], $data['total_price'], $id)){
                    echo '<script>alert("Update thanh cong")</script>';
                    echo '<script>window.location.href = "?c=booking&a=showViewUserBooked"</script>';
                }
    
            }else{
                echo '<script>alert("Update that bai")</script>';
                echo '<script>window.location.href = "?c=booking&a=showViewUserBooked"</script>';
            }
            
        }
    }

}

?>