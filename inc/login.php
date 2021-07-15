<div class="loginDiv">
	<?php
		if (isset($_SESSION['username'])){
			echo "Moin ". $_SESSION['username'] . "!<br>";
		} else {
			if (!empty($_POST['username'])){
				if (!empty($_POST['password'])){
					$db_host="localhost";
					$db_user="root";
					$db_password="";
					$db_name="KeycapsWebshop_DB";
					$password_hash = $_POST['password'];

					$sql = new mysqli($db_host, $db_user, $db_password, $db_name);
					if ($sql->connect_error) {
						die("Error: unable to connect to database. ". $sql->connect_error);
					}
						
					$user = $sql->real_escape_string(strip_tags(filter_input(INPUT_POST, "username")));
					$query = "SELECT username, password FROM userdata WHERE username = '" . $user ."'";
					$query_return = $sql->query($query);
						
					$sql->close();
						
					if ($query_return) {
						$returned_password_hash = $query_return->fetch_array()['password'];
					} else {
						echo "Error: unable to return query. ";
					}
						
					if($password_hash == $returned_password_hash){
						$_SESSION['username'] = $user;
						echo "You are logged in as ". $user . "!";
					} else {
						echo "Wrong username or password. Perhaps check your spelling. ";
					}	
				} else {
					echo "You have to enter your password. ";
				}
			} else {
				include 'inc/loginForm.html';
			}
		}
	?>
</div>