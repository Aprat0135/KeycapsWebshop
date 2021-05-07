<div class="loginDiv">
	<?php
		if (isset($_SESSION['username'])){
			echo "Moin ". $_SESSION['username'] . "!<br>";
		} else {
			if (!empty($_POST['username'])){
				if (!empty($_POST['password'])){
					$server="localhost";
					$user="root";
					$password="";
					$db="KeycapsWebshop_DB";
						
					$pw = /*sha1(*/$_POST['password']/*)*/;
						
					$sql = new mysqli($server, $user, $password, $db);
					if ($sql->connect_error) {
						die("Es ist ein Fehler mit der Datenbank aufgetreten: ". $sql->connect_error);
					}
						
					$nutzer = $sql->real_escape_string(strip_tags(filter_input(INPUT_POST, "username")));
						
					$erg = "SELECT username, password FROM userdata WHERE username = '" . $nutzer ."'";
					$aus = $sql->query($erg);
						
					$sql->close();
						
					$dbPassword = "";
					if ($aus) {
						$passaus = $aus->fetch_array();
						$dbPassword = $passaus['password'];
					} else {
						echo "Es ist ein Fehler beim Abfragen aufgetreten!";
					}
						
					if($pw == $dbPassword){
						$_SESSION['username'] = $nutzer;
						echo "Du bist als ". $nutzer . " eingeloggt!";
					} else {
						echo "Eingegebene Daten stimmen nicht überein!";
					}	
				} else {
					echo "Sie müssen ein Passwort eingeben!";
				}
			} else {
				include 'inc/loginForm.html';
			}
		}
	?>
</div>