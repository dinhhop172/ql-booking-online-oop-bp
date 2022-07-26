<?php 
class RoomModel extends Database {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnect();
    }

    public function show_all_rooms(){
        $sql = "SELECT * FROM rooms";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_room_by_id($id){
        $sql = "SELECT * FROM rooms WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_room_account_booking($id){
        $sql = "SELECT * FROM rooms WHERE id = :room_id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':room_id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_status_room_when_cancel_booking($id){
        $sql = "UPDATE rooms SET status = 1 WHERE id = $id";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        return $pre;
    }

    public function get_price_room($id){
        $sql = "SELECT price FROM rooms WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function room_available(){
        $sql = "SELECT count(*) as sumroomavailable FROM rooms WHERE status = 1";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function room_booked(){
        $sql = "SELECT count(*) as sumroombooked FROM rooms WHERE status = 2";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete_room($id){
        $sql = "DELETE FROM rooms WHERE id = :id AND status = 1";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $pre = $pre->rowCount();
        return $pre;
    }

    function check_name_exist_create($name){
        $sql = "SELECT * FROM rooms WHERE name = :name";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':name', $name, PDO::PARAM_STR);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function store($data){
        $sql = "INSERT INTO rooms (name, price, status) VALUES (:name, :price, 1)";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $pre->bindParam(':price', $data['price'], PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

    function edit($id){
        $sql = "SELECT * FROM rooms WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function check_name_exist_update($name, $id){
        $sql = "SELECT * FROM rooms WHERE name = :name AND id != :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':name', $name, PDO::PARAM_STR);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_room($data){
        $sql = "UPDATE rooms SET name = :name, price = :price WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $pre->bindParam(':price', $data['price'], PDO::PARAM_INT);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $pre->execute();
        return $pre;
    }

}
?>