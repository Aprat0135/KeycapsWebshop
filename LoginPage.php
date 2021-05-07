<?php
session_start();
?>
<!doctype html>
<html>
    <?php
        include 'inc/head.html';
    ?>
    <body>
        <header>
	        <?php
		        include 'inc/nav.html';
	        ?>
	    </header>
        <?php
            include 'inc/darkmode-switch.html';
            include 'inc/login.php';
        ?>
        <main>
            <h1>LoginPage</h1>
        </main>
        <?php
            include 'inc/footer.html';
	    ?> 
    </body>
</html>