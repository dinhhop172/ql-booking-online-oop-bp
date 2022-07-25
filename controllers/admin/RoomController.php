<?php 

class RoomController extends Controller {

    private $room;

    public function __construct() {
        VerifyController::verify_admin();
        $this->room = $this->model('RoomModel');
    }

    public function index() {
        $data = [
            'rooms' => $this->room->show_all_rooms()
        ];
        $this->view('admin/rooms/index', $data);
    }

    public function create()
    {
        return $this->view('admin/rooms/create');
    }

    public function store()
    {
        if(isset($_POST['createRoom'])){
            $data['name'] = isset($_POST['name']) ? $this->check_input($_POST['name']) : '';
            $data['price'] = isset($_POST['price']) ? $this->check_input($_POST['price']) : '';
    
            if (empty($data['name'])){
                $error['name'] = "Bạn chưa nhập name";
            }else{
                $check_name = $this->room->check_name_exist_create($data['name']);
                if($check_name){
                    $error['name'] = "Tên phòng đã tồn tại";
                }
            }
            if (empty($data['price'])){
                $error['price'] = 'Bạn chưa nhập price';
            }
            if(!$error){
                if($this->room->store($data)){
                    $_SESSION['success'] = '<script>alert("Tao room thành công")</script>';
                    header('location: ?c=room');
                }else{
                    $_SESSION['error'] = '<script>alert("Tao room thất bại")</script>';
                    header('location: ?c=room');
                }
            }else{
                $_SESSION['error'] = $error;
                $_SESSION['data'] = $data;
                return header('Location: ?c=room&a=create');
            }
        }else{
            die('Create room error');
        }
    }

    public function edit()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data['room'] = $this->room->edit($id);
            return $this->view('admin/rooms/edit', $data);
        }
    }

    public function update()
    {
        if(isset($_POST['updateRoom'])){
            $data['id'] = isset($_POST['id_room']) ? $this->check_input($_POST['id_room']) : '';
            $data['name'] = isset($_POST['name']) ? $this->check_input($_POST['name']) : '';
            $data['price'] = isset($_POST['price']) ? $this->check_input($_POST['price']) : '';
    
            if (empty($data['name'])){
                $error['name'] = 'Bạn chưa nhập name';
            }else{
                $check_name = $this->room->check_name_exist_update($data['name'], $data['id']);
                if($check_name){
                    $error['name'] = 'Tên phòng đã tồn tại';
                }
            }
            if (empty($data['price'])){
                $error['price'] = 'Bạn chưa nhập price';
            }
            if(!$error){
                if($this->room->update_room($data)){
                    $_SESSION['success'] = '<script>alert("Cập nhật thành công")</script>';
                    header('location: ?c=room');
                }else{
                    $_SESSION['error'] = '<script>alert("Cập nhật thất bại")</script>';
                    header('location: ?c=room');
                }
            }else{
                $_SESSION['error'] = $error;
                $_SESSION['data'] = $data;
                return header('Location: ?c=room&a=edit&id='.$data['id']);
            }
        }else{
            die('update room error');
        }
    }

    public function destroy()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($this->room->delete_room($id) > 0){
                $_SESSION['success'] = '<script>alert("Xóa thành công")</script>';
                return header('Location: ?c=room');
            }else{
                $_SESSION['error'] = '<script>alert("Phòng đang được book, không thể xóa")</script>';
                return header('Location: ?c=room');
            }
        }
    }

}

?>