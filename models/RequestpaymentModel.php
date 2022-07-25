<?php 

class RequestpaymentModel extends Database 
{

    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnect();
    }

    public function index()
    {
        $sql = "SELECT * FROM request_payments";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function store($data)
    {
        $sql = "INSERT INTO request_payments (staff_id, money, status, request_day) VALUES (:staff_id, :money, 1, :request_day)";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':staff_id', $data['staff_id'], PDO::PARAM_INT);
        $pre->bindParam(':money', $data['money'], PDO::PARAM_INT);
        $pre->bindParam(':request_day', $data['request_day'], PDO::PARAM_STR);
        $pre->execute();
        return $pre;
    }

    public function update_accept($data)
    {
        $sql = "UPDATE request_payments SET status = 2, payment_day = NOW() WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $pre->execute();
    }

    public function update_cancel($data)
    {
        $sql = "UPDATE request_payments SET status = 3, money = 0, payment_day = NOW() WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $pre->execute();
    }

    

}

?>