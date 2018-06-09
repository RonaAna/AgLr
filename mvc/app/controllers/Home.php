<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 04.06.2018
 * Time: 0:58
 */
class Home extends Controller
{
    public function Index()
    {
        $this->view('home\index');
        $user = $this->model('User');

    }
    public function GetFields()
    {
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
        $allFields = $conn->prepare("SELECT * FROM fields f join usersfields uf on f.id = uf.fieldID join users u on uf.userid = u.id where Email = ?");
        $email = 'ana@a.com';
        $allFields->bind_param('s', $email);
        $allFields->execute();
        $allFields->store_result();
        if($allFields->num_rows>0) {
            print_r("Pizza is comming!");
            $allFields->close();
        }
        else{
            $allFields->close();
        }
        $conn->close();
    }
public function AddField()
{
    $field = json_decode($_POST['field']);

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
    $insertField = $conn->prepare("INSERT INTO fields (FieldName, RegisterNumber, Dimensions, Zone, Address, Latitude, Longitude, ClimaticChars, LandType, Value) values(?,?,?,?,?,?,?,?,?,?)");
    $insertField->bind_param('sisssddssd',$field->FieldName, $field->RegisterNumber,$field->Dimensions,$field->Zone,$field->Address,$field->Latitude ,$field->Longitude,$field->Climatics, $field->LandType, $field->Value);
    $insertField->execute();
    $insertField->store_result();
    if($insertField == false) {
        print_r($conn->error);
        $insertField->close();
        return;
    }
    else{
        $insertField->close();
        echo "The insertion was awesome!";}
    $conn->close();
}


    public function PostTest()
    {
        $obj = json_decode($_POST['x']);
        echo $obj->nume;
    }
}
