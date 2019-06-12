<?php
	if(isset($_SESSION['logado']) && $_SESSION['logado'] == 'true'){
		echo '<li><a href="controlador/ControladorLogout.php"> Olá, ', $_SESSION['usuario'], ' &nbsp <i class="fa fa-sign-out"></i></a></li>';
	} else {
		echo '<li><a href="login.php"><i class="fa fa-lock"></i>Login</a></li>';
	}
?>