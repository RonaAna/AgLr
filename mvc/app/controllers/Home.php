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

    public function GetField($fieldId)
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
        $field = $this->model("Field");
        $sql = "SELECT * FROM fields f join usersfields uf on f.id = uf.fieldID join users u on uf.userid = u.id where Email = 'ana@a.com'";
        $result = $conn->query($sql);
        while($row = $result->fetch_row())
        {
            $field = $this->model("Field");
            $field->FieldId = $row[0];
            $field->FieldName = $row[1];
            $field->RegisterNumber = $row[2];
            $field->Dimensions = $row[3];
            $field->Zone = $row[4];
            $field->Address = $row[5];
            $field->Latitude = $row[6];
            $field->Longitude = $row[7];
            $field->ClimaticChars = $row[8];
            $field->LandType = $row[9];
            $field->Value = $row[10];

        }
        echo json_encode($field);
        $conn->close();

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
        $fields = Array();
        $sql = "SELECT * FROM fields f join usersfields uf on f.id = uf.fieldID join users u on uf.userid = u.id where Email = 'ana@a.com'";
        $result = $conn->query($sql);
        while($row = $result->fetch_row())
        {
            $field = $this->model("Field");
            $field->FieldId = $row[0];
            $field->FieldName = $row[1];
            $field->RegisterNumber = $row[2];
            $field->Dimensions = $row[3];
            $field->Zone = $row[4];
            $field->Address = $row[5];
            $field->Latitude = $row[6];
            $field->Longitude = $row[7];
            $field->ClimaticChars = $row[8];
            $field->LandType = $row[9];
            $field->Value = $row[10];

            array_push($fields, $field);
        }
        echo json_encode($fields);
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

public function EditField()
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
    $editField = $conn->prepare("UPDATE fields set (FieldName = ?, RegisterNumber = ?, Dimensions = ?, Zone = ?, Address = ?, Latitude = ?, Longitude = ?, ClimaticChars = ?, LandType = ?, Value = ?) WHERE Id = 1");
    $editField->bind_param('sisssddssd',$field->FieldName, $field->RegisterNumber,$field->Dimensions,$field->Zone,$field->Address,$field->Latitude ,$field->Longitude,$field->Climatics, $field->LandType, $field->Value);
    $editField->execute();
    $editField->store_result();
    if($editField == false) {
        print_r($conn->error);
        $editField->close();
        return;
    }
    else{
        $editField->close();
        echo "The insertion was awesome!";}
    $conn->close();
}


    public function PostTest()
    {
        $obj = json_decode($_POST['x']);
        echo $obj->nume;
    }
}
