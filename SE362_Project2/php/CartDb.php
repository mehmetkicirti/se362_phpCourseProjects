<?php


class CartDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    // class constructor
    public function __construct(
        $dbname = "Productdb",
        $tablename = "Carttb",
        $servername = "localhost",
        $username = "root",
        $password = "12345678"
    ) {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // check connection
        if (!$this->con) {
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if (mysqli_query($this->con, $sql)) {

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // sql to create new table
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                              (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                               product_id INT (11) NOT NULL,
                               product_name VARCHAR (25) NOT NULL,
                               product_quantity INT(11) NOT NULL,
                               product_totalPrice FLOAT
                                );
                    ";

            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating table : " . mysqli_error($this->con);
            }
        } else {
            return false;
        }
    }
    // get product from the database
    public function getData()
    {
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
    public function saveToDB($product_id,$product_quantity,$product_name,$product_totalPrice){
        $query = "INSERT INTO $this->tablename (product_id,product_quantity,product_name,product_totalPrice) VALUES ('$product_id','$product_quantity','$product_name','$product_totalPrice')";
        if ($this->con->query($query) === TRUE) {
            echo "<script>alert('All Cart Items has been Saved into Database...!')</script>";
          } else {
            echo "Error: " . $query . "<br>" . $this->con->error;
          }
    }
}
