<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 06.06.2018
 * Time: 22:04
 */
class Account extends Controller
{
    function DBconnection($user){
        $servername = "localhost";
        $username = "root";
        $dbname = "aglr";

// Create connection
        $conn = new mysqli($servername, $username, null ,$dbname);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //echo "Connected successfully. ";
        $userEmail = $conn->prepare("SELECT * FROM users where Email = ?");
        //$userEmail->bind_param(1,$user->Email);
        if ($userEmail->execute()) {
            while ($row = $userEmail->fetch()) {
                print_r($row);
                echo "User already exists";
            }
        }

        /*$sql = "SELECT * FROM `users` WHERE Email = ?'" . $user->Email . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "User already exists";
            }
        } else {

            $insertUser = $dbname->prepare ("INSERT INTO users (firstName, lastName, email, password,userType) values(:firstName,:lastName,:email,:password,null)");
            $insertUser->bindParam(':firstName',$user->FirstName);
            $insertUser->bindParam(':lastName',$user->LastName);
            $insertUser->bindParam(':email',$user->Email);
            $insertUser->bindParam(':password',md5($user->Password));
            $insertUser->execute();
           /* $insert = "INSERT into users values('" . $user->FirstName ."','"
                . $user->LastName ."', '" . $user->Email . "', '" . md5($user->Password) . "', "
                . 1 . ")";
            echo "User Created";
        }*/
        $conn->close();
    }
    public function RegisterUser()
    {
        $obj = json_decode($_POST['user']);
        $this->DBconnection($obj);
    }
}