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
        $conn = new mysqli($servername, $username, null, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //echo "Connected successfully. ";
        $field = $this->model("Field");
        $sql = "SELECT * FROM fields f join usersfields uf on f.id = uf.fieldID join users u on uf.userid = u.id where Email = 'ana@a.com'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_row()) {
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
    public function Map()
    {
        $this->view('home/map');
    }
    public function MapIndex()
    {
        $this->view('home/mapIndex');
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
    public function ExportAsJSON() {
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

        $file1 = fopen("D:\\Downloads\\jsonExport.json", "w");
        fwrite($file1, json_encode($fields));
        fclose($file1);
        /*header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=jsonExport.json');
        header('Pragma: no-cache');
        readfile("D:/Downloads/jsonExport.json");*/

        $conn->close();
    }

    public function ExportAsXML() {
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

        $file2 = fopen("D:\\Downloads\\xmlExport.xml", "w");
        require_once '../app/XmlHelper.php';
        fwrite($file2, XmlSerializer::toXml($fields, "Fields"));
        fclose($file2);
        header('Content-Type: application/xml');
        header('Content-Disposition: attachment; filename=xmlExport.xml');
        header('Pragma: no-cache');
        readfile("D:/Downloads/xmlExport.xml");
        
        $conn->close();
    }

    public function ExportAsCSV(){
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
        $file3 = fopen("D:\\Downloads\\csvExport.csv", "w");
        fputcsv($file3, array_keys(get_object_vars($fields[0])));
        foreach ($fields as $flds) {

                $flds = (array) $flds;
            fputcsv($file3, $flds);
        }
        fclose($file3);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=csvExport.csv');
        header('Pragma: no-cache');
        readfile("D:/Downloads/csvExport.csv");
		
		$conn->close();
    }


    /*public function Export(){
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
    }*/

    /*public function Import()
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




        $fields = Array();
        {$insertField = $conn->prepare("INSERT INTO fields (FieldName, RegisterNumber, Dimensions, Zone, Address, Latitude, Longitude, ClimaticChars, LandType, Value) values(?,?,?,?,?,?,?,?,?,?)");
            $insertField->bind_param('sisssddssd',$field->FieldName, $field->RegisterNumber,$field->Dimensions,$field->Zone,$field->Address,$field->Latitude ,$field->Longitude,$field->ClimaticChars, $field->LandType, $field->Value);
            $insertField->execute();
            $insertField->store_result();
            if($insertField == false) {
                print_r($conn->error);
                $insertField->close();
                return;
            }
            else {
                $fieldId = mysqli_insert_id($conn);
                mysqli_free_result($insertField);
                $userId=12;
                $insertField->close();
                $insertToUserFields = $conn->prepare("INSERT INTO UsersFields (UserId,FieldId) values(?,?);");
                $insertToUserFields->bind_param('ii',$userId,$fieldId);
                $insertToUserFields->execute();
                $insertToUserFields->store_result();
                if($insertToUserFields ==false) {
                    print_r($conn->error);
                    $insertToUserFields->close();
                    return;
                } else {
                    echo "The insertion was awesome!";}}
            $conn->close();}
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
    }*/

function ImportJSON($file){
    $file1 = fopen($file, "r");
    $content = fread($file1, filesize($file));
    $json = json_decode($content);
    fclose($file1);
    return $json;
}
function ImportXML($file) {
    $file2 = fopen($file,"r");
    $content = fread($file2, filesize($file));
    $obj = simplexml_load_string($content);
    fclose($file2);
    return $obj;
}
/*function ImportCSV($file){
    $file3 = fopen($file, "r");
    $csv = file_get_contents($file3);
    $array = array_map("str_getcsv", explode("\n", $csv));
    $json = json_encode($array);

    fclose($file3);
    return $json;
}*/
function Import() {
    $file = $_POST['file'];
    $extension = pathinfo($file, PATHINFO_EXTENSION);;
    $file = $_SERVER['DOCUMENT_ROOT'] . '/AgLr/'. $file;
    $servername = "localhost";
    $username = "root";
    $dbname = "aglr";
// Create connection
    $conn = new mysqli($servername, $username, null ,$dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if($extension == 'json') {
    $json = $this->ImportJSON($file);
    //print_r($json);
    }
    else if ($extension == 'xml') {
        $json = $this->ImportXML($file);
        //print_r($json);
    }
    else if ($extension == 'csv') {
        $json = $this->csv_to_array($file);
        //$json = json_decode($this->ImportCSV($file));
        print_r($json);

    }
    foreach ($json as $value){
    $insertField = $conn->prepare("INSERT INTO fields (FieldName, RegisterNumber, Dimensions, Zone, Address, Latitude, Longitude, ClimaticChars, LandType, Value) values(?,?,?,?,?,?,?,?,?,?)");
    $insertField->bind_param('sisssddssd',$value->FieldName, $value->RegisterNumber,$value->Dimensions,$value->Zone,$value->Address,$value->Latitude ,$value->Longitude,$value->ClimaticChars, $value->LandType, $value->Value);
    $insertField->execute();
    $insertField->store_result();
    if($insertField == false) {
        print_r($conn->error);
        $insertField->close();
        return;
    }
    else {
        $fieldId = mysqli_insert_id($conn);
        mysqli_free_result($insertField);
        $userId=12;
        $insertField->close();

        $insertToUserFields = $conn->prepare("INSERT INTO UsersFields (UserId,FieldId) values(?,?);");
        $insertToUserFields->bind_param('ii',$userId,$fieldId);
        $insertToUserFields->execute();
        $insertToUserFields->store_result();
        if($insertToUserFields ==false) {
            print_r($conn->error);
            $insertToUserFields->close();
            return;
        } else {
            echo "The insertion was awesome!";}}}
    $conn->close();
    //print_r($json);

}

    function csv_to_array($filename, $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 10000, $delimiter)) !== FALSE)
            {
                if(!$header){
                    $header = array_map('trim', $row);
                print_r($header);}
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
    $insertField->bind_param('sisssddssd',$field->FieldName, $field->RegisterNumber,$field->Dimensions,$field->Zone,$field->Address,$field->Latitude ,$field->Longitude,$field->ClimaticChars, $field->LandType, $field->Value);
    $insertField->execute();
    $insertField->store_result();
    if($insertField == false) {
        print_r($conn->error);
        $insertField->close();
        return;
    }
    else {
        $fieldId = mysqli_insert_id($conn);
        mysqli_free_result($insertField);
        $userId=12;
        $insertField->close();
        $insertToUserFields = $conn->prepare("INSERT INTO UsersFields (UserId,FieldId) values(?,?);");
        $insertToUserFields->bind_param('ii',$userId,$fieldId);
        $insertToUserFields->execute();
        $insertToUserFields->store_result();
        if($insertToUserFields ==false) {
            print_r($conn->error);
            $insertToUserFields->close();
            return;
        } else {
        echo "The insertion was awesome!";}}
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
    $editField = $conn->prepare("UPDATE fields set FieldName = ?, RegisterNumber = ?, Dimensions = ?, Zone = ?, Address = ?, Latitude = ?, Longitude = ?, ClimaticChars = ?, LandType = ?, Value = ? WHERE Id = ?");
    $editField->bind_param('sisssddssdi',$field->FieldName, $field->RegisterNumber,$field->Dimensions,$field->Zone,$field->Address,$field->Latitude ,$field->Longitude,$field->ClimaticChars, $field->LandType, $field->Value,$field->FieldId);
    $editField->execute();
    $editField->store_result();
    if($editField == false) {
        print_r($conn->error);
        $editField->close();
        return;
    }
    else{
        $editField->close();
        echo "The update is made!";}
    $conn->close();
}
public function Delete($fieldId){
    $servername = "localhost";
    $username = "root";
    $dbname = "aglr";
    // Create connection
    $conn = new mysqli($servername, $username, null, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo "Connected successfully. ";
    $field = json_decode($_POST['field']);

    $deleteField = $conn->prepare("DELETE FROM fields where Id=?");
    $deleteField->bind_param('i',$field);
    $deleteField->execute();
    if($deleteField == false) {
        print_r($conn->error);
        $deleteField->close();
        return;
    }
    else {
        echo "Field was deleted!";
    }
    $conn->close();
}

    public function PostTest()
    {
        $obj = json_decode($_POST['x']);
        echo $obj->nume;
    }
}
