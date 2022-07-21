<?php
class HomeController extends Controller
{

    private $room;

    public function __construct()
    {
        $this->room = $this->model('RoomModel');
    }

    public function index()
    {
        $data['rooms'] = $this->room->show_all_rooms();
        return $this->view('home/index', $data);
    }

    public function showAllRooms()
    {
        return $this->view('home/index');
    }

}
?>