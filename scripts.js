function addDriver1() {

	var dname = document.getElementById("dname").value;
	var email = document.getElementById("demail").value;
	var phno = document.getElementById("dphno").value;
	var amb_no_plate = document.getElementById("ambno").value;
	var type = document.getElementById("type").value;
	var amb_name = document.getElementById("ambname").value;
	var amb_bill = document.getElementById("ambbill").value;
	var driver_img = "images/" + getImg("dimg");
	var amb_img = "images/" + getImg("aimg");
	var arr = [];
	var pwd = genPassword();

	arr.push(dname); arr.push(pwd); arr.push(email); arr.push(phno); arr.push(driver_img); arr.push(amb_no_plate);
	arr.push(type); arr.push(amb_name); arr.push(amb_img); arr.push(amb_bill);
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) //that is we received a positive response
		{
			//  console.log(this.responseText);
			getDrivers();
		}
	};
	xhttp.open('GET', "controller.php?action=addDriver&details=" + arr);
	xhttp.send();
}

function updateDriver1() {
	var dname = document.getElementById("update-dname").value;
	var email = document.getElementById("update-email").value;
	var phno = document.getElementById("update-phno").value;
	var amb_no_plate = document.getElementById("update-ambno").value;
	var type = document.getElementById("update-type").value;
	var amb_name = document.getElementById("update-ambname").value;
	var did = document.getElementById("driver_id").value;
	var arr = [];
	arr.push(dname); arr.push(email); arr.push(phno); arr.push(amb_no_plate); arr.push(type); arr.push(amb_name);
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) //that is we received a positive response
		{
			// console.log(this.responseText);
			getDrivers();
		}
	};
	xhttp.open('GET', "controller.php?action=updateDriver&details=" + arr + "&did=" + did);
	xhttp.send();
}

function genPassword() {
	return Math.random().toString(36).slice(-8);
}
function getImg(id) {
	var p = document.getElementById(id).value;
	var file = p.split("\\");
	var fileName = file[file.length - 1];
	return fileName;
}

function getDrivers1() {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			loadCards(this);
		}
	};
	xhttp.open('GET', "controller.php?action=getDrivers");
	xhttp.send();
}
function removeDriver(did) {
	var r = confirm("Do you want to delete this box?");
	if (r == true) {
		var xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) //that is we received a positive response
			{
				loadCards(this);
			}
		};
		xhttp.open('GET', "controller.php?action=removeDriver&did=" + did);
		xhttp.send();
	}
}

function loadCards(xhttp) {
	var cont = document.getElementById("drivers_details");
	data = JSON.parse(xhttp.responseText);
	console.log(data);

	while (cont.hasChildNodes()) {
		cont.removeChild(cont.firstChild);
	}
	if (data.length === 0) {
		cont.innerHTML = "<h1 class='text-center'>No Drivers Available!</h1> ";
	}
	else {

		for (details of data) {
			cont.appendChild(makeCard(details));
		}
	}


}

function removeBtn(did) {
	btn = document.createElement("button");
	btn.setAttribute("class", "btn btn-danger ml-3");
	btn.setAttribute("id", did);
	btn.setAttribute("onclick", "removeDriver(this.id)");
	btn.innerHTML += "Delete";
	return btn;
}
function editBtn(did) {
	btn = document.createElement("button");
	btn.setAttribute("class", "btn btn-primary");
	btn.setAttribute("id", did);
	btn.setAttribute("onclick", "getFormDetails(this.id)");
	btn.setAttribute("data-toggle", "modal");
	btn.setAttribute("data-target", "#exampleModalCenter");
	btn.innerHTML += "Edit";

	return btn;
}
function getFormDetails(did) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) //that is we received a positive response
		{
			loadFormData(this);
		}
	};
	xhttp.open('GET', "controller.php?action=getDriverDetail&did=" + did);
	xhttp.send();
}
function loadFormData(xhttp) {
	details = JSON.parse(xhttp.responseText)[0];

	document.getElementById("update_name").setAttribute('value', details['name']);
	document.getElementById("update_phone").setAttribute('value', details['phone']);
	document.getElementById("update_email").setAttribute('value', details['email']);
	document.getElementById("update_dob").setAttribute('value', details['dob']);
	document.getElementById("update_address").setAttribute('value', details['Address']);
	document.getElementById("update_blood_type").setAttribute('value', details['blood_type']);
	document.getElementById("update_LicenseNumber").setAttribute('value', details['LicenseNumber']);
	document.getElementById("update_pass").setAttribute('value', details['password']);
	document.getElementById("update_did").setAttribute('value', details['Driver_ID']);
	
	
}
function makeCard(details) {
	card = document.createElement("div");
	card.setAttribute("class", "card shadow-sm mt-5");
	cardbody = makeCardBody(details);
	card.appendChild(cardbody);
	return card;
}

function makeInputField(detail) {
	inp = document.createElement("input");
	inp.setAttribute("type", "text");
	inp.setAttribute("class", "form-control-sm mr-4");
	inp.setAttribute("value", detail);
	return inp;
}
function updateBtn(did) {
	btn = document.createElement("button");
	btn.setAttribute("class", "btn btn-success");
	btn.setAttribute("id", did);
	btn.setAttribute("onclick", "updateDriver(this.id)");
	btn.innerHTML += "Update";
	return btn;
}

function makeCardBody1(details) {
	cardbody = document.createElement("div");
	cardbody.setAttribute("class", "card-body");
	div1 = document.createElement("div");
	div1.setAttribute("class", "row");
	div2 = document.createElement("div");
	div2.setAttribute("class", "col-sm-3");
	div3 = document.createElement("div");
	div3.setAttribute("class", "col-sm-4");
	div4 = document.createElement("div");
	div4.setAttribute("class", "col-sm-4");
	div1.appendChild(div2);
	div1.appendChild(div3);
	div1.appendChild(div4);
	cardbody.appendChild(div1);
	div2.innerHTML += "<img src='" + details.img_driver + "' class='img-fluid'>";
	div3.innerHTML += "<div><b>Driver Id:</b> " + details.did + "</div>";
	div3.innerHTML += "<div><b>Driver Name: </b>" + details.driver_name + "</div>";
	div3.innerHTML += "<div><b>Ph No:" + details.phone_no + "</b></div>";
	div3.innerHTML += "<div><b>Email:" + details.email_id + "</b></div>";
	div4.innerHTML += "<div><b>Ambulance Name: </b>" + details.ambulance_name + "</div>";
	div4.innerHTML += "<div><b>Ambulance No:</b> " + details.no_plate + "</div>";
	div4.innerHTML += "<div><b>Type:" + details.type + "</b></div>";
	div4.appendChild(editBtn(details.did));
	div4.appendChild(removeBtn(details.did));

	return cardbody;
}


