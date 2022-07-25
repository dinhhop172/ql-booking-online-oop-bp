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

    public function get_data_now($email){
        $sql = "SELECT * FROM accounts WHERE email = '${email}'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function verify_email_user($email){
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

    public function count_user(){
        $sql = "SELECT * FROM accounts";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->rowCount();
        return $result;
    }

    public function show_all_users_staffs(){
        $sql = "SELECT * FROM accounts WHERE roles = 'user' OR roles = 'staff'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function show_all_users(){
        $sql = "SELECT * FROM accounts WHERE roles = 'user'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_user($id){
        $sql = "DELETE FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(":id", $id);
        return $pre->execute();
    }

    public function store($data){
        $verification_code = md5($data['email']).rand(10,9999);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $current_time = date("Y-m-d H:i:s");
        $sql ="INSERT INTO `accounts` (`username`, `password`, `email`, `phone_number`, `sex`, `address`, `roles`, `verification_code`, `email_verified_at`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $pre = $this->conn->prepare($sql);
        return $pre->execute([$data['username'], $data['password'], $data['email'],$data['phone_number'],$data['sex'], $data['address'], $data['roles'], $verification_code, $current_time, 1]);
    }

    public function staff_store($data){
        $verification_code = md5($data['email']).rand(10,9999);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $current_time = date("Y-m-d H:i:s");
        $sql ="INSERT INTO `accounts` (`username`, `password`, `email`, `phone_number`, `sex`, `address`, `roles`, `verification_code`, `email_verified_at`, `staff_id`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $pre = $this->conn->prepare($sql);
        return $pre->execute([$data['username'], $data['password'], $data['email'],$data['phone_number'],$data['sex'], $data['address'], $data['roles'], $verification_code, $current_time, $data['staff_id'], 1]);
    }

    public function edit($id){
        $sql = "SELECT * FROM accounts WHERE id = :id AND (roles = 'user' OR roles = 'staff')";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_role_by_id($id){
        $sql = "SELECT * FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($data){
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

    public function get_all_account(){
        $sql = "SELECT * FROM accounts WHERE roles = 'user'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_staff_has_user()
    {
        $sql = "SELECT * FROM accounts WHERE roles = 'staff'";
        $pre = $this->conn->prepare($sql);
        $pre->execute();
        $result = $pre->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_percent($data)
    {
        $sql = "UPDATE accounts SET percent = :percent WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':percent', $data['percent'], PDO::PARAM_INT);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $pre->execute();
    }

    public function update_staff_money($data)
    {
        $sql = "UPDATE accounts SET money = :money WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':money', $data['money'], PDO::PARAM_INT);
        $pre->bindParam(':id', $data['id'], PDO::PARAM_INT);
        return $pre->execute();
    }

    public function get_staff_id_from_account($id)
    {
        $sql = "SELECT staff_id FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_percent_money_of_staff_by_id($id)
    {
        $sql = "SELECT percent, money FROM accounts WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_meney_of_staff($id, $money)
    {
        $sql = "UPDATE accounts SET money = :money WHERE id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':money', $money, PDO::PARAM_INT);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        return $pre->execute();
    }

    public function get_money_of_staff_by_id($id)
    {
        $sql = "SELECT money FROM accounts WHERE roles = 'staff' AND id = :id";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();     
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function staff_get_money_when_admin_reject($data)
    {
        $sql = "UPDATE `accounts` SET money = money + ? WHERE roles = 'staff' AND id = ?";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(1, $data['money'], PDO::PARAM_STR);
        $pre->bindParam(2, $data['staff_id'], PDO::PARAM_STR);
        $pre->execute();
        return $pre;
    }

    public function get_request_day_of_staff($id)
    {
        $sql = "SELECT status, MONTH(request_day) as month FROM request_payments WHERE staff_id = :id ORDER BY id DESC";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(':id', $id, PDO::PARAM_INT);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_status_reject($data)
    {
        $sql = "SELECT * FROM request_payments WHERE status = 3 AND staff_id = ?";
        $pre = $this->conn->prepare($sql);
        $pre->bindParam(1, $data['staff_id'], PDO::PARAM_STR);
        $pre->execute();
        $result = $pre->fetch(PDO::FETCH_ASSOC);
        return $result;
    }



}

?>