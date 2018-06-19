<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 08.06.2018
 * Time: 22:14
 */?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Main Page </title>
	<link rel="stylesheet" href="../../public/css/stylesheet.css" type="text/css">
</head>
<body style="background-image:url('../../public/Images/back.jpg');">
	<div class = "words" id="phrase1"> These are the fields for whom you have rigths!</div>

	<table id = "t01" onfocus="">
		<tr>
			<th><div>Field Description</div></th>
			<th></th>
            <th></th>
        </tr>
	</table>

	<div class = "words"> If you have informations about other lands you own, you can make a data import here!</div>
	<div><input class="submit-btn" type="submit" id="Import-btn" value="Import" onClick="RevealImport()"/>
        <form class="hide" style=" width: 70%;margin-left: auto;margin-right:auto;" action="import.php" method="post" name="upload" enctype="multipart/form-data" id = "formImport">
            <fieldset>

                <!-- Form Name -->
                <legend class="words">Import</legend>

                <!-- File Button -->
                <div>
                    <label for="filebutton" >Select File</label>
                    <div>
                        <input type="file" name="file" id="Importfile" >
                    </div>
                </div>

                <!-- Button -->
                <div >
                    <label for="singlebutton" >Import data</label>
                    <div >
                        <button type="button" id="btn-import-submit" name="Import" onClick="BetterImport()">Import</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
     <div class = "words"> You can Export your data from here!</div>
    
    <div style="display: flex; justify-content: center; margin: 5px"><input class="submit-btn" type="submit" id="ExportCSV-btn" value="Download as CSV"onClick="ExportCSV()"/></div>
    
    <div style="display: flex; justify-content: center; margin: 5px"><input class="submit-btn" type="submit" id="ExportXML-btn" value="Download as XML"onClick="ExportXML()"/></div>
    
    <div style="display: flex; justify-content: center; margin: 5px"><input class="submit-btn" type="submit" id="ExportJSON-btn" value="Download as JSON"onClick="ExportJSON()"/></div>

    <div class = "words"> And you can Add a new field manually or edit an already saved field!</div>
	<div style="display: flex; justify-content: center">
        <input class="submit-btn" type="submit" id = "addFieldInitialBtn" value = "Add field"/></div>

    </div>
	<!--<div class = "display-map"><!--<img src = "../../public/Images/HartaMargineni.PNG" alt="harta" id = "harta"/>
    <script>
        function initMap() {
            var myLatLong = {lat:47.173855, lng:27.574872};

            var map = new google.maps.Map(document.getElementById('map')), {
                zoom: 4,
                center: myLatLong
            });

        var marker = new google.maps.Marker({
            position: myLatLong,
            map: map,
            title: 'Your precious land'
        });

        }
        initMap();
    </script><script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV_6VE4X-HjAYqLgYi1S9Qv4BixerKAwc&callback=myMap"></script>
    </div>-->

	<div class = "add-field hide" id = "add-field-form">
		<div class = "fields">
Field Name:
			<input type="text" id="fieldname" placeholder="Field Name" autofocus required />
		</div>
		<div class = "fields">
Registration Nr.:
			<input type="text" id="registrationNr" placeholder="Registration Nr." required />
		</div>
		<div class = "fields">
Dimensions:
			<input type="text" id="dimensions" placeholder="Dimensions" required />
		</div>
		<div class = "fields">
Zone:
            <input type="text" id="zone" placeholder="Zone" required />
        </div>
        <div class = "fields">
            Address:
			<input type="text" id="address" placeholder="Address" required />
		</div>
		<div class = "fields">
Latitude:
			<input type="text" id="latitude" placeholder="-20.000" required />
		</div>
		<div class = "fields">
            Longitude:
            <input type="text" id="longitude" placeholder="45.23444763" required />
        </div>
        <div class = "fields">
Pedoclimatic charcs:
			<input type="text" id="pedoclimatic" placeholder="temperate clime" required />
		</div>
		<div class = "fields">
Land type:
			<input type="text" id="landType" placeholder="arable/unreachable land" required />
		</div>
		<div class = "fields">
Value:
			<input type="text" id="landValue" placeholder="15000$" required />
		</div>
		<div class = "fields">
Data of interest:
			<input type="text" id="interests" placeholder="crossed by the river" required />
		</div>
		<div><input class="submit-btn hide" type="submit" id="saveEdit-btn" value="saveEdit" onclick="EditField()"/></div>
	</div>

	<form id = "owner" class ="hide">
  		<input type="radio" name="owner" value="Individual" checked> Individual <br>
  		<input type="radio" name="owner" value="Company"> Company<br>
  		<input type="radio" name="owner" value="Farm"> Farm
	</form>
    <div style="display: flex; justify-content: center">
        <input type="submit" class="submit-btn hide" id ="Add-button" value = "Add field"/>
    </div>
