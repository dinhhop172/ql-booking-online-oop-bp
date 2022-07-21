<?php

class DashboardController extends Controller{

    private $user;
    private $booking;
    private $room;

    public function __construct()
    {
        $this->user = $this->model('UserModel');
        $this->booking = $this->model('BookModel');
        $this->room = $this->model('RoomModel');
        VerifyController::verify_admin();
    }

    public function index()
    {
        $data['countUser'] = $this->user->count_user();
        $data['doanh_thu'] = $this->booking->tong_doanh_thu();
        $data['roomAvailable'] = $this->room->room_available();
        $data['roomBooked'] = $this->room->room_booked();

        return $this->view('admin/index', $data);
    }


}
?>