<?php

			
				$servername = "localhost";
				$username = "root";
				$dbpassword = "";
				$dbname = "gram";
				
				// Create connection
				$conn = mysql_connect($servername, $username, $dbpassword);
				mysql_select_db($dbname, $conn);
?>				