<?php 

class VerifyModel extends Database{

    public $conn;

    public function __construct()
    {
        $this->conn = $this->getConnect();
    }

    public function verify_email($data){
        // $sql = "UPDATE accounts SET email_verified_at = NOW(), status = 1 WHERE verification_code = $code AND email = '${email}'";
        $sql = "UPDATE accounts SET email_verified_at = NOW(), status = 1 WHERE verification_code = :verification_code AND email = :email";
        $pre = $this->conn->prepare($sql);
        // $pre->bindParam(':email', $email, PDO::PARAM_STR);
        // $pre->bindParam(':verification_code', $verification_code, PDO::PARAM_INT);
        $pre->execute($data);
        return $pre->rowCount();
        // if ( ! $result ) {
        //     print_r( $pre->errorInfo() );
        //     exit;
        // }
    }

    function get_data_now($email){
        $sql = "SELECT * FROM accounts WHERE email = '${email}'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}

?>