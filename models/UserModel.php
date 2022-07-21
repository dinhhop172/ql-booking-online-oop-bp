<?php 

class UserModel extends Database {

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

    public function verify_email($data){
        $sql = "UPDATE accounts SET email_verified_at = NOW(), status = 1 WHERE verification_code = :verification_code AND email = :email";
        $pre = $this->conn->prepare($sql);
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

    function verify_email_user($email){
        $sql = "UPDATE accounts SET email_verified_at = NOW(), status = 1 WHERE email = :email";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':email', $email, PDO::PARAM_STR);
        // $pre->bindParam(':verification_code', $data['verification_code'], PDO::PARAM_STR);
        return $pre->execute();
    }

    public function get_user_by_id($id){
        $sql = "SELECT id FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function count_user(){
        $sql = "SELECT * FROM accounts";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->rowCount();
        return $result;
    }

    function show_all_users(){
        $sql = "SELECT * FROM accounts WHERE roles = 'user' OR roles = 'staff'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete_user($id){
        $sql = "DELETE FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(":id", $id);
        return $pre->execute();
    }

    function store($data){
        $verification_code = md5($data['email']).rand(10,9999);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $current_time = date("Y-m-d H:i:s");
        $sql ="INSERT INTO `accounts` (`username`, `password`, `email`, `phone_number`, `sex`, `address`, `roles`, `verification_code`, `email_verified_at`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $pre = $this->conn->prepare($sql);
        return $pre->execute([$data['username'], $data['password'], $data['email'],$data['phone_number'],$data['sex'], $data['address'], $data['roles'], $verification_code, $current_time, 1]);
    }

    function edit($id){
        $sql = "SELECT * FROM accounts WHERE id = :id AND (roles = 'user' OR roles = 'staff')";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_role_by_id($id){
        $sql = "SELECT * FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function update($data){
        $sql = "UPDATE accounts SET username = :username, email = :email, password = :password, phone_number = :phone_number, sex = :sex, address = :address, roles = :roles WHERE id = :id AND (roles= 'user' OR roles = 'staff')";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $pre->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $pre->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $pre->bindParam(':phone_number', $data['phone_number'], PDO::PARAM_STR);
        $pre->bindParam(':sex', $data['sex'], PDO::PARAM_STR);
        $pre->bindParam(':address', $data['address'], PDO::PARAM_STR);
        $pre->bindParam(':roles', $data['roles'], PDO::PARAM_STR);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $pre->execute();
    }


}

?>