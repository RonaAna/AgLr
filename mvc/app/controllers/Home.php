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

    public function Map()
    {
        $this->view('home\map');
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

    public function Export(){
        $servername = "localhost";
        $username = "root";
        $dbname = "aglr";
// Create connection
        $conn = new mysqli($servername, $username, null ,$dbname);

// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

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
        $file1 = fopen("D:\\an3v2\\xamp\\htdocs\\AgLr\\jsonExport.json", "w");
        fwrite($file1, json_encode($fields));
        fclose($file1);

        $file2 = fopen("D:\\an3v2\\xamp\\htdocs\\AgLr\\xmlExport.xml", "w");
        require_once '../app/XmlHelper.php';
        fwrite($file2, XmlSerializer::toXml($fields, "Fields"));
        fclose($file2);

        print_r($fields);
        $file3 = fopen("D:\\an3v2\\xamp\\htdocs\\AgLr\\csvExport.csv", "w");
        fputcsv($file3, array_keys(get_object_vars($fields[0])));
        foreach ($fields as $flds) {

                $flds = (array) $flds;
            fputcsv($file3, $flds);
        }

        echo json_encode($fields);
        $conn->close();
    }

    public function Import()
    {
        $file1 = fopen("D:\\an3v2\\xamp\\htdocs\\AgLr\\jsonExport.json", "r");
        $content = fread($file1, filesize("D:\\an3v2\\xamp\\htdocs\\AgLr\\jsonExport.json"));
        $json = json_decode($content);
        print_r($json);
        fclose($file1);


        $file2 = fopen("D:\\an3v2\\xamp\\htdocs\\AgLr\\xmlExport.xml", "r");
        $content = fread($file2, filesize("D:\\an3v2\\xamp\\htdocs\\AgLr\\xmlExport.xml"));
        $obj = simplexml_load_string($content);
        print_r($obj);

        print_r($this->csv_to_array("D:\\an3v2\\xamp\\htdocs\\AgLr\\csvExport.csv"));
    }

    function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
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
