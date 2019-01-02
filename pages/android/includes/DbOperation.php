<?php 
/**
 * summary
 */
class DbOperation
{
    /**
     * summary
     */

    private $con;

    public function __construct()
    {
    	require_once dirname(__FILE__).'/DbConnect.php';

    	$db = new DbConnect();

    	$this->con=$db->connect();
    }

    public function createUser($username,$pass,$phone_number,$fullname,$email){
    	if ($this->checkDuplicate($username,$email)) {
    		return 0;
    	}else{
    		$password = md5($pass);
    		$stmt = $this->con->prepare("
                INSERT INTO `user` (`username`, `password`, `phone_number`, `fullname`, `email`, `role_id`) VALUES 
    			(?, ?, ?, ?, ?, '3');
                ");
            
    		$stmt->bind_param("sssss",$username,$password,$phone_number,$fullname,$email);

    		if ($stmt->execute()) {
                return 1;
    		}else{
    			return 2;
    		}
    	}
    }

    public function updateUser($fullname,$email,$phonenumber,$username){
        $stmt = $this->con->prepare("UPDATE `user` SET `fullname`= ? ,`email`= ? ,`phone_number`= ? WHERE `username`= ? ");
        $stmt->bind_param("ssss",$fullname,$email,$phonenumber,$username);
        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }

    }

    public function updateUserBalance($amount,$amount_riel,$username){
        $stmt= $this->con->prepare("UPDATE `account` SET `balance`=?,`balance_riel`=? WHERE username=?");
        $stmt->bind_param("sss",$amount,$amount_riel,$username);
        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function updateVoucher($code){
        $stmt= $this->con->prepare("UPDATE `voucher` SET `status`='Redeemed' WHERE code = ?");
        $stmt->bind_param("s",$code);
        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function updateBusDriver($busid,$username){
        $stmt = $this->con->prepare("UPDATE `bus` SET `username`=? WHERE `bus_id`=?");
        $stmt->bind_param("ss",$username,$busid);
        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function createAccount($username){
        $acc_id = mt_rand(10000,100000);
        $acc_id = $acc_id . $username;
        $stmt = $this->con->prepare("INSERT INTO `account`(`account_id`, `username`) VALUES ( ? , ?)");
        $stmt->bind_param("ss",$acc_id,$username);
        
        if ($stmt->execute()) {
            return 1;
        }else{
            return 2;
        }
    }


    public function userLogin($username,$pass){
    	$password = md5($pass);
    	$stmt = $this->con->prepare("SELECT fullname FROM user where username= ? AND password = ? AND role_id=3");
    	$stmt->bind_param("ss",$username,$password);
    	$stmt->execute();
    	$stmt->store_result();
    	if ($stmt->num_rows>0) {
            return 1;
        }else{
            return false;
        }
    }

    public function driverLogin($username,$pass){
        $password = md5($pass);
        $stmt = $this->con->prepare("SELECT fullname FROM user where username= ? AND password = ? AND role_id=2");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows>0) {
            return 1;
        }else{
            return false;
        }
    }


    public function getUserBalance($username){
        $stmt = $this->con->prepare("SELECT * FROM account WHERE username= ? ");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserByUsername($username){
    	$stmt = $this->con->prepare("SELECT * FROM user WHERE username = ?");
    	$stmt->bind_param("s",$username);
    	$stmt->execute();
    	return $stmt->get_result()->fetch_assoc();
    }

    public function getUserAccount($username){
        $stmt = $this->con->prepare("SELECT account.account_id FROM account JOIN user ON account.username=user.username WHERE user.username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getVoucherAmount($code){
        $stmt = $this->con->prepare("SELECT amount FROM voucher WHERE code = ?");
        $stmt->bind_param("s",$code);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getFare($busid){
        $stmt = $this->con->prepare("SELECT bus.bus_id,bus.plate_no,route.route_id,busfare.fare,busfare.fare_riel FROM bus LEFT JOIN route ON bus.route_id=route.route_id LEFT JOIN busfare ON route.fare_id=busfare.fare_id WHERE bus.bus_id = ?");
        $stmt->bind_param("s",$busid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getDriver($busid){
        $stmt = $this->con->prepare("SELECT `username`FROM `bus` WHERE bus_id=?");
        $stmt->bind_param("s",$busid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getBus(){
        $stmt = $this->con->prepare("SELECT `bus_id` FROM `bus` WHERE username IS NULL AND qr IS NOT NULL");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getBusComplete($busid){
        $stmt = $this->con->prepare("SELECT * FROM `bus` WHERE bus_id=?");
        $stmt->bind_param("s",$busid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getBusTransaction($username,$start,$end){
        //$stmt = $this->con->prepare("SELECT * FROM `bus_transaction` WHERE driver_username=? AND `date_time`>=? AND `date_time`<=?");
        $stmt = $this->con->prepare("SELECT * FROM `bus_transaction` WHERE driver_username=? AND `date_time`BETWEEN ? AND ?");
        $stmt->bind_param("sss",$username,$start,$end);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function checkVoucherAvailability($code){
        $stmt = $this->con->prepare("SELECT * FROM voucher WHERE code = ? AND status='Available'");
        $stmt->bind_param("s",$code);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows>0;
    }

    public function checkDuplicate($username,$email){
    	$stmt = $this->con->prepare("SELECT username FROM user WHERE username = ? OR email = ?");
    	$stmt->bind_param("ss", $username,$email);
    	$stmt->execute();
    	$stmt->store_result();

    	//jika mengembalikan 0 maka user tidak ada , dan sebaliknya
    	return $stmt->num_rows >0 ;
    }

    public function checkDuplicateEmail($username,$email){
        $stmt = $this->con->prepare("SELECT email, username FROM user WHERE username = ? OR email = ?");
        $stmt->bind_param("ss",$username,$email);
        $stmt->execute();
        $stmt->store_result();

        //jika mengembalikan 0 makan user tidak ada , dan sebaliknya
        //return $stmt->num_rows >0 ;

        if ($stmt->num_rows > 1 ) {
            return 0;
        }else{
            return 1;
        }
    }

    public function topUp($topupid,$username,$account_id,$code,$amount){
        $stmt = $this->con->prepare("INSERT INTO `voucher_transaction`(`transaction_id`, `username`, `account_id`, `code`, `amount`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$topupid,$username,$account_id,$code,$amount);

        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function busTransaction($account_id,$bus_id,$fare,$username){
        $stmt = $this->con->prepare("INSERT INTO `bus_transaction`(`account_id`, `bus_id`,`fare`,`driver_username`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$account_id,$bus_id,$fare,$username);
        if ($stmt->execute()) {
            return 1;
        }else{
            return $stmt->error;
        }
    }

    public function driverLogout($busid){
        $stmt = $this->con->prepare("UPDATE `bus` SET `username`=NULL WHERE bus_id=?");
        $stmt->bind_param("s",$busid);
        if ($stmt->execute()) {
            return 1;
        }else{
            return 0;
        }
    }
}
 ?>