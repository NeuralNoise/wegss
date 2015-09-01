<?php
        include("include/dbconfig.php");
		//turn on php error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
		
		//session
		session_start(); // Don't forget this on each page that uses sessions
		$user_id = $_SESSION["user_id"];
		
		
		date_default_timezone_set('Asia/Calcutta');
		// Then call the date functions
		$date = date('Y-m-d');
		$time = date('h:i:s');
 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            
			$RandomName = uniqid();
			$name = $RandomName.'.'.$ext;
            switch ($error) {
                case UPLOAD_ERR_OK:
                    $valid = true;
                    //validate file extensions
                    if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 10 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
						if(isset($_POST['photouploadbtn'])){
                        $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'imagesByUsers/' . DIRECTORY_SEPARATOR. $name;
                        move_uploaded_file($tmpName,$targetPath);
						$caption  = $_POST['caption'];
						
						$query= "INSERT INTO `post`(`post_user_id`, `photo_post_name`, `photo_post_caption`, `post_date`, `post_time`) VALUES ($user_id, '$name', '$caption', '$date', '$time')";
						mysql_query($query);
						
                        header( 'Location: homepage.php' ) ;
                        exit;
						}
						}
                    break;
                case UPLOAD_ERR_INI_SIZE: 
                    $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $response = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $response = 'No file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                    break;
                default:
                    $response = 'Unknown error';
                break;
            }
 
            echo $response;
        }
        ?>