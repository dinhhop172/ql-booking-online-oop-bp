<?php 

class BookModel extends Database 
{

    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnect();
    }

    function book_now($data){
        $sql = "INSERT INTO `booking`(`account_id`, `room_id`, `check_in`, `check_out`, `total_day`, `total_price`, `status`) VALUES (:account_id, :room_id, :check_in, :check_out, :total_day, :total_price, 1)";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':account_id', $data['account_id'], PDO::PARAM_INT);
        $pre->bindParam(':room_id', $data['room_id'], PDO::PARAM_INT);
        $pre->bindParam(':check_in', $data['check_in'], PDO::PARAM_STR);
        $pre->bindParam(':check_out', $data['check_out'], PDO::PARAM_STR);
        $pre->bindParam(':total_day', $data['total_day'], PDO::PARAM_STR);
        $pre->bindParam(':total_price', $data['total_price'], PDO::PARAM_STR);
        $pre->execute();
        return $pre;
    }

    public function change_status_room_when_booking($id){
        $sql = "UPDATE rooms SET status = 2 WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

    public function show_all_booking_of_user($id){
        $sql = "SELECT * FROM `booking` WHERE account_id = $id";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cancel_booking($id){
        $sql = "DELETE FROM booking WHERE id = $id";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        return $pre;
    }

    public function get_date_booking_of_user($id){
        $sql = "SELECT id, check_in, check_out FROM booking WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_order_booking($check_in, $check_out, $id){
        $sql = "UPDATE booking SET check_in = '${check_in}', check_out = '${check_out}' WHERE ('${check_in}' >= CURRENT_DATE) AND ('${check_out}' > '${check_in}') AND id = '{$id}'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        return $pre;
    }

    public function edit_booking($id){
        $sql = "SELECT * FROM booking WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_order_booking_two($total_day, $total_price, $id){
        $sql = "UPDATE booking SET total_day = '${total_day}', total_price = '${total_price}' WHERE id = $id";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        return $pre;
    }

    public function tong_doanh_thu(){
        $sql = "SELECT total_price FROM booking bk
        JOIN rooms r ON bk.room_id = r.id";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function show_all_booking(){
        $sql = "SELECT b.id, b.account_id, b.room_id, b.check_in, b.check_out, b.total_day, b.total_price, b.status, a.username, a.email, r.name FROM booking b JOIN accounts a ON b.account_id = a.id JOIN rooms r ON b.room_id = r.id WHERE a.roles = 'user'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function change_status_room($id){
        $sql = "UPDATE rooms r JOIN booking bk ON r.id = bk.room_id SET r.status = 1  WHERE bk.id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

    function update($data){
        $sql = "UPDATE booking SET account_id = :account_id, room_id = :room_id, check_in = :check_in, check_out = :check_out, total_day = :total_day, total_price = :total_price, status = :status WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':account_id', $data['account_id'], PDO::PARAM_INT);
        $pre->bindParam(':room_id', $data['room_id'], PDO::PARAM_INT);
        $pre->bindParam(':check_in', $data['check_in'], PDO::PARAM_STR);
        $pre->bindParam(':check_out', $data['check_out'], PDO::PARAM_STR);
        $pre->bindParam(':total_day', $data['total_day'], PDO::PARAM_STR);
        $pre->bindParam(':total_price', $data['total_price'], PDO::PARAM_STR);
        $pre->bindParam(':status', $data['status'], PDO::PARAM_INT);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

    function delete($id){
        $sql = "DELETE FROM booking WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

    public function change_status_booking_when_payment($id)
    {
        $sql = "UPDATE booking SET status = 2 WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

}

?>