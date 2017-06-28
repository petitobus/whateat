<?php
	function authenticate($sensitive=false){
		if(!isset($_SESSION['MERCHANT_EMAIL'])){
			redirect(U('Login/index'),1,'Time Out，Redirect to Login Page ...','...'); 
		}
	}
?>