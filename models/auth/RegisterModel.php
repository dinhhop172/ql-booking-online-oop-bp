<?php 

class RegisterModel extends Database{

    public $conn;

    public function __construct()
    {
        $this->conn = $this->getConnect();
    }

    public function check_user_exist($email){
        $sql = "SELECT * FROM account WHERE email = ?";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam('1', $email, PDO::PARAM_STR);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function regester($data) {
        $sql = "INSERT INTO accounts (username, password, email, phone_number, sex, address, verification_code, status) VALUES (:username, :password, :email, :phone_number, :sex, :address, :verification_code, 0)";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $pre->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $pre->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $pre->bindParam(':phone_number', $data['phone_number'], PDO::PARAM_INT);
        $pre->bindParam(':sex', $data['sex'], PDO::PARAM_STR);
        $pre->bindParam(':address', $data['address'], PDO::PARAM_STR);
        $pre->bindParam(':verification_code', $data['verification_code'], PDO::PARAM_STR);
        return $pre->execute();
    }
    

}

?>