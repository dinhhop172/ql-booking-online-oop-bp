<?php 

class LoginModel extends Database{

    public $conn;

    public function __construct()
    {
        $this->conn = $this->getConnect();
    }

    public function check_user_exist($email){
        $sql = "SELECT * FROM accounts WHERE email = '$email'";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(1, $email, PDO::PARAM_STR);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function set_verify_code_admin($data){
        $sql = "UPDATE accounts SET verification_code = :verification_code WHERE email = :email";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $pre->bindParam(':verification_code', $data['verification_code'], PDO::PARAM_STR);
        return $pre->execute();
    }

    public function check_verify_null($email){
        $sql = "SELECT accounts.email_verified_at FROM accounts WHERE email = '${email}'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_verified_at($email){
        $sql = "UPDATE accounts SET email_verified_at = NULL WHERE email = '${email}'";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':email', $email, PDO::PARAM_STR);
        return $pre->execute();
    }

}

?>