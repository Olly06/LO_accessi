//Lepuri Orlando 5AI script.js
function getAccesses(){
	let idU = document.getElementById('frmUser').user.value;
	const ris = document.getElementById('ris');
	
	if(idU == null)
		ris.innerHTML = "Selezionare un utente";
	else{
		const xhttp = new XMLHttpRequest();
		xhttp.open("POST", 'APIgetAccessUsers.php');
		
		xhttp.onload = function(){
			manageReturn(this.responseText);
		}
		
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idU="+idU);
	}
}

function manageReturn(txt){
	const ris = document.getElementById('ris');
	let msgJson = JSON.parse(txt);
	ris.innerHTML = "<pre>" + JSON.stringify(msgJson, null, 4) + "</pre>";
}

function clearDIV(){
	const ris = document.getElementById('ris');
	ris.innerHTML = "";
}

function removeUser(){

	let idU = document.getElementById('frmDelete').user.value; 
	const risDelete = document.getElementById('risDelete');
	if(idU == null){
		risDelete.innerHTML = "Selezionare un Utente";
	}else{
		const xhttp = new XMLHttpRequest();
		xhttp.open("POST", 'APIdeleteUser.php');

		xhttp.onload = function(){
			manageReturn(this.responseText);
		}
		
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("idU="+idU);
	}

}