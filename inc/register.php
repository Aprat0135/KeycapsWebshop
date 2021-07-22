<div class="registerDiv">
	<?php
		if (!empty($_POST['username'])){
			if (!empty($_POST['password']) && (!empty($_POST['password2']))){
				$db_host="localhost";
				$db_user="root";
				$db_password="";
				$db_name="KeycapsWebshop_DB";

                $password_entered1 = $_POST['password'];
                $password_entered2 = $_POST['password2'];
                if ($password_entered1 != $password_entered2) {
                    echo "The passwords do not match. ";
                    echo "Die Passwörter stimmen nicht überein. ";
                }

				$sql = new mysqli($db_host, $db_user, $db_password, $db_name);
				if ($sql->connect_error) {
					die("Error: unable to connect to database. ". $sql->connect_error);
				}
						
				$user = $sql->real_escape_string(strip_tags(filter_input(INPUT_POST, "username")));
				$password_raw = $sql->real_escape_string(strip_tags(filter_input(INPUT_POST, "password")));
				$password_hash = better_crypt($password_raw);

				$query = "SELECT username FROM userdata WHERE username = '" . $user ."';";
				$query_return = $sql->query($query);
						
				if ($query_return) {
					echo "Username is already in use, choose another. ";
					echo "Benutzername ist bereits vergeben, wähle einen anderen. ";
				} else {
					//write new user into database
					$query = "INSERT INTO userdata (username, password) VALUES ($user, $password_hash);";
					$query_return = $sql->query($query);
				}
				$sql->close();

			} else {
				echo "You have to enter your password into both fields. ";
                echo "Du musst dein Passwort in beiden Feldern eintragen. ";
			}
		} else {
			include 'inc/registerForm.html';
		}

		// Original PHP code by Chirp Internet: www.chirpinternet.eu
		// Please acknowledge use of this code by including this header.
		function better_crypt($input, $rounds = 10) {
    		$salt = "";
			$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
			for ($i=0; $i < 22; $i++) {
				$salt .= $salt_chars[array_rand($salt_chars)];
			}
			return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
		}
	?>
</div>