<script type="text/javascript">

    function Import(){

    }

    function BetterImport()
    {
        var file = document.getElementById("Importfile").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/Import", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            debugger;
            console.log(xmlhttp.response);
        }
        xmlhttp.send('file=' + file.replace(/C:\\fakepath\\/i, ''));
    }
    function RetrieveFields() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "http://localhost:82/AgLr/mvc/public/home/GetFields", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            console.log(xmlhttp.response);
            var fields = JSON.parse(xmlhttp.response);
            var i = 0;
            //debugger;
            var table = document.getElementById("t01");
            var tableBody = table.children[0];
            var tr = document.getElementsByTagName("tr")
            /*var tableBody = document.getElementsByTagName("tbody");
            for (var index = 0,rows; rows = tableBody.rows[i];i++) {
                rows.removeChild(index);
            }*/
            for (var index = 1; index< tableBody.children.length; index++) {
                tr.remove();
                console.log(tableBody.children[index].tagName);
                //tableBody.children[index].remove();
            }
            for(i in fields) {
                var row = table.insertRow(table.rows.length);
                var attribute = document.createAttribute("FieldId");
                attribute.value = fields[i].FieldId;
                row.setAttributeNode(attribute);

                var attribute2 = document.createAttribute("OnClick");
                attribute2.value = "showInfo(this)";
                row.setAttributeNode(attribute2);
                var cell = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var elementid = document.getElementsByTagName("tr").length;
                var intElementid = elementid/2-1;
                cell2.setAttribute('id',intElementid);
                cell2.innerHTML = "<button class=\"edit-button\" type=\"button\" fieldId = "+fields[i].FieldId+">" +
                    "Edit" +
                    "</button>"
                var cell3 = row.insertCell(2);
                cell3.innerHTML = "<button class=\"trash-button\" type=\"button\" fieldId = "+fields[i].FieldId+">" +
                    "<img src =\"../Images/trash.png\" style=\" width:10px; height:15px\" alt=\"Delete\"/>Delete" +
                    "</button>"

                var row2 = table.insertRow(table.rows.length);
                var row2Cell = row2.insertCell(0);
                row2Cell.innerHTML = "<pre> "+ JSON.stringify(fields[i], null, 2) +"  </pre>";
                var attr = document.createAttribute("id");
                var attr2 = document.createAttribute("style");
                attr.value = "infoToShow-"+fields[i].FieldId;
                attr2.value = "display: none";
                row2.setAttributeNode(attr);
                row2.setAttributeNode(attr2);
                cell.innerHTML = "<div>" + fields[i].FieldName + "</div>";
                console.log(fields[i]);
            }

        var form = document.getElementById("add-field-form");
        var editBtn = document.getElementsByClassName("edit-button");
        var addFieldBtn = document.getElementById("addFieldInitialBtn");
        var submitEdit = document.getElementById("saveEdit-btn");
        var submitAdd = document.getElementById("Add-button");
        var deleteBtn = document.getElementsByClassName("trash-button");

        var j=0 ;
        for(j; j<editBtn.length; j++){
                editBtn[j].addEventListener('click', function() {
                    form.classList.remove('hide');
                    var fieldId = this.getAttribute("fieldId");
                    submitAdd.classList.add('hide');
                    submitEdit.parentElement.classList.remove('hide');
                    //var foundField = fields.filter(filterByID, fieldId);
                    //console.log(foundField);
                    document.getElementById("fieldname").value = fields[intElementid].FieldName;
                    document.getElementById("registrationNr").value = fields[intElementid].RegisterNumber;
                    document.getElementById("dimensions").value = fields[intElementid].Dimensions;
                    document.getElementById("zone").value = fields[intElementid].Zone;
                    document.getElementById("address").value = fields[intElementid].Address;
                    document.getElementById("latitude").value = fields[intElementid].Latitude;
                    document.getElementById("longitude").value = fields[intElementid].Longitude;
                    document.getElementById("pedoclimatic").value = fields[intElementid].ClimaticChars;
                    document.getElementById("landType").value = fields[intElementid].LandType;
                    document.getElementById("landValue").value = fields[intElementid].Value;
                    submitEdit.addEventListener('click',function() {
                        EditField(fieldId);
                        location.reload();
                    });
                });
            }

        addFieldBtn.addEventListener('click',function() {
            form.classList.remove('hide');
            submitAdd.classList.remove('hide');
            submitEdit.parentElement.classList.add('hide');
            submitAdd.addEventListener('click',function(){
                AddField();
                debugger;
                location.reload();
                debugger;
            });

        });
            var j=0 ;
            for(j; j<deleteBtn.length; j++){
                deleteBtn[j].addEventListener('click', function() {
                    alert("Are you sure you want to delete this field?");
                    var fieldId = this.getAttribute("fieldId");
                    DeleteField(fieldId);
                    location.reload();
                });
            }
        };
    
        xmlhttp.send();

    }

    function filterByID(item, idToCompare) {
          if (item.FieldId === idToCompare) {
              debugger;
            return item;
          }
          debugger;
  return item;
}


    RetrieveFields();
    function AddField() {
        var field = {
            FieldName: document.getElementById("fieldname").value,
            RegisterNumber: document.getElementById("registrationNr").value,
            Dimensions: document.getElementById("dimensions").value,
            Zone: document.getElementById("zone").value,
            Address: document.getElementById("address").value,
            Latitude: document.getElementById("latitude").value,
            Longitude: document.getElementById("longitude").value,
            ClimaticChars: document.getElementById("pedoclimatic").value,
            LandType: document.getElementById("landType").value,
            Value: document.getElementById("landValue").value
        }
        isValid = ValidateFields(field);
        if(isValid == true){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/AddField", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            if (xmlhttp.response.error !== null){
            console.log(xmlhttp.response);
            alert("The field was added!");
            RetrieveFields();

            }
            else{
                alert("An error occurred!")
            }
        }
        xmlhttp.send('field=' + JSON.stringify(field));}
        else {
            alert("Please respect the format from exemple!");
        }
    }

    function ValidateFields(field)
    {
        var isValid = true;
        if(field.FieldName === "" && typeof field.FieldName !== "string" && isValid == true) {
            isValid = false;
        }
        if(field.RegisterNumber === "" && typeof field.RegisterNumber !== "number" && isValid == true) {
            isValid = false;
        }
        if(field.Dimensions === "" && typeof field.Dimensions !== "string" && isValid == true) {
            isValid = false;
        }        if(field.Zone === "" && typeof field.Zone !== "string" && isValid == true) {
        isValid = false;
    }        if(field.Address === "" && typeof field.Address !== "string" && isValid == true) {
        isValid = false;
    }        if(field.Latitude === "" && typeof field.Latitude !== "number" && isValid == true) {
        isValid = false;
    }        if(field.Longitude === "" && typeof field.Longitude !== "number" && isValid == true) {
        isValid = false;
    }        if(field.ClimaticChars === "" && typeof field.ClimaticChars !== "string" && isValid == true) {
        isValid = false;
    }        if(field.LandType === "" && typeof field.LandType !== "string" && isValid == true) {
        isValid = false;
    }        if(field.Value === "" && typeof field.Value !== "number" && isValid == true) {
        isValid = false;
    }
    return isValid;
    }
   // AddField();
    function showInfo(data) {
        var idToShow = data.getAttribute("fieldId");
        var tr = document.getElementById("infoToShow-"+idToShow);
        var styleAttribute = tr.getAttribute("style");
        if(styleAttribute !== null)
        {
            tr.removeAttribute("style");
        }
        else{
            var attr = document.createAttribute("style");
            attr.value= "display: none";
            tr.setAttributeNode(attr);
        }
    }
    function EditField(fieldId) {
        var field = {
            FieldName : document.getElementById("fieldname").value,
            RegisterNumber :document.getElementById("registrationNr").value,
            Dimensions : document.getElementById("dimensions").value,
            Zone : document.getElementById("zone").value,
            Address :document.getElementById("address").value,
            Latitude : document.getElementById("latitude").value,
            Longitude : document.getElementById("longitude").value,
            ClimaticChars : document.getElementById("pedoclimatic").value,
            LandType : document.getElementById("landType").value,
            Value : document.getElementById("landValue").value,
            FieldId : fieldId
        }

        isValid = ValidateFields(field);
        if(isValid == true){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/EditField/fieldId", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function() {
            if (xmlhttp.response.error !== null) {

                console.log(xmlhttp.response);
                RetrieveFields();

            }
            else {
                alert("An error occurred!")
            }
        }
        xmlhttp.send('field=' + JSON.stringify(field));
    }else {
            alert("Please respect the format from exemple!");
        }
    }
    //EditField();
function RevealImport() {
    var formImport = document.getElementById("formImport");
    formImport.classList.remove("hide");
}

function Tst(){

}

    function ExportJSON(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "http://localhost:82/AgLr/mvc/public/home/ExportAsJSON", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            xmlhttp.response;
        }
        xmlhttp.send();
        alert("Your file has been saved into D:/Dowloads folder!");
    }

    function ExportXML(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "http://localhost:82/AgLr/mvc/public/home/ExportAsXML", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            xmlhttp.response;
        }
        xmlhttp.send();
        alert("Your file has been saved into D:/Dowloads folder!");
    }

    function ExportCSV(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "http://localhost:82/AgLr/mvc/public/home/ExportAsCSV", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            xmlhttp.response;
        }
        xmlhttp.send();
        alert("Your file has been saved into D:/Dowloads folder!");
    }

    function DeleteField(fieldId) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/Delete/fieldId", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            RetrieveFields();

            xmlhttp.response;

        }
        xmlhttp.send('field=' + JSON.stringify(fieldId));
    }
</script>
</body>
</html>
