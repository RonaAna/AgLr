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
	<div class = "words" id="phrase1"> These are the fields above for whom you have rigths!</div>

	<table id = "t01">
		<tr>
			<th><div>Field Description</div></th>
			<th></th>
            <th></th>
        </tr>
	</table>

	<div class = "words"> If you have informations about other lands you own, you can make a data import here!</div>
	<div><input class="submit-btn" type="submit" id="Import-btn" value="Import"/></div>
	<div class = "words"> And you can Add a new field manually or edit an already saved field!</div>
	<div style="display: flex; justify-content: center">
		<input type="submit" class="submit-btn" id ="Add-button" value = "Add field">
	</div>
	<div class = "display-map"><img src = "../../public/Images/HartaMargineni.PNG" alt="harta" id = "harta"/></div>

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
		<div><input class="submit-btn" type="submit" id="saveEdit-btn" value="saveEdit"/></div>
	</div>

	<form id = "owner">
  		<input type="radio" name="owner" value="Individual" checked> Individual <br>
  		<input type="radio" name="owner" value="Company"> Company<br>
  		<input type="radio" name="owner" value="Farm"> Farm
	</form>
	<div><input class="submit-btn" type="submit" id="Export-btn" value="Export"/></div>
<script type="text/javascript">

    function RetrieveFields() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "http://localhost:82/AgLr/mvc/public/home/GetFields", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            console.log(xmlhttp.response);
            var fields = JSON.parse(xmlhttp.response);
            var i = 0;
            for(i in fields) {
                var table = document.getElementById("t01");
                var row = table.insertRow(table.rows.length);
                var attribute = document.createAttribute("FieldId");
                attribute.value = fields[i].FieldId;
                row.setAttributeNode(attribute);
                var attribute2 = document.createAttribute("OnClick");
                attribute2.value = "showInfo(this)";
                row.setAttributeNode(attribute2);
                var cell = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell2.innerHTML = "<button class=\"edit-button\" type=\"button\" fieldId = "+fields[i].FieldId+">" +
                    "Edit" +
                    "</button>"
                var cell3 = row.insertCell(2);
                cell3.innerHTML = "<button class=\"trash-button\" type=\"button\">" +
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
        debugger;

        var i=0 ;
        for(i; i<editBtn.length; i++){
                editBtn[i].addEventListener('click', function() {
                    form.classList.remove('hide');
                    var fieldId = this.getAttribute("fieldId");
                    var foundField = fields.filter(filterByID, fieldId);
                    console.log(foundField);
                    document.getElementById("fieldname").value = fields[0].FieldName;
                    document.getElementById("registrationNr").value = fields[0].RegisterNumber;
                    document.getElementById("dimensions").value = fields[0].Dimensions;
                    document.getElementById("zone").value = fields[0].Zone;
                    document.getElementById("address").value = fields[0].Address;
                    document.getElementById("latitude").value = fields[0].Latitude;
                    document.getElementById("longitude").value = fields[0].Longitude;
                    document.getElementById("pedoclimatic").value = fields[0].Climatics;
                    document.getElementById("landType").value = fields[0].LandType;
                    document.getElementById("landValue").value = fields[0].Value;

                    //var saveButton = doc.getbyid (saveedit)
                    //add fieldId as attribute
                });
            }
        }
    
        xmlhttp.send();

    }

    function filterByID(item, idToCompare) {
  if (item.FieldId === idToCompare && item.id !== 0) {
    return item;
  }
  return item; 
}


    RetrieveFields();
    function AddField()
    {
        var field = {
            FieldName : document.getElementById("fieldname").value,
            RegisterNumber :document.getElementById("registrationNr").value,
            Dimensions : document.getElementById("dimensions").value,
            Zone : document.getElementById("zone").value,
            Address :document.getElementById("address").value,
            Latitude : document.getElementById("latitude").value,
            Longitude : document.getElementById("longitude").value,
            Climatics : document.getElementById("pedoclimatic").value,
            LandType : document.getElementById("landType").value,
            Value : document.getElementById("landValue").value
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/AddField", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            console.log(xmlhttp.response);
        }
        xmlhttp.send('field=' + JSON.stringify(field));
    }
    AddField();
    function showInfo(data)
    {
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
    function EditField()
    {
        var field = {
            FieldName : document.getElementById("fieldname").value,
            RegisterNumber :document.getElementById("registrationNr").value,
            Dimensions : document.getElementById("dimensions").value,
            Zone : document.getElementById("zone").value,
            Address :document.getElementById("address").value,
            Latitude : document.getElementById("latitude").value,
            Longitude : document.getElementById("longitude").value,
            Climatics : document.getElementById("pedoclimatic").value,
            LandType : document.getElementById("landType").value,
            Value : document.getElementById("landValue").value
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AgLr/mvc/public/home/EditField", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            console.log(xmlhttp.response);
        }
        xmlhttp.send('field=' + JSON.stringify(field));
    }
    EditField();


</script>
</body>
</html>
