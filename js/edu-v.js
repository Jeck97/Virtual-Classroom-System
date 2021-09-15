function sideNav() {
	var sidebar = document.getElementById('sidebar');
	var navbar = document.getElementById('navbar');
	var container = document.getElementById('container');

	if (navbar.style.marginLeft == "0px")
		navbar.style.marginLeft = "250px";
	else
		navbar.style.marginLeft = "0px";

	if (container.style.marginLeft == "0px")
		container.style.marginLeft = "250px";
	else
		container.style.marginLeft = "0px";

	if (sidebar.style.left == "0px")
		sidebar.style.left = "-250px";
	else
		sidebar.style.left = "0px";		
}

function modalEmail() {

	var modalEmail = document.getElementById('modal-email');
	
	if (modalEmail.style.display == "none")
		modalEmail.style.display = "block";
	else
		modalEmail.style.display = "none";
}

function modalPassword() {

	var modalPassword = document.getElementById('modal-password');
	
	if (modalPassword.style.display == "none")
		modalPassword.style.display = "block";
	else
		modalPassword.style.display = "none";
}