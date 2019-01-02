<?php 
/**
 * summary
 */
class DbConnect
{
    /**
     * summary
     */
    private $con;

    public function __construct()
    {
        
    }

    function connect(){
    	include_once dirname(__FILE__).'/Constant.php';
    	$this->con = new mysqli(DBHost,DBUser,DBPass,DBName);


    	if (mysqli_connect_errno()) {
    		echo 'Failed to connect with database'.mysqli_connect_err();
    	}

    	return $this->con;
    }
}
 ?>